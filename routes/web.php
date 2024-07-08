<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ApplicationController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::group(
    ['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.'], 
    function () {
        Route::resources([
            'users' => UserController::class,
            'roles' => RoleController::class,
            'applications' => ApplicationController::class,
        ], ['show']);

        // export
        Route::get('users/excel/export', [UserController::class, 'exportExcel'])->name('users.export.excel');

    }
);

require __DIR__.'/auth.php';
