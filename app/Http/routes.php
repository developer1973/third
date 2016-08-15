<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//use App\User;
//Default page
//use App\User;

Route::get('/MyLogin', function () {
    return view('welcome');
});



Route::auth();

Route::get('/home', 'HomeController@index');


//Route::resource('admin/users','AdminUsersController');

Route::get('/post/{id}',['as'=>'home.post','uses'=>'AdminPostsController@post']);
Route::get('/',['as'=>'home.post1','uses'=>'AdminPostsController@post_all']);
Route::get('/posts/{id}',['as'=>'home.post2','uses'=>'AdminPostsController@post_author']);
Route::get('/category/{id}',['as'=>'home.post7','uses'=>'AdminCategoriesController@category_author']);
Route::get('/search/new',['as'=>'home.post8','uses'=>'AdminPostsController@searchmulti']);
Route::get('/admin/mycomment/{id}',['as'=>'home.post3','uses'=>'CommentRepliesController@show_comment']);

Route::group(['middleware'=>'admin'],function(){
    

    Route::get('/admin',function (){

        return view('Admin.index');
    });

    Route::resource('admin/users','AdminUsersController');

    Route::resource('admin/posts','AdminPostsController');

    Route::resource('admin/categories','AdminCategoriesController');

   // Route::resource('admin/media1','AdminMediaController');
    Route::get('admin/media',['as'=>'admin.media','uses'=>'AdminMediaController@index']);
    
    Route::get('admin/media/upload',['as'=>'admin.media.upload','uses'=>'AdminMediaController@create']);

    Route::post('admin/media',['uses'=>'AdminMediaController@store']);
    
    Route::delete('admin/media/{id}',['uses'=>'AdminMediaController@destroy']);

    Route::resource('admin/comments','PostCommentsController');

    Route::resource('admin/comment/replies','CommentRepliesController');

//    Route::get('admin/media/upload',['as'=>'admin.media.upload','uses'=>'AdminMediaController@store']);



//    Route::get('admin/media/upload',['as'=>'admin.media.upload','uses'=>'AdminMediaController@create']);

//    Route::get('admin/media/upload',['as'=>'admin.media.upload',function()]);


//    Route::resource('admin','AdminUsersController');
    //Route::get('admin/users','AdminUsersController@index');
//    Route::get('admin/users/create','AdminUsersController@create');
//    Route::get('admin/users','AdminUsersController@store');
});

Route::group(['middleware'=>'auth'],function(){

    Route::post('comment/reply','CommentRepliesController@createReply');
//    Route::get('/admin/mycomment/{id}',['as'=>'home.post3','uses'=>'CommentRepliesController@show_comment']);

});











//Route::group(['middleware'=>'author'],function(){
  // Route::resource('author/users','AuthorUsersController');
//});
//Route::get('/mypage',function (){
//
//    return view('errors.404');
//});
//Route::get('/kamal',function (){
//   $x=User::findOrFail(1);
//$y= $x->photo->file;
//    //return $value = substr("$y",8);
//    //return $y;
//});


//Route::filter('role', function()
//{
//
//    if ( Auth::user()->isAdmin()) {
//        // do something
//        return Redirect::to('/admin');
//    }
//});


Route::get('/fun',[
    'uses'=>'AuthorUsersController@getAuthorPage',
    //'as'=>'author',
    'middleware'=>'king',
    'king'=>['author','administrator']

]);

Route::get('/fun/test',[
    'uses'=>'AuthorUsersController@getGeneratePage',
    //'as'=>'author',
    'middleware'=>'king',
    'king'=>['author']

]);
//////
//Route::get('/admin/users/create',[
//    'uses'=>'AdminUsersController@create',
//    //'as'=>'author',
//    'middleware'=>'king',
//    'king'=>['author','administrator']
//
//]);
//Route::post('/admin/users',[
//    'uses'=>'AdminUsersController@store',
//    //'as'=>'author',
//    'middleware'=>'king',
//    'king'=>['author','administrator']
//
//]);
//
//Route::get('/admin/users',[
//    'uses'=>'AdminUsersController@index',
//    //'as'=>'author',
//    'middleware'=>'king',
//    'king'=>['author','administrator']
//
//]);
//
//Route::get('/admin/users/{id}/edit',[
//    'uses'=>'AdminUsersController@edit',
//    //'as'=>'author',
//    'middleware'=>'king',
//    'king'=>['author','administrator']
//
//]);
//
//Route::patch('/admin/users/{id}',[
//    'uses'=>'AdminUsersController@update',
//    //'as'=>'author',
//    'middleware'=>'king',
//    'king'=>['author','administrator']
//
//]);
//Route::delete('/admin/users/{id}',[
//    'uses'=>'AdminUsersController@destroy',
//    //'as'=>'author',
//    'middleware'=>'king',
//    'king'=>['author','administrator']
//
//]);
