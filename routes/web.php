<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('believers', 'Admin\BelieversController');
    Route::post('believers_mass_destroy', ['uses' => 'Admin\BelieversController@massDestroy', 'as' => 'believers.mass_destroy']);
    Route::post('believers_restore/{id}', ['uses' => 'Admin\BelieversController@restore', 'as' => 'believers.restore']);
    Route::delete('believers_perma_del/{id}', ['uses' => 'Admin\BelieversController@perma_del', 'as' => 'believers.perma_del']);
    Route::resource('product_categories', 'Admin\ProductCategoriesController');
    Route::post('product_categories_mass_destroy', ['uses' => 'Admin\ProductCategoriesController@massDestroy', 'as' => 'product_categories.mass_destroy']);
    Route::post('product_categories_restore/{id}', ['uses' => 'Admin\ProductCategoriesController@restore', 'as' => 'product_categories.restore']);
    Route::delete('product_categories_perma_del/{id}', ['uses' => 'Admin\ProductCategoriesController@perma_del', 'as' => 'product_categories.perma_del']);
    Route::resource('products', 'Admin\ProductsController');
    Route::post('products_mass_destroy', ['uses' => 'Admin\ProductsController@massDestroy', 'as' => 'products.mass_destroy']);
    Route::post('products_restore/{id}', ['uses' => 'Admin\ProductsController@restore', 'as' => 'products.restore']);
    Route::delete('products_perma_del/{id}', ['uses' => 'Admin\ProductsController@perma_del', 'as' => 'products.perma_del']);
    Route::resource('product_deliveries', 'Admin\ProductDeliveriesController');
    Route::post('product_deliveries_mass_destroy', ['uses' => 'Admin\ProductDeliveriesController@massDestroy', 'as' => 'product_deliveries.mass_destroy']);
    Route::post('product_deliveries_restore/{id}', ['uses' => 'Admin\ProductDeliveriesController@restore', 'as' => 'product_deliveries.restore']);
    Route::delete('product_deliveries_perma_del/{id}', ['uses' => 'Admin\ProductDeliveriesController@perma_del', 'as' => 'product_deliveries.perma_del']);
    Route::resource('product_orders', 'Admin\ProductOrdersController');
    Route::post('product_orders_mass_destroy', ['uses' => 'Admin\ProductOrdersController@massDestroy', 'as' => 'product_orders.mass_destroy']);
    Route::post('product_orders_restore/{id}', ['uses' => 'Admin\ProductOrdersController@restore', 'as' => 'product_orders.restore']);
    Route::delete('product_orders_perma_del/{id}', ['uses' => 'Admin\ProductOrdersController@perma_del', 'as' => 'product_orders.perma_del']);


});
