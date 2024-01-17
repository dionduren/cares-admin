<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Dashboard\HelpdeskController;
use App\Http\Controllers\Dashboard\TeamLeadController;
use App\Http\Controllers\Dashboard\TechnicalController;

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
Route::post('/password-login', [AuthController::class, 'main_login']);

// Routes that require authentication
Route::middleware(['auth'])->group(
  function () {
    Route::get('/', [HomeController::class, 'root'])->name('root');
    Route::redirect('/index', '/');

    Route::get('/create-ticket', [TicketController::class, 'create_ticket'])->name('create_ticket');
    Route::get('/create-ticket-problem', [TicketController::class, 'create_ticket_problem'])->name('create_ticket_problem');

    Route::get('/tiket/detail/{id}', [TicketController::class, 'detail_ticket']);
    Route::get('/tiket/revise/{id}', [TicketController::class, 'revise_ticket']);
    Route::get('/ticket/self', [TicketController::class, 'index_self']);
    Route::get('/download-file/{filename}', [TicketController::class, 'downloadFile']);

    Route::get('/helpdesk/ticket/new', [HelpdeskController::class, 'index_new']);
    Route::get('/helpdesk/ticket/detail/{id}', [HelpdeskController::class, 'detail_tiket']);
    Route::get('/helpdesk/ticket/ongoing', [HelpdeskController::class, 'index_ongoing']);
    Route::get('/helpdesk/ticket/resolved', [HelpdeskController::class, 'index_resolved']);
    Route::get('/helpdesk/ticket/all', [HelpdeskController::class, 'index_all']);

    Route::get('/leader/ticket/new', [TeamLeadController::class, 'index_new']);
    Route::get('/leader/ticket/detail/{id}', [TeamLeadController::class, 'detail_tiket']);
    Route::get('/leader/ticket/ongoing', [TeamLeadController::class, 'index_ongoing']);
    Route::get('/leader/ticket/resolved', [TeamLeadController::class, 'index_resolved']);
    Route::get('/leader/ticket/all', [TeamLeadController::class, 'index_all']);

    Route::get('/technical/ticket/assigned', [TechnicalController::class, 'index_assigned']);
    Route::get('/technical/ticket/detail/{id}', [TechnicalController::class, 'ticket_detail']);
    Route::get('/technical/ticket/resolved', [TechnicalController::class, 'index_resolved']);
    Route::get('/technical/ticket/all', [TechnicalController::class, 'index_all']);

    Route::get('/report-test', [ReportController::class, 'index_test'])->name('report_test');

    Route::get('/master/ticket-list', [MasterDataController::class, 'helpdesk_ticket_list']);
    Route::get('/master/ticket-list-test', [MasterDataController::class, 'helpdesk_ticket_list_test']);

    Route::get('/master/kategori', [MasterDataController::class, 'master_kategori']);
    Route::post('/submit-kategori', [MasterDataController::class, 'submit_kategori']);
    Route::post('/edit-kategori', [MasterDataController::class, 'edit_kategori']);
    Route::post('/delete-kategori', [MasterDataController::class, 'delete_kategori']);

    Route::get('/master/sub-kategori', [MasterDataController::class, 'master_sub_kategori']);
    Route::post('/submit-sub-kategori', [MasterDataController::class, 'submit_subkategori']);
    Route::post('/edit-sub-kategori', [MasterDataController::class, 'edit_subkategori']);
    Route::post('/delete-sub-kategori', [MasterDataController::class, 'delete_subkategori']);


    Route::get('/master/hari-libur', [MasterDataController::class, 'master_sub_kategori']);

    Route::get('/sadmin/activity-history', [SuperAdminController::class, 'activity_history']);

    Route::get('{any}', [HomeController::class, 'index'])->name('index');
  }
);
