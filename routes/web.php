<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('frontend.index');
// });

//todo: frontend routes

Route::get('/', [HomeController::class, 'Home'])->name('home');

Route::get('/about', [AboutController::class, 'HomeAbout'])->name('home.about');

Route::get('/portfolio', [PortfolioController::class, 'HomePortfolio'])->name('home.portfolio');

Route::get('/portfolio/details/{id}', [PortfolioController::class, 'PortfolioDetails'])->name('portfolio.details');

Route::get('/blog', [BlogController::class, 'HomeBlog'])->name('home.blog');

Route::get('/blog/details/{id}', [BlogController::class, 'BlogDetails'])->name('blog.details');

Route::get('/category/blog/{id}', [BlogController::class, 'CategoryBlog'])->name('category.blog');

Route::get('/contact', [ContactController::class, 'Contact'])->name('contact.me');

Route::post('/store/message', [ContactController::class, 'StoreMessage'])->name('store.message');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // todo: admin profile route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// todo: Home Slide All Route
    Route::controller(HomeSliderController::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/home/slide', 'HomeSlider')->name
                ('home.slide');

            Route::post('/update/slide', 'UpdateSlider')->name('update.slider');

        });
    });

// todo: Admin All Route
    Route::controller(AdminController::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/logout', 'destroy')->name('admin.logout');
            Route::get('/profile', 'Profile')->name('admin.profile');
            Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
            Route::post('/store/profile', 'StoreProfile')->name('store.profile');

            Route::get('/change/password', 'ChangePassword')->name('change.password');
            Route::post('/update/password', 'UpdatePassword')->name('update.password');
        });
    });

// todo: About Page All Route
    Route::controller(AboutController::class)->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/about/page', 'AboutPage')->name('about.page');

            Route::post('/update/about', 'UpdateAbout')->name('update.about');

            Route::get('/about/multi/image', 'AboutMultiImage')->name('about.multi.image');

            Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image');

            Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');

            Route::get('/edit/multi/image/{id}', 'EditMultiImage')->name('edit.multi.image');

            Route::post('/update/multi/image', 'UpdateMultiImage')->name('update.multi.image');

            Route::get('/delete/multi/image/{id}', 'DeleteMultiImage')->name('delete.multi.image');

        });
    });

// todo: Portfolio Page All Route
    Route::controller(PortfolioController::class)->group(function () {

        Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');

        Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');

        Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');

        Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');

        Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');

        Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');

    });

// todo: blog category routes
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/all/blog/category', 'AllBlogCategory')->name
                ('all.blog.category');

            Route::get('/add/blog/category', 'AddBlogCategory')->name('add.blog.category');

            Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');

            Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');

            Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')->name('update.blog.category');

            Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');

        });
    });

// todo: blog routes
    Route::controller(BlogController::class)->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/all/blog', 'AllBlog')->name
                ('all.blog');

            Route::get('/add/blog', 'AddBlog')->name('add.blog');

            Route::post('/store/blog', 'StoreBlog')->name('store.blog');

            Route::get('/edit/blog/{id}', 'EditBlog')->name('edit.blog');

            Route::post('/update/blog', 'UpdateBlog')->name('update.blog');

            Route::get('/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');

        });
    });

// todo: footer routes
    Route::controller(FooterController::class)->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/footer/setup', 'FooterSetup')->name
                ('footer.setup');

            Route::post('/update/footer', 'UpdateFooter')->name('update.footer');

        });
    });

// todo: contact routes
    Route::controller(ContactController::class)->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/contact/message', 'ContactMessage')->name
                ('contact.message');

            Route::get('/delete/message/{id}', 'DeleteMessage')->name('delete.message');

        });
    });

});

require __DIR__ . '/auth.php';
