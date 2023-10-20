<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
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

Auth::routes();

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/password-login', [AuthController::class, 'passwordLogin']);

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
  Route::get('/', [HomeController::class, 'root'])->name('root');
  Route::redirect('/index', '/');

  Route::get('/create-ticket', [TicketController::class, 'create_ticket'])->name('root');

  Route::get('/report-test', [ReportController::class, 'index_test'])->name('report_test');

  Route::get('/master/kategori', [MasterDataController::class, 'master_kategori']);
  Route::post('/submit-kategori', [MasterDataController::class, 'submit_kategori']);
  Route::post('/edit-kategori', [MasterDataController::class, 'edit_kategori']);
  Route::post('/delete-kategori', [MasterDataController::class, 'delete_kategori']);

  Route::get('/master/sub-kategori', [MasterDataController::class, 'master_sub_kategori']);
  Route::post('/submit-sub-kategori', [MasterDataController::class, 'submit_sub_kategori']);
  Route::post('/edit-sub-kategori', [MasterDataController::class, 'edit_sub_kategori']);
  Route::post('/delete-sub-kategori', [MasterDataController::class, 'delete_sub_kategori']);

  Route::get('{any}', [HomeController::class, 'index'])->name('index');
});
