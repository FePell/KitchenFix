<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Malfunction;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $products = Product::with('malfunctions')->get();
        return view('staff.products', compact('products'));
    }

    public function createMalfunction(Product $product)
    {
        return view('staff.create-malfunction', compact('product'));
    }

    public function storeMalfunction(Request $request, Product $product)
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
        return redirect()->route('staff.products')->with('success', 'Malfunzionamento aggiunto con successo.');
    }

    public function editMalfunction(Malfunction $malfunction)
    {
        return view('staff.edit-malfunction', compact('malfunction'));
    }

    public function updateMalfunction(Request $request, Malfunction $malfunction)
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

    public function destroyMalfunction(Malfunction $malfunction)
    {
        $malfunction->delete();
        return redirect()->route('staff.products');
    }
}