<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');

Auth::routes();

Route::resource('posts', 'PostController', ['only' => ['index', 'show']]);
Route::resource('tags', 'TagController', ['only' => ['index', 'show']]);
Route::resource('categories', 'CategoryController', ['only' => ['index', 'show']]);
Route::resource('comments', 'CommentController', ['only' => ['store']]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin|superAdmin']], function() {

    Route::get('admin', 'Admin\DefaultController@index')->name('admin.defaults.index');

    Route::get('posts', 'Admin\PostController@index')->name('admin.posts.index');
    Route::get('posts/create', 'Admin\PostController@create')->name('admin.posts.create')->middleware('can:create,App\Post');
    Route::post('posts', 'Admin\PostController@store')->name('admin.posts.store')->middleware('can:create,App\Post');
    Route::get('posts/{post}/edit', 'Admin\PostController@edit')->name('admin.posts.edit')->middleware('can:update,post');
    Route::patch('posts/update/{post}', 'Admin\PostController@update')->name('admin.posts.update')->middleware('can:update,post');
    Route::delete('posts/{post}', 'Admin\PostController@destroy')->name('admin.posts.destroy')->middleware('can:delete,post');

    Route::get('users', 'Admin\UserController@index')->name('admin.users.index')->middleware('can:view,App\User');
    Route::get('users/create', 'Admin\UserController@create')->name('admin.users.create')->middleware('can:create,App\User');
    Route::post('users', 'Admin\UserController@store')->name('admin.users.store')->middleware('can:create,App\User');
    Route::get('users/{user}/edit', 'Admin\UserController@edit')->name('admin.users.edit')->middleware('can:update,user');
    Route::patch('users/update/{user}', 'Admin\UserController@update')->name('admin.users.update')->middleware('can:update,user');
    Route::delete('users/{user}', 'Admin\UserController@destroy')->name('admin.users.destroy')->middleware('can:delete,user');

    Route::get('comments', 'Admin\CommentController@index')->name('admin.comments.index');
    Route::get('comments/create', 'Admin\CommentController@create')->name('admin.comments.create')->middleware('can:create,App\Comment');
    Route::post('comments', 'Admin\CommentController@store')->name('admin.comments.store')->middleware('can:create,App\Comment');
    Route::get('comments/{comment}/edit', 'Admin\CommentController@edit')->name('admin.comments.edit')->middleware('can:update,comment');
    Route::patch('comments/update/{comment}', 'Admin\CommentController@update')->name('admin.comments.update')->middleware('can:update,comment');
    Route::delete('comments/{comment}', 'Admin\CommentController@destroy')->name('admin.comments.destroy')->middleware('can:delete,comment');
    Route::patch('comments/{comment}/toggleStatus', 'Admin\CommentController@toggleStatus')->name('admin.comments.toggleStatus')->middleware('can:toggleStatus,comment');

    Route::group(['middleware' => ['can:manage,App\Tag']], function() {
        Route::get('tags', 'Admin\TagController@index')->name('admin.tags.index');
        Route::get('tags/create', 'Admin\TagController@create')->name('admin.tags.create');
        Route::post('tags', 'Admin\TagController@store')->name('admin.tags.store');
        Route::get('tags/{tag}/edit', 'Admin\TagController@edit')->name('admin.tags.edit');
        Route::patch('tags/update/{tag}', 'Admin\TagController@update')->name('admin.tags.update');
        Route::delete('tags/{tag}', 'Admin\TagController@destroy')->name('admin.tags.destroy');
    });

    Route::group(['middleware' => ['can:manage,App\Category']], function() {
        Route::get('categories', 'Admin\CategoryController@index')->name('admin.categories.index');
        Route::get('categories/create', 'Admin\CategoryController@create')->name('admin.categories.create');
        Route::post('categories', 'Admin\CategoryController@store')->name('admin.categories.store');
        Route::get('categories/{category}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
        Route::patch('categories/update/{category}', 'Admin\CategoryController@update')->name('admin.categories.update');
        Route::delete('categories/{category}', 'Admin\CategoryController@destroy')->name('admin.categories.destroy');
    });

    Route::group(['middleware' => ['can:manage,App\Role']], function() {
        Route::get('roles', 'Admin\RoleController@index')->name('admin.roles.index');
        Route::get('roles/create', 'Admin\RoleController@create')->name('admin.roles.create');
        Route::post('roles', 'Admin\RoleController@store')->name('admin.roles.store');
        Route::get('roles/{role}/edit', 'Admin\RoleController@edit')->name('admin.roles.edit');
        Route::patch('roles/update/{role}', 'Admin\RoleController@update')->name('admin.roles.update');
        Route::delete('roles/{role}', 'Admin\RoleController@destroy')->name('admin.roles.destroy');
    });

    Route::group(['middleware' => ['can:manage,App\Permission']], function() {
        Route::get('permissions', 'Admin\PermissionController@index')->name('admin.permissions.index');
        Route::get('permissions/create', 'Admin\PermissionController@create')->name('admin.permissions.create');
        Route::post('permissions', 'Admin\PermissionController@store')->name('admin.permissions.store');
        Route::get('permissions/{permission}/edit', 'Admin\PermissionController@edit')->name('admin.permissions.edit');
        Route::patch('permissions/update/{permission}', 'Admin\PermissionController@update')->name('admin.permissions.update');
        Route::delete('permissions/{permission}', 'Admin\PermissionController@destroy')->name('admin.permissions.destroy');
    });
});
