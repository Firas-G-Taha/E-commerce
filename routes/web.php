<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UpdatingUserController;
// use App\Models\ProductUser; // move to controller
// use App\Models\SubCategory; // move to controller
use App\Models\Product; // move to controller

// Route::get('/', [CategoryController::class,'index']);
Route::group([
    'prefix' => "/admin",
    'middleware' => ['auth','admin']],
    function(){
        //categories routes
        Route::get('/', [CategoriesController::class, 'redirectToIndex']);
        Route::get('/categories/delete/{id}',[CategoriesController::class,'destroy']);
        Route::resource('/categories', CategoriesController::class);
      
        //subcategory routs
        Route::get('/subcategories/delete/{id}',[SubCategoriesController::class,'destroy']);
        Route::resource('/subcategories', SubCategoriesController::class);
    
        //products routs for admin
        Route::post('/products/storeproductimages/{product}', [ProductController::class , 'storeProductImage']);
        Route::delete('/products/deleteProductimage/{product}', [ProductController::class , 'deleteProductImage']);
        Route::post('/products/create', [ProductController::class , 'passingSubCategoriesToCreate']);
        Route::resource('/products', ProductController::class);

        //manage user routs
        Route::get('/users', [UsersController::class ,'index']);
        Route::patch('/users/makeAdmin/{user}', [UsersController::class ,'makeAdmin']);
        Route::patch('/users/removeAdmin/{user}', [UsersController::class ,'removeAdmin']);
        Route::delete('/users/destroy/{user}', [UsersController::class ,'delete']);
    });

Route::group([
    'middleware' => ['auth'],
], function(){
    Route::post('/addToCart/{product}',[CustomerController::class, 'addToCart']);
    Route::get('/customers/Cart',[CustomerController::class, 'showCart']);
    Route::get('/customers/deleteFromCart/{product}',[CustomerController::class, 'deleteFromCart']);
    Route::get('customers/checkout', [CustomerController::class, 'checkOut']);
    Route::post('/update_quantity',[CustomerController::class, 'updateQuantity']);
});

//customer routs
Route::get('/',[CustomerController::class , 'index']);
//categories route
Route::get('/category/{category}',[CustomerController::class, 'showcategory']);
Route::post('/category',[CustomerController::class, 'showSubCategoryProducts']);
//product route
Route::get('/product/{product}',[CustomerController::class, 'showProduct']);
//customer categories display
Route::get('/categories',[CustomerController::class, 'showCategories']);

Route::get('/search',[CustomerController::class,'search']);

//to update user info
// Route::post('update info',[UpdatingUserController::class,'update']);


//->middleware(['auth' , 'admin']);
//e-commerce route

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Route::get('/search',function(){
//     $search = Request()->get('search');
//     $search = trim($search);
//     $search = str_replace('%20','%',$search);
//     $products = Product::where('name','LIKE','%'.$search."%")->orWhere('description','LIKE','%'.$search."%")->orderBy('id','DESC')->get();
//     return $products;
// });
require __DIR__.'/auth.php';



//shoping cart review