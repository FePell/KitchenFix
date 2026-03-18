<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\StaffTechnician;
use App\Models\AssistanceCenter;
use App\Models\AssistanceTechnician;

class AdminTechnicianController extends Controller
{
    public function index(Request $request)
    {
        $technicianType = $request->query('technicianType', 'staff');

        $staffTechnician = StaffTechnician::all();
        $assistanceTechnician = AssistanceTechnician::all();

        return view('admin.technicians.technicians', compact('staffTechnician', 'assistanceTechnician', 'technicianType'));
    }

    // Tecnico dello staff ---------------------------------------------------------------------------------------------------------]
    public function createStaff() //Crea nuovo tecnico dello staff -----------------------------------------------------------------]
    { 
        $products = Product::all();
        return view('admin.technicians.form-staff', compact('products'));
    }

    public function staffStore(Request $request) //Aggiunge tecnico dello staff nel database ---------------------------------------]
    { 
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'products' => 'required|array',
        ]);

        $newUser = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'staff'
        ]);

        $technician = StaffTechnician::create([
            'user_id' => $newUser->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $technician->products()->sync($request->products ?? []);

        return redirect()->route('admin.technicians', ['technicianType' => 'staff'])
            ->with('success', 'Tecnico staff creato con successo.');
    }

    public function editStaff(StaffTechnician $technician) //Modifica dati tecnico dello staff -------------------------------------]
    { 
        $products = Product::all();
        return view('admin.technicians.form-staff', compact('products', 'technician'));
    }

    public function updateStaff(Request $request, StaffTechnician $technician) //Aggiorna tecnico dello staff nel database ---------]
    { 
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'products' => 'required|array',
        ]);

        $user = User::find($technician->user_id);
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->save();


        $technician->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $technician->products()->sync($request->products ?? []);

        return redirect()->route('admin.technicians', ['technicianType' => 'staff'])
            ->with('success', 'Tecnico staff aggiornato con successo.');
    }

    public function destroyStaff(StaffTechnician $technician) //Rimuove tecnico dello staff dal database ---------------------------]
    { 
        $technician->delete();
        return redirect()->route('admin.technicians', ['technicianType' => 'staff'])
            ->with('success', 'Tecnico staff rimosso con successo.'); 
    }
    // -----------------------------------------------------------------------------------------------------------------------------]

    // Tecnico di assistenza -------------------------------------------------------------------------------------------------------]
    public function createAssistance() //Crea nuovo tecnico di assistenza ----------------------------------------------------------]
    { 
        $centers = AssistanceCenter::all();
        return view('admin.technicians.form-assistance', compact('centers'));
    }
    
    public function storeAssistance(Request $request) //Aggiunge tecnico di assistenza nel database --------------------------------]
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|string',
            'specialization' => 'required|string',
            'assistance_center_id' => 'required|int',
        ]);

        $newUser = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'role' => 'technician'
        ]);

        AssistanceTechnician::create([
            'user_id' => $newUser->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'specialization' => $request->specialization,
            'assistance_center_id' => $request->assistance_center_id,
        ]);

        return redirect()->route('admin.technicians', ['technicianType' => 'assistance'])
            ->with('success', 'Tecnico assistenza creato con successo.');
    }

    public function editAssistance(AssistanceTechnician $technician) //Modifica dati tecnico di assistenza -------------------------]
    {
        $centers = AssistanceCenter::all();
        return view('admin.technicians.form-assistance', compact('centers', 'technician'));
    }

    public function updateAssistance(Request $request, AssistanceTechnician $technician) //Aggiorna tecnico di assistenza nel database
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|string',
            'specialization' => 'required|string',
            'assistance_center_id' => 'required|int',
        ]);

        $user = User::find($technician->user_id);
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->save();

        $technician->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'specialization' => $request->specialization,
            'assistance_center_id' => $request->assistance_center_id,
        ]);

        return redirect()->route('admin.technicians', ['technicianType' => 'assistance'])
            ->with('success', 'Tecnico assistenza aggiornato con successo.');      
    }

    public function destroyAssistance(AssistanceTechnician $technician) //Rimuove tecnico di assistenza dal database ---------------]
    {
        $technician->delete();
        return redirect()->route('admin.technicians', ['technicianType' => 'assistance'])
            ->with('success', 'Tecnico assistenza rimosso con successo.');      
    }
    // -----------------------------------------------------------------------------------------------------------------------------]
}