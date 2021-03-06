<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Image;
use App\Offer;
use App\Article;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        try {
            $this->authorize('admin');
        } catch(HttpException $e) {
            return redirect('/panel');
        }
    }

    public function index()
    {
        $users_count     = User::count();
        $articles_count  = Article::count();
        $questions_count = Question::count();
        $offers_count    = Offer::count();
        $images_count    = Image::count();

        return view('admin.index.index', compact(
            'users_count', 'articles_count', 'questions_count', 'offers_count', 'images_count'
        ));
    }

    public function users()
    {
        $users = \App\User::latest()->paginate(20);

        return view('admin.index.users', compact('users'));
    }

    public function articles()
    {
        $articles = \App\Article::latest()->paginate(20);

        return view('admin.index.articles', compact('articles'));
    }

    public function images()
    {
        $images = \App\Image::latest()->with('article')->paginate(20);

        return view('admin.index.images', compact('images'));
    }
}
