<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\DisposisiSmController;
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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


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
Route::post('/surat-masuk/{id}/disposisi', 'SuratMasukController@disposisi')->name('surat_masuk.disposisi');

Route::get('/disposisi', [DisposisiSmController::class, 'index'])->name('disposisi_sm.index');
Route::get('/disposisi/create', [DisposisiSmController::class, 'create'])->name('disposisi_sm.create');
Route::post('/disposisi', [DisposisiSmController::class, 'store'])->name('disposisi_sm.store');
Route::get('/disposisi/{id}', [DisposisiSmController::class, 'show'])->name('disposisi_sm.show');
Route::get('/disposisi/{id}/edit', [DisposisiSmController::class, 'edit'])->name('disposisi_sm.edit');
Route::put('/disposisi/{id}', [DisposisiSmController::class, 'update'])->name('disposisi_sm.update');
Route::delete('/disposisi/{id}', [DisposisiSmController::class, 'destroy'])->name('disposisi_sm.destroy');

// routes/web.php

Route::get('/surat_masuk/{suratMasuk}/disposisi/create', [DisposisiSmController::class, 'create'])->name('surat_masuk.disposisi.create');
Route::post('/surat_masuk/{suratMasuk}/disposisi', [DisposisiSmController::class, 'store'])->name('surat_masuk.disposisi.store');
Route::post('/disposisi_sm/{id}/mark_as_completed', [DisposisiSmController::class, 'markAsCompleted'])->name('mark_as_completed');


require __DIR__.'/auth.php';
