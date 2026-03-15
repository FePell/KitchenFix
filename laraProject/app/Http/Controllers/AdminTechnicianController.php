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

    public function staffCreate() {
        $products = Product::all();
        return view('admin.technicians.form-staff', compact('products'));
    }

    public function staffStore(Request $request) {
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

    public function staffEdit(StaffTechnician $technician) {
        $products = Product::all();
        return view('admin.technicians.form-staff', compact('products', 'technician'));
    }

    public function staffUpdate(Request $request, StaffTechnician $technician) {
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

    public function staffDestroy(StaffTechnician $technician) {
        $technician->delete();
        return redirect()->route('admin.technicians', ['technicianType' => 'staff'])
            ->with('success', 'Tecnico staff rimosso con successo.'); 
    }

    // ----------------------------------------------------------------------------------
    //      ASSISTANCE
    // ----------------------------------------------------------------------------------

    public function assistanceCreate() {
        $centers = AssistanceCenter::all();
        return view('admin.technicians.form-assistance', compact('centers'));
    }
    
    public function assistanceStore(Request $request)
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

    public function assistanceEdit(AssistanceTechnician $technician) {
        $centers = AssistanceCenter::all();
        return view('admin.technicians.form-assistance', compact('centers', 'technician'));
    }

    public function assistanceUpdate(Request $request, AssistanceTechnician $technician) {
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

    public function assistanceDestroy(AssistanceTechnician $technician) {
        $technician->delete();
        return redirect()->route('admin.technicians', ['technicianType' => 'assistance'])
            ->with('success', 'Tecnico assistenza rimosso con successo.');      
    }
}