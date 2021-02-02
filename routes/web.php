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

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/admin', function () {
    return redirect('/admin/user');
});

Auth::routes(['verify' => true]);
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('agregarfoto', 'admin\ProductsController@agregarfoto');

Route::get('home', 'HomeController@index')->name('home');
Route::resource('loguser', 'frontend\LoguserController');
Route::resource('reset', 'frontend\NewPasswordController');
Route::resource('register', 'frontend\RegisterController');
// Route::resource('company', 'frontend\CompanyController');
Route::get('company', 'frontend\CompanyController@index')->name('company');

Route::get('category/{id}', 'frontend\CateController@index')->name('cate');
Route::get('subcategory/{id}', 'frontend\SubController@index')->name('sub');
Route::get('product/{id}', 'frontend\ProductController@index')->name('product');
Route::get('search', 'frontend\SearchController@index')->name('search');
Route::get('/forgot_password', 'frontend\ForgotPasswordController@forgot');
Route::post('/forgot_password', 'frontend\ForgotPasswordController@password');

Route::get('frecuent', 'frontend\FrecuentController@index')->name('frecuent');


Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
         Route::middleware(['checkAdmin'])->group(function () {

            Route::get('upload-image','ProductsController@image');
            Route::post('upload-image',['as'=>'image.upload','uses'=>'admin\ProductsController@uploadImages']);

            Route::resource('user', 'admin\UserController');

            Route::get('indexImages/{product_id}', 'admin\ProductsController@indexImages')->name('indexImages');
            Route::post('addImage', 'admin\ProductsController@addImage')->name('addImage');
            Route::delete('deleteImage/{id}', 'admin\ProductsController@deleteImage')->name('deleteImage');

            Route::resource('categories', 'admin\CategoriesController');
            Route::post('category_visible', 'admin\CategoriesController@setCategoryVisible')->name('category_visible');
            Route::post('subcategory_visible', 'admin\SubController@setSubcategoryVisible')->name('subcategory_visible');
            Route::post('product_visible', 'admin\ProductsController@setProductVisible')->name('product_visible');
            Route::post('setMainImage', 'admin\ProductsController@setMainImage')->name('setMainImage');
            
            Route::resource('slider', 'admin\SliderController');

            Route::resource('contact', 'admin\ContactController');
            Route::delete('contactDelete/{id}', 'admin\ContactController@destroy')->name('contactDelete');

            Route::resource('products', 'admin\ProductsController');
            Route::resource('sub', 'admin\SubController');
        });
    // });
      
    });
});


Route::middleware(['auth'])->group(function () {
    
    Route::get('favorites', 'frontend\FavoritesController@index')->name('favorites');
    Route::get('favoritesAction/{id}', 'frontend\FavoritesController@favoritesAction')->name('favoritesAction');

    Route::get('cart', 'frontend\CartController@index')->name('cart');
    Route::get('cartAction/{id}', 'frontend\CartController@carritoAction')->name('cartAction');

    Route::post('product_favorite', 'frontend\FavoritesController@setFavoriteProduct')->name('product_favorite');

    Route::get('profile', 'frontend\ProfileController@index')->name('profile');
    Route::post('profile', 'frontend\ProfileController@update')->name('profile_update');

    Route::post('changeProductQuantity','frontend\CartController@changeProductQuantity')->name('changeProductQuantity');

    Route::get('contact', 'frontend\ContactController@index')->name('contact');
    Route::post('contact_post', 'frontend\ContactController@store')->name('contact_post');
    
});

Route::get('getSub_CategoriesByCategory', 'admin\SubController@getSub_CategoriesByCategory')->name('getSub_CategoriesByCategory');