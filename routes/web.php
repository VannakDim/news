<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserAuthController;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
Route::get('/blog/{id}', [HomeController::class, 'singleblog'])->name('home.blog.single');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/tag/{tag}', [SearchController::class, 'filter_by_tag'])->name('filter_by_tag');
Route::get('/category/{category}', [SearchController::class, 'filter_by_category'])->name('filter_by_category');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('admin.index', compact('users'));
    })->name('dashboard');

    Route::get('/slider/all', [SliderController::class, 'index'])->name('all.slider');
    Route::get('/slider/get/{id}', [SliderController::class, 'get_slider_data'])->name('get_slider_data');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('store.slider');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit']);
    Route::post('/slider/update/{id}', [SliderController::class, 'update']);
    Route::post('/slider/update_slider', [SliderController::class, 'update_slider'])->name('update_slider');
    Route::get('/slider/softDel/{id}', [SliderController::class, 'softDelete']);

    Route::get('/brand/all', [BrandController::class, 'index'])->name('all.brand');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('store.brand');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::post('/brand/update/{id}', [BrandController::class, 'update']);
    Route::get('/brand/softDel/{id}', [BrandController::class, 'softDelete']);

    Route::get('/service/all', [ServiceController::class, 'index'])->name('all.service');
    Route::get('/service/add', [ServiceController::class, 'add'])->name('add.service');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('store.service');
    Route::get('/service/get/{id}', [ServiceController::class, 'get_service_data']);
    Route::post('/service/update', [ServiceController::class, 'update_service'])->name('update_service');
    Route::get('/service/softDel/{id}', [ServiceController::class, 'softDelete']);

    Route::get('/about-item-page', function () {
        return view('admin.about.items');
    });
    Route::get('/about/item', [AboutController::class, 'about_item'])->name('about_item');
    Route::post('/about/store/item', [AboutController::class, 'store_item'])->name('store.item');

    Route::get('/about/all', [AboutController::class, 'index'])->name('all.about');
    Route::get('/about/add', [AboutController::class, 'add'])->name('add.about');
    Route::post('/about/store', [AboutController::class, 'store'])->name('store.about');
    Route::get('/about/edit/{id}', [AboutController::class, 'edit']);
    Route::post('/about/update/{id}', [AboutController::class, 'update']);
    Route::get('/about/softDel/{id}', [AboutController::class, 'softDelete']);
    Route::get('/about/softDel/item/{id}', [AboutController::class, 'softDelete']);

    Route::get('/team/all', [TeamController::class, 'index'])->name('all.team');
    Route::get('/team/get/{id}', [TeamController::class, 'get_team'])->name('get_team');
    Route::post('/team-store', [TeamController::class, 'store'])->name('store.team');
    Route::post('/team/update/', [TeamController::class, 'update'])->name('update.team');
    Route::get('/team/softDel/{id}', [TeamController::class, 'softDelete']);
    Route::get('/team/add', function () {
        return view('admin.team.add');
    })->name('add.team');

    Route::get('/contact/edit', [ContactController::class, 'edit'])->name('edit.contact');
    Route::post('/contact/update/{id}', [ContactController::class, 'update']);

    Route::get('/post/all', [PostController::class, 'index'])->name('all.post');
    Route::get('/post/edit/{id}', [PostController::class, 'page_edit']);
    Route::get('/post/add', [PostController::class, 'page_add'])->name('page.add-post');
    Route::post('/post/store', [PostController::class, 'store'])->name('store.post');
    Route::post('/post/update/{id}', [PostController::class, 'update']);
    Route::get('/post/softDel/{id}', [PostController::class, 'softDelete']);

    Route::get('/product/all', [ProductController::class, 'index'])->name('all.product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('create.product');
    Route::get('/product/model/show', [ProductModelController::class, 'index'])->name('model.show');
    Route::get('/product/model/edit/{id}', [ProductModelController::class, 'edit'])->name('model.edit');
    Route::post('/product/model/update/{id}', [ProductModelController::class, 'update'])->name('model.update');
    Route::get('/product/softDel/{id}', [ProductModelController::class, 'softDelete']);
    Route::get('/product/model', [ProductModelController::class, 'create'])->name('product.model');
    Route::post('/product/store', [ProductModelController::class, 'store'])->name('store.model');

    Route::get('/product/stock-in', [StockInController::class, 'create'])->name('stockin.create');
    Route::post('/product/stock-in/store', [StockInController::class, 'store'])->name('stockin.store');

    Route::get('/product/stock-out', [StockOutController::class, 'create'])->name('stockout.create');
    Route::post('/product/stock-out/store', [StockOutController::class, 'store'])->name('stockout.store');

    

    Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
});
