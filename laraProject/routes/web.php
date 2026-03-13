<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//Controller livello 1-2 - Guest e Tecnico
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AssistanceCenterController;
//Controller livello 3 - Staff
use App\Http\Controllers\StaffProductController;
//Controller livello 4 - Amministratore
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminTechnicianController;
use App\Http\Controllers\AdminCenterController;

//Home Page - Livello 1-2 --------------------------------------------------------------------]
Route::get('/', function () {

    if (Auth::check()) {
        return match (Auth::user()->role) {
            'staff' => redirect()->route('staff.products'),
            'technician' => redirect()->route('technician'),
            'admin' => redirect()->route('admin.products'),
            default => redirect()->route('home'), //Cambiare in default => abort(403)???
        };
    }
    $centers = DB::table('assistance_centers')->get();
    return view('welcome', compact('centers'));

})->name('home');

//Lista Centri di Assistenza -----------------------------------------------------------------]
Route::get('/centri', [AssistanceCenterController::class, 'index']);

//Lista Prodotti Pubblica --------------------------------------------------------------------]
Route::get('/prodotti', [ProductController::class, 'index'])
    ->name('products.index'); //Si usa index per le liste

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

//Area Tecnico - Livello 2 -------------------------------------------------------------------]
Route::middleware(['auth', 'role:technician'])->group(function () {
    Route::get('/technician', function () {
        $centers = DB::table('assistance_centers')->get();
        return view('welcome', compact('centers'));
    })->name('technician');

    Route::get('/products/{product}/malfunctions', [ProductController::class, 'malfunctions'])
        ->name('products.malfunctions');
});
//--------------------------------------------------------------------------------------------]

//Area Staff - Livello 3 ---------------------------------------------------------------------]
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', [StaffProductController::class, 'index'])
        ->name('staff.products');

    Route::get('/staff/products/{product}/malfunctions/create', [StaffProductController::class, 'createMalfunction'])
        ->name('staff.malfunctions.create');

    Route::post('/staff/products/{product}/malfunctions', [StaffProductController::class, 'storeMalfunction'])
        ->name('staff.malfunctions.store');

    Route::get('/staff/malfunctions/{malfunction}/edit', [StaffProductController::class, 'editMalfunction'])
        ->name('staff.malfunctions.edit');

    Route::put('/staff/malfunctions/{malfunction}', [StaffProductController::class, 'updateMalfunction'])
        ->name('staff.malfunctions.update');

    Route::delete('/staff/malfunctions/{malfunction}', [StaffProductController::class, 'destroyMalfunction'])
        ->name('staff.malfunctions.destroy');
});
//--------------------------------------------------------------------------------------------]

//Area Amministratore - Livello 4 ------------------------------------------------------------]
Route::middleware(['auth', 'role:admin'])->group(function () {

    //Gestione Prodotti
    Route::get('/admin/products', [AdminProductController::class, 'index'])
        ->name('admin.products');

    Route::get('/admin/products/create', [AdminProductController::class, 'create'])
        ->name('admin.products.create'); //Creazione nuovo prodotto

    Route::post('/admin/products', [AdminProductController::class, 'store'])
        ->name('admin.products.store'); //Aggiunta prodotto nel database  

    Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])
        ->name('admin.products.edit'); //Modifica dati prodotto

    Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])
        ->name('admin.products.update'); //Aggiorna prodotto nel database

    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])
        ->name('admin.products.destroy');

    //Gestione Tecnici
    Route::get('/admin/technicians', [AdminTechnicianController::class, 'index'])
        ->name('admin.technicians');

    //Gestione Centri
    Route::get('/admin/centers', [AdminCenterController::class, 'index'])
        ->name('admin.centers');

    Route::get('/admin/centers/create', [AdminCenterController::class, 'create'])
        ->name('admin.centers.create'); //Creazione nuovo centro

    Route::post('/admin/centers', [AdminCenterController::class, 'store'])
        ->name('admin.centers.store'); //Aggiunta centro nel database    

    Route::get('/admin/centers/{center}/edit', [AdminCenterController::class, 'edit'])
        ->name('admin.centers.edit'); //Modifica dati centro
    
    Route::put('/admin/centers/{center}', [AdminCenterController::class, 'update'])
        ->name('admin.centers.update'); //Aggiorna centro nel database

    Route::delete('/admin/centers/{center}', [AdminCenterController::class, 'destroy'])
        ->name('admin.centers.destroy');
});
//--------------------------------------------------------------------------------------------]

//Autenticazione -----------------------------------------------------------------------------]
require __DIR__.'/auth.php';