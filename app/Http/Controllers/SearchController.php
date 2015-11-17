<?php

namespace App\Http\Controllers;

use Config;
use App\State;
use App\Article;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SearchController extends Controller
{
    protected $limit;
    protected $article;

    public function __construct()
    {
        $this->limit = Config::get('constants.main_article_list_limit');

        $this->article = Article::with(
            'category', 'user.state', 'user.city', 'images'
        )->orderBy('created_at', 'desc');
    }

    public function index()
    {
        $articles = $this->article
            ->where('status', ARTICLE_STATUS_OPEN)
            ->paginate($this->limit);

        $featured_articles = Article::with('images')->orderBy(\DB::raw('RAND()'))->take(4)->get();

        return view('search.index', compact('articles', 'featured_articles'));
    }

    public function category($slug)
    {
        try {
            $category = Category::whereSlug($slug)->firstOrFail();
            $articles = $this->article
                ->where(['category_id' => $category->id, 'status' => ARTICLE_STATUS_OPEN])
                ->paginate($this->limit);
        } catch(ModelNotFoundException $e) {
            abort(404, 'No existe esa categoría.');
        }

        return view('search.category', compact('articles', 'category'));
    }


    public function condition($slug)
    {
        $condition = article_condition($slug);

        if (! $condition) {
            abort(404, 'No existe esa condición.');
        }

        $articles = $this->article
            ->where(['condition_id' => $condition['id'], 'status' => ARTICLE_STATUS_OPEN])
            ->paginate($this->limit);

        return view('search.condition', compact('articles', 'condition'));
    }

    public function location(Request $request)
    {
        $state_id = $request->state_id;
        $city_id  = $request->city_id;

        try {
            $location = State::join('cities', 'cities.state_id', '=', 'states.id')
                ->select('states.short', 'cities.name')
                ->where(['state_id' => $state_id, 'cities.id' => $city_id])
                ->firstOrFail();

            $articles = $this->article
                ->join('users', 'users.id', '=', 'user_id')
                ->select('articles.*')
                ->where(['users.state_id' => $state_id, 'city_id' => $city_id,'status' => ARTICLE_STATUS_OPEN])
                ->paginate($this->limit);
        } catch(ModelNotFoundException $e) {
            abort(404, 'No existe esa ubicación.');
        }

        return view('search.location', compact('articles', 'location'));
    }

    public function search(SearchRequest $request)
    {
        $query = $request->get('query');
        $articles = $this->article->search($query)->paginate($this->limit);
        return view('search.search', compact('articles', 'query'));
    }
}