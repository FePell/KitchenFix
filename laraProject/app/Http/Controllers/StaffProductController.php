<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Malfunction;

class StaffProductController extends Controller
{
    public function index() //Lista prodotti associati allo staff ------------------------------------------------------------------]
    {
        $staffTechnician = Auth::user()->staffTechnician;
        $products = $staffTechnician->products()
        ->with('malfunctions')->get();

        return view('staff.products', compact('products'));
    }

    public function createMalfunction(Product $product) //Crea nuovo malfunzionamento ----------------------------------------------]
    {
        return view('staff.form-malfunction', compact('product'));
    }

    public function storeMalfunction(Request $request, Product $product) //Aggiunge malfunzionamento nel database ------------------]
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'solution' => 'required|string|max:255',
        ]);
        Malfunction::create([
            'product_id' => $product->id,
            'description' => $request->description,
            'solution' => $request->solution,
        ]);
        return redirect()->route('staff.products');
    }

    public function editMalfunction(Malfunction $malfunction) //Modifica dati malfunzionamento -------------------------------------]
    {
        return view('staff.form-malfunction', compact('malfunction'));
    }

    public function updateMalfunction(Request $request, Malfunction $malfunction) //Aggiorna malfunzionamento nel database ---------]
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'solution' => 'required|string|max:255',
        ]);
        $malfunction->update([
            'description' => $request->description,
            'solution' => $request->solution,
        ]);
        return redirect()->route('staff.products');
    }

    public function destroyMalfunction(Malfunction $malfunction) //Rimuove malfunzionamento dal database ---------------------------]
    {
        $malfunction->delete();
        return redirect()->route('staff.products');
    }
}