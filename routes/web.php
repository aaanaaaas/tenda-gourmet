<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CistellaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProducteController;
use Illuminate\Support\Facades\Route;

// --- Públiques ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacte', [HomeController::class, 'contacte'])->name('contacte');
Route::get('/cookies', [HomeController::class, 'cookies'])->name('cookies');

// --- Productes ---
Route::get('/seccio/{slug}', [ProducteController::class, 'perSeccio'])->name('seccio');
Route::get('/cerca', [ProducteController::class, 'cerca'])->name('cerca');
Route::get('/producte/{id}', [ProducteController::class, 'mostrar'])->name('producte');

// --- Cistella (apartat 7: $_COOKIE) ---
Route::get('/cistella', [CistellaController::class, 'mostrar'])->name('cistella.mostrar');
Route::post('/cistella/afegir/{id}', [CistellaController::class, 'afegir'])->name('cistella.afegir');
Route::post('/cistella/actualitzar/{id}', [CistellaController::class, 'actualitzar'])->name('cistella.actualitzar');
Route::post('/cistella/treure/{id}', [CistellaController::class, 'treure'])->name('cistella.treure');
Route::post('/cistella/buidar', [CistellaController::class, 'buidar'])->name('cistella.buidar');

// --- Autenticació ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot', [AuthController::class, 'forgotForm'])->name('forgot');
    Route::post('/forgot', [AuthController::class, 'forgot']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- Usuari autenticat ---
Route::middleware('auth')->group(function () {
    Route::get('/compte', [CompteController::class, 'edit'])->name('compte.edit');
    Route::put('/compte', [CompteController::class, 'update'])->name('compte.update');

    Route::get('/compra', [CompraController::class, 'checkout'])->name('compra.checkout');
    Route::post('/compra', [CompraController::class, 'processar'])->name('compra.processar');
    Route::get('/compra/confirmacio/{id}', [CompraController::class, 'confirmacio'])->name('compra.confirmacio');
});

// --- Admin (apartat 10) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    // Productes
    Route::get('/productes', [AdminController::class, 'productes'])->name('productes');
    Route::get('/productes/nou', [AdminController::class, 'producteCreate'])->name('producte.create');
    Route::post('/productes', [AdminController::class, 'producteStore'])->name('producte.store');
    Route::get('/productes/{id}/editar', [AdminController::class, 'producteEdit'])->name('producte.edit');
    Route::put('/productes/{id}', [AdminController::class, 'producteUpdate'])->name('producte.update');
    Route::delete('/productes/{id}', [AdminController::class, 'producteDestroy'])->name('producte.destroy');
    // Usuaris
    Route::get('/usuaris', [AdminController::class, 'usuaris'])->name('usuaris');
    Route::get('/usuaris/{id}/editar', [AdminController::class, 'usuariEdit'])->name('usuari.edit');
    Route::put('/usuaris/{id}', [AdminController::class, 'usuariUpdate'])->name('usuari.update');
    // Ofertes
    Route::get('/ofertes', [AdminController::class, 'ofertes'])->name('ofertes');
    Route::get('/ofertes/nova', [AdminController::class, 'ofertaCreate'])->name('oferta.create');
    Route::post('/ofertes', [AdminController::class, 'ofertaStore'])->name('oferta.store');
    Route::get('/ofertes/{id}/editar', [AdminController::class, 'ofertaEdit'])->name('oferta.edit');
    Route::put('/ofertes/{id}', [AdminController::class, 'ofertaUpdate'])->name('oferta.update');
    Route::delete('/ofertes/{id}', [AdminController::class, 'ofertaDestroy'])->name('oferta.destroy');
});
