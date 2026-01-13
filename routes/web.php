<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/blog', [PortfolioController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [PortfolioController::class, 'showBlog'])->name('blog.show');
Route::post('/contact', [PortfolioController::class, 'contact'])->name('contact.send');
Route::get('/sitemap.xml', [PortfolioController::class, 'sitemap'])->name('sitemap');
Route::post('/logout', [PortfolioController::class, 'logout'])->name('logout');
Route::get('/messages', [ChatController::class, 'fetchMessages']);
Route::post('/messages', [ChatController::class, 'sendMessage']);
Route::post('/chat/register', [ChatController::class, 'register']);
Route::post('/admin-reply', [ChatController::class, 'reply']);
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Chat
    Route::get('/chat', [AdminController::class, 'chat'])->name('admin.chat');
    
    // Profile
    Route::get('/profile', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    // Articles
    Route::get('/articles', [AdminController::class, 'articles'])->name('admin.articles');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('admin.articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('admin.articles.store');
    Route::get('/articles/{id}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');
    Route::post('/articles/{id}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::get('/articles/{id}/delete', [AdminController::class, 'deleteArticle'])->name('admin.articles.delete');
    
    // Testimonials
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('admin.testimonials');
    Route::get('/testimonials/create', [AdminController::class, 'createTestimonial'])->name('admin.testimonials.create');
    Route::post('/testimonials', [AdminController::class, 'storeTestimonial'])->name('admin.testimonials.store');
    Route::get('/testimonials/{id}/delete', [AdminController::class, 'deleteTestimonial'])->name('admin.testimonials.delete');

    // Projects
    Route::get('/projects', [AdminController::class, 'projects'])->name('admin.projects');
    Route::get('/projects/create', [AdminController::class, 'createProject'])->name('admin.projects.create');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('admin.projects.store');
    Route::get('/projects/{id}/edit', [AdminController::class, 'editProject'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
    Route::delete('/projects/{id}', [AdminController::class, 'deleteProject'])->name('admin.projects.delete');
});
