<?php
// Static pages routes
Route::get('acerca', 'StaticController@about');
Route::get('terminos', 'StaticController@terms');
Route::get('privacidad', 'StaticController@privacy');

// Index routes
Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
Route::get('ubicacion/{state_slug}/{city_slug}', 'IndexController@location');
Route::get('categoria/{slug}', 'IndexController@category');
Route::get('condicion/{slug}', 'IndexController@condition');

Route::get('search', 'SearchController@search');

// Sitemaps
Route::get('sitemap-articles', 'SitemapController@articles');
Route::get('sitemap-categories', 'SitemapController@categories');

// Slugs
Route::get('articulo/{slug}',  'ArticleController@show');

Route::get('contact',  'ContactController@create');
Route::post('contact', 'ContactController@store');

// Panel routes
Route::get('panel',           'PanelController@index');
Route::get('home',            'PanelController@index');
Route::get('panel/offers',    'PanelController@offers');
Route::get('panel/questions', 'PanelController@questions');

// User routes
Route::get('panel/profile', 'Auth\AuthController@edit');
Route::put('panel/profile/{user_id}', [
    'as'   => 'panel.profile',
    'uses' => 'Auth\AuthController@update'
]);

// Authentication routes...
Route::get('auth/login',  'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register',  'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/{provider}', 'Auth\AuthController@socialite');

// Images routes
Route::get('image/article/{article_id}/{image_id}/{image_size}.png', 'ImageController@getArticleImage');
Route::get('image/article/default/{image_size}.gif', 'ImageController@getDefault');

// Article routes
Route::get('panel/article/create',             'ArticleController@create');
Route::get('panel/articles/edit/{article_id}', 'ArticleController@edit');
Route::post('articles',                        'ArticleController@store');
Route::put('panel/articles/edit/{article_id}', [
    'as'   => 'article.update',
    'uses' => 'ArticleController@update'
]);
Route::post('panel/articles/update_status', 'ArticleController@change_status');

// Questions routes
Route::get('trades/question/{article_id}', 'QuestionController@create');
Route::post('trades/question/replay',      'QuestionController@replay');
Route::post('trades/question',             'QuestionController@store');

// Offer routes
Route::get('trades/offer/{article_id}' ,     'OfferController@create');
Route::post('trades/offer',                  'OfferController@store');
Route::post('trades/offer/replay',           'OfferController@replay');
Route::get('trades/offer/reject/{offer_id}', 'OfferController@reject');
Route::get('trades/offer/accept/{offer_id}', 'OfferController@accept');

// Cities
Route::get('cities/{state_id}', function($state_id) {
    $cities = \App\City::select('id', 'name')->where('state_id', $state_id)->get()->toArray();
    return Response::json(compact('cities'));
});

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Admin
Route::get('admin/', 'Admin\IndexController@index');
Route::get('admin/users', 'Admin\IndexController@users');
Route::get('admin/articles', 'Admin\IndexController@articles');
Route::get('admin/images', 'Admin\IndexController@images');

Route::get('admin/stats/images-mimes', 'Admin\StatsController@imagesMimes');
Route::get('admin/stats/users-providers', 'Admin\StatsController@usersProviders');
Route::get('admin/stats/users-states', 'Admin\StatsController@usersStates');
Route::get('admin/stats/articles-conditions', 'Admin\StatsController@articlesConditions');
Route::get('admin/stats/articles-categories', 'Admin\StatsController@articlesCategories');
Route::get('admin/stats/articles-statuses', 'Admin\StatsController@articlesStatuses');
Route::get('admin/stats/offers-statuses', 'Admin\StatsController@offersStatuses');

// Facebook stuff
Route::get('admin/facebook/', 'Admin\FacebookController@index');
Route::get('facebook/store', 'Admin\FacebookController@store');
Route::post('admin/facebook/post', 'Admin\FacebookController@post');

// Twitter stuff
Route::post('admin/twitter/post', 'Admin\TwitterController@post');
