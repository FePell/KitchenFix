<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssistanceCenter;

class AdminCenterController extends Controller
{
    public function index()
    {
        $centers = AssistanceCenter::all();
        return view('admin.centers.centers', compact('centers'));
    }
    public function createCenter() //Crea nuovo centro -----------------------------------------------------------------------------]
    {
        return view('admin.centers.form-center');
    }

    public function storeCenter(Request $request) //Aggiunge centro nel database ---------------------------------------------------]  
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255|unique:assistance_centers,address',
        ]);

        AssistanceCenter::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.centers');
    }

    public function editCenter(AssistanceCenter $center) //Modifica dati centro ----------------------------------------------------]
    {
        return view('admin.centers.form-center', compact('center'));
    }

    public function updateCenter(Request $request, AssistanceCenter $center) //Aggiorna centro nel database ------------------------]
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255|unique:assistance_centers,address,'. $center->id,
        ]);

        $center->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.centers');
    }

    public function destroyCenter(AssistanceCenter $center) //Rimuove centro dal database ------------------------------------------]
    {
        $center->delete();
        return redirect()->route('admin.centers');
    }
}