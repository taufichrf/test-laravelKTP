<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogActivityController;

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

Route::get('/', [HomeController::class, 'welcome']);

Auth::routes([
    'register' => false
]);

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

	Route::prefix('settings')->group(function () {
		Route::get('/', [SettingController::class, 'index'])->name('setting_page');
		Route::post('saveUser', [SettingController::class, 'saveUser'])->name('save_user');
		Route::post('savePassword', [SettingController::class, 'savePassword'])->name('save_password');
	});
	
	Route::prefix('user')->group(function () {
		Route::get('/', [UserController::class, 'index'])->name('user_page')->middleware('is_admin');
		Route::post('detail', [UserController::class, 'detail'])->name('user_detail')->middleware('is_admin');
		Route::post('list', [UserController::class, 'list'])->name('user_list')->middleware('is_admin');
		Route::post('update', [UserController::class, 'update'])->name('user_update')->middleware('is_admin');
		Route::delete('delete', [UserController::class, 'delete'])->name('user_delete')->middleware('is_admin');
		Route::get('create', [UserController::class, 'create'])->name('user_create')->middleware('is_admin');
		Route::post('store', [UserController::class, 'store'])->name('user_store')->middleware('is_admin');
	});
	
	Route::prefix('data')->group(function() {
		Route::get('/', [DataController::class, 'index'])->name('data');
		Route::get('create', [DataController::class, 'create'])->name('create_data')->middleware('is_admin');
		Route::post('addData', [DataController::class, 'store'])->name('store_data')->middleware('is_admin');
		Route::post('list', [DataController::class, 'list'])->name('list_data');
		Route::post('detail', [DataController::class, 'detail'])->name('detail_data');
		Route::delete('delete', [DataController::class, 'delete'])->name('delete_data')->middleware('is_admin');
		Route::get('edit/{id}', [DataController::class, 'edit'])->name('edit_data')->middleware('is_admin');
		Route::post('editProcess/{id}', [DataController::class, 'editProcess'])->name('editProcess_data')->middleware('is_admin');
		Route::post('export', [DataController::class, 'export'])->name('export_data');
		Route::post('import', [DataController::class, 'import'])->name('import_data')->middleware('is_admin');
	});
	
	Route::prefix('log-activity')->group(function() {
		Route::get('/', [LogActivityController::class, 'index'])->name('log_activity')->middleware('is_admin');
		Route::post('list', [LogActivityController::class, 'list'])->name('list_activity')->middleware('is_admin');
		Route::post('detail', [LogActivityController::class, 'detail'])->name('detail_activity')->middleware('is_admin');
		Route::delete('delete', [LogActivityController::class, 'delete'])->name('delete_activity')->middleware('is_admin');
		
	});
});