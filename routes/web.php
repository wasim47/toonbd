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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'Index@index')-> name('home');
Route::get('management', 'Index@management')->name('management');
Route::get('service/{id}', 'Index@service_details')->name('service');
Route::get('circular', 'Index@circular')->name('circular');
Route::get('photos', 'Index@photos')->name('photos');
Route::get('videos', 'Index@videos')->name('videos');
Route::get('product', 'Index@product')->name('product');
Route::get('product/{id}', 'Index@product_details')->name('product.details');
Route::get('employee', 'Index@employee')->name('employee');

Route::get('content', 'Index@index')->name('home');
Route::get('content/{slug}', 'Index@contents')->name('websitecontent');
Route::get('content/{slug}/{sslug}', 'Index@contents')->name('websitecontent');
Route::get('content/{slug}/{sslug}/{ssslug}', 'Index@contents')->name('websitecontent');

Route::get('news', 'Index@news')->name('news');
Route::get('news/{slug}', 'Index@news_details')->name('news.details');

Route::any('userapprove', 'CommonController@permissions')->name('user.approve');
Route::any('usersapprove', 'CommonController@permissionsUser')->name('users.approve');
Route::get('testingdata', 'CommonController@updateSlug');
Route::any('masterdelete', 'CommonController@deletedata')->name('masterdelete');


//////////////////////////////////////////////////////////////////////////////////// Admin Routing Areas ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('administration', 'Auth\LoginController@showLoginForm')->name('administration');
Route::post('adminlogin', 'Auth\LoginController@login')->name('adminlogin');

//Auth::routes();
Route::group(['prefix' => 'administration',  'middleware' => 'auth:administration'], function()
{
	Route::post('/logout', ['uses' => 'Auth\LoginController@logout'])->name('administration.logout');
	Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);
	Route::post('/', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);
	
	Route::post('/password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
	Route::get('/password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
	Route::post('/password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
	Route::get('/password/reset/{token}', ['as' => 'password.reset','uses' => 'Auth\ResetPasswordController@showResetForm']);
	
	// Registration Routes...
	Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
	Route::post('register', ['as' => '', 'uses' => 'Auth\RegisterController@register']);
	
	Route::any('masterdelete', 'CommonController@deletedata');
	Route::any('permissions', 'CommonController@permissions')->name('permissions');
	Route::any('permissionsuser', 'CommonController@permissionsUser')->name('permissionsuser');
	
	Route::get('/article/ajaxsearch','ArticleController@searchajax')->name('article.ajaxsearch');
	
	Route::resource('admins','AdminController');
	Route::resource('menus','MenusController');
	Route::resource('contents','ContentController');
	Route::resource('banner','BannerController');
	Route::resource('employee','EmployeeController');
	Route::resource('usefulllink','UsefulllinkController');
	Route::resource('blog','BlogController');
	Route::resource('circular','CircularController');
	Route::resource('service','ServiceController');
	Route::resource('director','StaffController');
	Route::resource('product','ProductController');
	Route::resource('management','ManagementController');
	Route::resource('partner','PartnerController');
	Route::resource('protfolio','ProtfolioController');
	Route::resource('photogalery','PhotoGalleryController');
	Route::resource('gallery','GalleryController');
	Route::resource('counter','CounterController');	
	Route::resource('video','VideoController');	
	Route::get('/ajaxmenu','MenusController@searchmenu')->name('menu.ajaxmenu');
});
