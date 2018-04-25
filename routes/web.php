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
// instead of changing default route after login/register in its respective Middleware file,
// we redirect any request to 'home' to dashboard's home url
Route::get('home', function () {
    $dashboard_url = config('adminlte.dashboard_url');
    return redirect($dashboard_url);
});

Auth::routes();

// DASHBOARD
Route::get('/', 'HomeController@index')->name('home');
// FACEBOOK
Route::get('sosmed/facebook', 'FacebookController@getIndex')->name('facebook');
// TWITTER
Route::get('sosmed/twitter', 'TwitterController@getIndex')->name('twitter');

// MAINSTREAM MEDIA
Route::get('mainmedia', 'MainmediaController@getIndex')->name('mainmedia');
Route::get('mainmedia/khofifah', 'MainmediaController@getMediaKhofifah');
Route::get('mainmedia/gusipul', 'MainmediaController@getMediaIpul');
Route::get('mainmedia/emil', 'MainmediaController@getMediaEmil');
Route::get('mainmedia/puti', 'MainmediaController@getMediaPuti');
// YOUTUBE
Route::get('sosmed/youtube', 'YoutubeController@getIndex')->name('youtube');
// GPLUS
Route::get('sosmed/gplus', 'GplusController@getIndex')->name('gplus');