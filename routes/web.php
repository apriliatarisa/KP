<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\DisposisiSmController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DisposisiSkController;
use App\Http\Controllers\RiwayatSuratController;
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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function  () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

route::get('/home',[HomeController::class,'index'])->
    middleware('auth')->name('home');

route::get('post',[HomeController::class,'post'])->
    middleware(['auth','kakancab']);

Route::middleware('auth')->group(function () {
    

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/surat-masuk', [SuratMasukController::class, 'index'])->name('surat_masuk.index');
Route::get('/surat-masuk/create', [SuratMasukController::class, 'create'])->name('surat_masuk.create');
Route::post('/surat-masuk', [SuratMasukController::class, 'store'])->name('surat_masuk.store');
Route::get('/surat-masuk/{id}', [SuratMasukController::class, 'show'])->name('surat_masuk.show');
Route::get('/surat-masuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('surat_masuk.edit');
Route::put('/surat-masuk/{id}', [SuratMasukController::class, 'update'])->name('surat_masuk.update');
Route::delete('/surat-masuk/{id}', [SuratMasukController::class, 'destroy'])->name('surat_masuk.destroy');
// Route::post('/surat-masuk/{id}/disposisi', 'SuratMasukController@disposisi')->name('surat_masuk.disposisi');

Route::get('/disposisi', [DisposisiSmController::class, 'index'])->name('disposisi_sm.index');
Route::get('/disposisi/create', [DisposisiSmController::class, 'create'])->name('disposisi_sm.create');
Route::post('/disposisi', [DisposisiSmController::class, 'store'])->name('disposisi_sm.store');
Route::put('/disposisi_sm/{id}/mark_as_completed', [DisposisiSmController::class, 'markAsCompleted'])->name('mark_as_completed');

Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])->name('surat_keluar.index');
Route::get('/surat-keluar/create', [SuratKeluarController::class, 'create'])->name('surat_keluar.create');
Route::post('/surat-keluar', [SuratKeluarController::class, 'store'])->name('surat_keluar.store');
Route::get('/surat-keluar/{id}/edit', [SuratKeluarController::class, 'edit'])->name('surat_keluar.edit');
Route::put('/surat-keluar/{id}', [SuratKeluarController::class, 'update'])->name('surat_keluar.update');
Route::delete('/surat-keluar/{id}', [SuratKeluarController::class, 'destroy'])->name('surat_keluar.destroy');

Route::get('/disposisi-sk', [DisposisiSkController::class, 'index'])->name('disposisi_sk.index');
Route::get('/disposisi-sk/create', [DisposisiSkController::class, 'create'])->name('disposisi_sk.create');
Route::post('/disposisi-sk', [DisposisiSkController::class, 'store'])->name('disposisi_sk.store');
Route::put('/disposisi_sk/{id}/mark_as_completed', [DisposisiSkController::class, 'markAsCompleted'])->name('mark_as_completed_sk');

Route::get('/riwayat-surat', [RiwayatSuratController::class, 'index'])->name('riwayat_surat.index');
require __DIR__.'/auth.php';
