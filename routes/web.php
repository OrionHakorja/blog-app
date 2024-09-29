<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Get paginated blogs (9 per page)
    $blogs = Blog::paginate(9);

    // Pass the blogs to the 'test' view
    return view('test')->with([
        'blogs' => $blogs
    ]);
})->name('test');

/**
 * Search route to allow users to search for blogs based on input.
 *
 * This route uses the 'search' method in BlogController.
 *
 * @see BlogController::search
 */
Route::get('/search', [BlogController::class, 'search'])->name('blogs.search');


// Authenticated (Protected) Routes

/**
 * All routes defined within this group require the user to be authenticated.
 *
 * These routes include:
 * - Viewing the user's blogs.
 * - Creating a new blog.
 * - Editing, updating, and deleting existing blogs.
 */
Route::middleware('auth')->group(function () {

    /**
     * Displays a list of blogs belonging to the authenticated user.
     *
     * @see BlogController::index
     */
    Route::get('/myblogs', [BlogController::class, 'index'])->name('blogs.index');

    /**
     * Displays a form for creating a new blog.
     *
     * @see BlogController::create
     */
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');

    /**
     * Handles the form submission to create a new blog in the database.
     *
     * @see BlogController::store
     */
    Route::post('/blogs/create', [BlogController::class, 'store'])->name('blogs.store');

    /**
     * Displays a form for editing an existing blog.
     *
     * @param  int  $blog  The ID of the blog to edit.
     * @see BlogController::edit
     */
    Route::get('/blogs-edit/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');

    /**
     * Handles the form submission to update an existing blog.
     *
     * @param  int  $blog  The ID of the blog to update.
     * @see BlogController::update
     */
    Route::put('/blogs-edit/{blog}', [BlogController::class, 'update'])->name('blogs.update');

    /**
     * Deletes a specified blog from the database.
     *
     * @param  int  $blog  The ID of the blog to delete.
     * @see BlogController::delete
     */
    Route::delete('/blogs-delete/{blog}', [BlogController::class, 'delete'])->name('blogs.delete');
});

Route::middleware('admin')->group(function (){
    Route::get('/admin.dashboard', function (){
        $blogs = Blog::paginate(9);
        return view('admin.dashboard')->with([
            'blogs' => $blogs
        ]);
    })->name('admin.dashboard');
    Route::get('/search.admin', [AdminController::class, 'search'])->name('blogs.search2');
    Route::delete('delete/{post}', [AdminController::class, 'delete'])->name('admin.delete');
});

require __DIR__.'/auth.php';
