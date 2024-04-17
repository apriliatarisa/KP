<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
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




require __DIR__.'/auth.php';
