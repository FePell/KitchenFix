<?php

//Le route sono solo punti di accesso, la logica deve essere gestita dai controller

use Illuminate\Support\Facades\Route;
//Generale
use App\Http\Controllers\HomeController;
//Controller livello 1-2 - Guest e Tecnico
use App\Http\Controllers\ProductController;
//Controller livello 3 - Staff
use App\Http\Controllers\StaffProductController;
//Controller livello 4 - Amministratore
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminTechnicianController;
use App\Http\Controllers\AdminCenterController;

//Generale -----------------------------------------------------------------------------------]
Route::get('/', [HomeController::class, 'index']) //Il simbolo / rappresenta la homepage
    ->name('home'); 

//Utente - Livello 1 -------------------------------------------------------------------------]
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index'); //Lista prodotti

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show'); //Dettagli prodotto singolo
//--------------------------------------------------------------------------------------------]

//Area Tecnico - Livello 2 -------------------------------------------------------------------]
Route::middleware(['auth', 'role:technician'])->group(function () 
{
    Route::get('/products/{product}/malfunctions', [ProductController::class, 'malfunctions'])
        ->name('products.malfunctions'); //Malfunziomenti prodotto 
});
//--------------------------------------------------------------------------------------------]

//Area Staff - Livello 3 ---------------------------------------------------------------------]
Route::middleware(['auth', 'role:staff'])->group(function () 
{
    Route::get('/staff', [StaffProductController::class, 'index'])
        ->name('staff.products');

    Route::get('/staff/products/{product}/malfunctions/create', [StaffProductController::class, 'createMalfunction'])
        ->name('staff.malfunctions.create'); //Crea nuovo malfunzionamento

    Route::post('/staff/products/{product}/malfunctions', [StaffProductController::class, 'storeMalfunction'])
        ->name('staff.malfunctions.store'); //Aggiunge malfunzionamento nel DB  

    Route::get('/staff/malfunctions/{malfunction}/edit', [StaffProductController::class, 'editMalfunction'])
        ->name('staff.malfunctions.edit'); //Modifica dati malfunzionamento

    Route::put('/staff/malfunctions/{malfunction}', [StaffProductController::class, 'updateMalfunction'])
        ->name('staff.malfunctions.update'); //Aggiorna malfunzionamento nel DB

    Route::delete('/staff/malfunctions/{malfunction}', [StaffProductController::class, 'destroyMalfunction'])
        ->name('staff.malfunctions.destroy'); //Rimuove malfunzionamento dal DB
});
//--------------------------------------------------------------------------------------------]

//Area Amministratore - Livello 4 ------------------------------------------------------------]
Route::middleware(['auth', 'role:admin'])->group(function () 
{
    //Gestione Prodotti ----------------------------------]
    Route::get('/admin/products', [AdminProductController::class, 'index'])
        ->name('admin.products');

    Route::get('/admin/products/create', [AdminProductController::class, 'createProduct'])
        ->name('admin.products.create'); //Crea nuovo prodotto

    Route::post('/admin/products', [AdminProductController::class, 'storeProduct'])
        ->name('admin.products.store'); //Aggiunge prodotto nel DB  

    Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'editProduct'])
        ->name('admin.products.edit'); //Modifica dati prodotto

    Route::put('/admin/products/{product}', [AdminProductController::class, 'updateProduct'])
        ->name('admin.products.update'); //Aggiorna prodotto nel DB

    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroyProduct'])
        ->name('admin.products.destroy'); //Rimuove prodotto dal DB

    //Gestione Tecnici -----------------------------------]
    //Tecnico dello staff
    Route::get('/admin/technicians', [AdminTechnicianController::class, 'index'])
        ->name('admin.technicians');
    
    Route::get('/admin/technicians/staff/create', [AdminTechnicianController::class, 'createStaff'])
        ->name('admin.technicians.staff-create'); //Crea nuovo tecnico dello staff

    Route::post('/admin/technicians/staff', [AdminTechnicianController::class, 'storeStaff'])
        ->name('admin.technicians.staff-store'); //Aggiunge tecnico dello staff nel DB
 
    Route::get('/admin/technicians/staff/{technician}/edit', [AdminTechnicianController::class, 'editStaff'])
        ->name('admin.technicians.staff-edit'); //Modifica dati tecnico dello staff 

    Route::put('/admin/technicians/staff/{technician}', [AdminTechnicianController::class, 'updateStaff'])
        ->name('admin.technicians.staff-update'); //Aggiorna tecnico dello staff nel DB

    Route::delete('/admin/technicians/staff/{technician}', [AdminTechnicianController::class, 'destroyStaff'])
        ->name('admin.technicians.staff-destroy'); //Rimuove tecnico dello staff dal DB

    //Tecnico di assistenza
    Route::get('/admin/technicians/assistance/create', [AdminTechnicianController::class, 'createAssistance'])
        ->name('admin.technicians.assistance-create'); //Crea nuovo tecnico di assistenza 

    Route::post('/admin/technicians/assistance', [AdminTechnicianController::class, 'storeAssistance'])
        ->name('admin.technicians.assistance-store'); //Aggiunge tecnico di assistenza nel DB

    Route::get('/admin/technicians/assistance/{technician}/edit', [AdminTechnicianController::class, 'editAssistance'])
        ->name('admin.technicians.assistance-edit'); //Modifica dati tecnico di assistenza 

    Route::put('/admin/technicians/assistance/{technician}', [AdminTechnicianController::class, 'updateAssistance'])
        ->name('admin.technicians.assistance-update'); //Aggiorna tecnico di assistenza nel DB

    Route::delete('/admin/technicians/assistance/{technician}', [AdminTechnicianController::class, 'destroyAssistance'])
        ->name('admin.technicians.assistance-destroy'); //Rimuove tecnico di assistenza dal DB

    //Gestione Centri ------------------------------------]
    Route::get('/admin/centers', [AdminCenterController::class, 'index'])
        ->name('admin.centers');

    Route::get('/admin/centers/create', [AdminCenterController::class, 'createCenter'])
        ->name('admin.centers.create'); //Crea nuovo centro

    Route::post('/admin/centers', [AdminCenterController::class, 'storeCenter'])
        ->name('admin.centers.store'); //Aggiunge centro nel DB    

    Route::get('/admin/centers/{center}/edit', [AdminCenterController::class, 'editCenter'])
        ->name('admin.centers.edit'); //Modifica dati centro
    
    Route::put('/admin/centers/{center}', [AdminCenterController::class, 'updateCenter'])
        ->name('admin.centers.update'); //Aggiorna centro nel DB

    Route::delete('/admin/centers/{center}', [AdminCenterController::class, 'destroyCenter'])
        ->name('admin.centers.destroy'); //Rimuove centro dal DB
});
//--------------------------------------------------------------------------------------------]

//Autenticazione -----------------------------------------------------------------------------]
require __DIR__.'/auth.php';