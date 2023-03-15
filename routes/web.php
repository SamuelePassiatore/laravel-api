<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\ProfileController;
use App\Models\Technology;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestHomeController::class, 'index']);


// Protected routes
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('/admin')->group(function () {
    // Dashboard routes
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
    // Toggle routes
    Route::patch('/projects/{project}/toggle', [ProjectController::class, 'toggle'])->name('projects.toggle');
    //TRASH PROJECTS
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash.index');
    Route::patch('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.trash.restore');
    Route::delete('/projects/{project}/drop', [ProjectController::class, 'drop'])->name('projects.trash.drop');
    Route::delete('/projects/drop', [ProjectController::class, 'dropAll'])->name('projects.trash.dropAll');
    // Project routes
    Route::resource('projects', ProjectController::class);
    //TRASH TYPES
    Route::get('/types/trash', [TypeController::class, 'trash'])->name('types.trash.index');
    Route::patch('/types/{type}/restore', [TypeController::class, 'restore'])->name('types.trash.restore');
    Route::delete('/types/{type}/drop', [TypeController::class, 'drop'])->name('types.trash.drop');
    Route::delete('/types/drop', [TypeController::class, 'dropAll'])->name('types.trash.dropAll');
    // Types routes
    Route::resource('types', TypeController::class);
    //Color types route
    Route::patch('/types/{type}/patch', [TypeController::class, 'patch'])->name('types.patch');
    //TRASH TECHNOLOGIES
    Route::get('/technologies/trash', [TechnologyController::class, 'trash'])->name('technologies.trash.index');
    Route::patch('/technologies/{technology}/restore', [TechnologyController::class, 'restore'])->name('technologies.trash.restore');
    Route::delete('/technologies/{technology}/drop', [TechnologyController::class, 'drop'])->name('technologies.trash.drop');
    Route::delete('/technologies/drop', [TechnologyController::class, 'dropAll'])->name('technologies.trash.dropAll');
    // Technologies routes
    Route::resource('technologies', TechnologyController::class);
    //Color technologies route
    Route::patch('/technologies/{technology}/patch', [TechnologyController::class, 'patch'])->name('technologies.patch');
});

// Profile routes
Route::middleware('auth')->name('profile.')->prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
