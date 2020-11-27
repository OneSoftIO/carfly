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
Route::group(['prefix' => 'administruoti', 'middleware' => ['auth','admin']], function () {
	$admin = 'Admin';

	Route::get('/', $admin.'\DashboardController@Page')->name('admin.dashboard');
	Route::get('/help', $admin.'\DashboardController@PageHelp')->name('admin.help');
	//Subscribers
	Route::get('/subscribers', $admin.'\SubscribersController@Page')->name('admin.subscribers');
	Route::get('/subscribers/mail', $admin.'\SubscribersController@PageMail')->name('admin.mail');
	Route::get('/subscribers/remove/{id}', $admin.'\SubscribersController@remove')->name('admin.subscriber.remove');
	//Users
	Route::resource('/users', $admin.'\UsersController');
	Route::get('/users/{id}/destroy', $admin.'\UsersController@destroy')->name('users.destroy');
//	Route::get('/users', $admin.'\UsersController@Page')->name('admin.users');
//	Route::get('/users/create', $admin.'\UsersController@PageCreateUser')->name('admin.user.create');
	//Pages
	Route::get('/pages', $admin.'\PostsController@Page')->name('admin.pages');
	Route::get('/pages/create/{lang}', $admin.'\PostsController@PageCreate')->name('admin.page.create');
	Route::post('/pages/create/save', $admin.'\PostsController@AddPageToDB')->name('admin.page.save');
	//Posts
	Route::get('/posts', $admin.'\PostsController@PostPage')->name('admin.posts');
	Route::get('/posts/create', $admin.'\PostsController@PostCreate')->name('admin.post.create');
    Route::post('/posts/create/save', $admin.'\PostsController@AddPostToDB')->name('admin.post.save');
    Route::get('/post/delete/{id}', $admin.'\PostsController@DeletePost')->name('admin.post.delete');
    Route::get('/post/delete/image/{id}', $admin.'\PostsController@DeletePostImage')->name('admin.delete.post.image');
    Route::get('/post/edit/{id}/{lang}', $admin.'\PostsController@PostEdit')->name('admin.post.edit');
    Route::post('/post/edit/save/{id}', $admin.'\PostsController@PostEditSave')->name('admin.post.edit.save');

	//Categories
	Route::get('/category', $admin.'\CategoryController@Page')->name('admin.category');
	Route::get('/category/create', $admin.'\CategoryController@PageCreate')->name('admin.category.create');
	Route::post('/category/create/save', $admin.'\CategoryController@TermSave')->name('admin.category.save');
	Route::get('/category/edit/{id}/{lang}', $admin.'\CategoryController@TermEdit')->name('admin.category.edit');
	Route::post('/category/edit/save/{id}', $admin.'\CategoryController@TermEditSave')->name('admin.category.edit.save');
	//Global
    Route::get('/delete/{table}/{id}', $admin.'\GlobalController@DeleteRowFromTable')->name('admin.delete');

    //
    Route::get('/vehicles', $admin.'\VehiclesController@Page')->name('admin.vehicles');
    Route::get('/vehicles/create', $admin.'\VehiclesController@PageCreate')->name('admin.vehicles.create');
    Route::post('/vehicles/create/save', $admin.'\VehiclesController@CreateVehicle')->name('admin.vehicles.save');
    Route::get('/vehicles/category/{lang}', $admin.'\VehiclesController@PageCategory')->name('admin.vehicles.category');
    Route::post('/vehicles/category/save', $admin.'\VehiclesController@AddCategory')->name('admin.vehicles.category.save');
    Route::get('/vehicles/edit/{id}/{lang}', $admin.'\VehiclesController@EditVehicle')->name('admin.vehicles.edit');
    Route::post('/vehicles/edit/{id}/save', $admin.'\VehiclesController@SaveEditedVehicle')->name('admin.vehicles.edit.save');
    Route::get('/vehicles/{id}/images/delete/{sk}', $admin.'\VehiclesController@DeleteVehicleImage')->name('admin.vehicles.image.delete');
    //Settings
    Route::get('/settings', $admin.'\SettingsController@Page')->name('admin.settings');
    Route::post('/settings/save', $admin.'\SettingsController@SettingsSave')->name('admin.settings.save');
    Route::post('/settings/delete/row/{name}', $admin.'\SettingsController@DeleteDelivery')->name('admin.settings.delivery.delete');
    Route::post('/settings/upload/image', $admin.'\SettingsController@UploadImage');
    //Orders
    Route::get('/orders', $admin.'\OrdersController@Page')->name('admin.orders');
    Route::get('/orders/remove/{id}', $admin.'\OrdersController@remove')->name('admin.orders.remove');

    //Lease
    Route::get('/lease', $admin.'\LeaseController@Page')->name('admin.lease');
    Route::get('/lease/add', $admin.'\LeaseController@Reserve')->name('admin.lease.add');
    Route::post('/lease/add/save', $admin.'\LeaseController@ReserveSave')->name('admin.lease.add.save');
    Route::get('/lease/edit/{id}', $admin.'\LeaseController@ReserveEdit')->name('admin.lease.edit');
    Route::post('/lease/edit/{id}/save', $admin.'\LeaseController@ReserveUpdate')->name('admin.lease.edit.update');
    Route::get('/lease/remove/{id}', $admin.'\LeaseController@RemoveReservation')->name('admin.lease.remove');
    //Meta
    Route::get('/meta', $admin.'\MetaController@index')->name('admin.meta');
    Route::post('/meta', $admin.'\MetaController@updateMetaData');


    Route::post('/calendar/data', $admin.'\DashboardController@getCalendarList');

});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/signout', 'IndexController@Logout')->name('main.logout');
});
Auth::routes();

Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
    ],
    function() {
    Route::get('/', 'IndexController@MainPage')->name('main.page');
    Route::get(LaravelLocalization::transRoute('routes.single_page'), 'IndexController@OtherPage')->name('other.page');

//    Route::get('/home', 'HomeController@index')->name('home');
    //Blogs
    Route::get(LaravelLocalization::transRoute('routes.articles'), 'BlogController@Page')->name('blog.page');
    Route::get(LaravelLocalization::transRoute('routes.article'), 'BlogController@PageBlogPost')->name('blog.post.page');
    Route::get(LaravelLocalization::transRoute('routes.category'), 'BlogController@catIndex')->name('blog.cat');
    //Contacts
    Route::get(LaravelLocalization::transRoute('routes.contact'), 'ContactController@Page')->name('contact.page');
    //Cars
    Route::get(LaravelLocalization::transRoute('routes.cars'), 'CarsController@Page')->name('cars.page');
    Route::get(LaravelLocalization::transRoute('routes.car'), 'CarsController@PageCar')->name('car.page');
    Route::get('order/{order}', 'PaymentsController@show')->name('order');


});
//Order
Route::get('checkout', 'PaymentsController@Checkout')->name('checkout');

Route::post('order/{order}', 'PaymentsController@submit')->name('submit.payment');
Route::post('/reserve/{id}', 'CarsController@Reserve')->name('car.page.reserve');
Route::post('/vehicle/price', 'CarsController@GetPrice');

// Payment
Route::get('payment/callback/{order}', 'PaymentsController@callback')->name('payment.callback');
Route::get('payment/accept/{order}', 'PaymentsController@accept')->name('payment.accept');
Route::get('payment/cancel/{order}', 'PaymentsController@cancel')->name('payment.cancel');
Route::get('payment/{order}', 'PaymentsController@redirect')->name('payment');

//AJAX
Route::post('/kontaktai/send', 'ContactController@SendMail')->name('send.email');
Route::post('/prenumeruoti', 'ContactController@Subscribe')->name('subscribe');
Route::post('/get-vehicles', 'IndexController@getVehicles');



