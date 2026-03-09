<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Staff\MalfunctionController;
use App\Http\Controllers\AssistanceCenterController;
use App\Http\Controllers\StaffController;

//Home Page ---------------------------------------------------------------
Route::get('/', function () {

    if (Auth::check()) {
        return match (Auth::user()->role) {
            'staff' => redirect()->route('staff.products'),
            'technician' => redirect()->route('technician'),
            'admin' => redirect()->route('admin.products'),
            default => redirect()->route('home'),
        };
    }
    $centers = DB::table('assistance_centers')->get();
    return view('welcome', compact('centers'));

})->name('home');

//Lista Centri di Assistenza ----------------------------------------------
Route::get('/centri', [AssistanceCenterController::class, 'index']);

//Lista Prodotti Pubblica -------------------------------------------------
Route::get('/prodotti', [ProductController::class, 'index'])
    ->name('products.index'); //Si usa index per le liste

//Area Tecnico ------------------------------------------------------------
Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician', function () {
        $centers = DB::table('assistance_centers')->get();
        return view('welcome', compact('centers'));
    })->name('technician');
});

//Area Staff --------------------------------------------------------------
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.products');

    Route::get('/staff/products/{product}/malfunctions/create', [StaffController::class, 'createMalfunction'])
        ->name('staff.malfunctions.create');

    Route::post('/staff/products/{product}/malfunctions', [StaffController::class, 'storeMalfunction'])
        ->name('staff.malfunctions.store');

    Route::get('/staff/malfunctions/{malfunction}/edit', [StaffController::class, 'editMalfunction'])
        ->name('staff.malfunctions.edit');

    Route::put('/staff/malfunctions/{malfunction}', [StaffController::class, 'updateMalfunction'])
        ->name('staff.malfunctions.update');

    Route::delete('/staff/malfunctions/{malfunction}', [StaffController::class, 'destroyMalfunction'])
        ->name('staff.malfunctions.destroy');
});

//Area Amministratore -----------------------------------------------------
Route::middleware(['auth', 'role:admin'])->group(function () { //Accessibile solo con ruolo 'admin'
    Route::view('/admin/products', 'products')->name('admin.products');
});



//Autenticazione ----------------------------------------------------------
require __DIR__.'/auth.php';