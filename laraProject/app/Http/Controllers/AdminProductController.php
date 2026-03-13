<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.products', compact('products')); //DA CAPIRE
    }

    public function create()
    {
        return view('admin.products.create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'usage_techniques' => 'required|string',
            'installation' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        //Salvataggio immagine
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        //Creazione prodotto
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'usage_techniques' => $request->usage_techniques,
            'installation' => $request->installation,
            'image' => $imageName
        ]);

        return redirect()->route('admin.products')
            ->with('success', 'Prodotto creato con successo.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'usage_techniques' => 'required|string',
            'installation' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'usage_techniques' => $request->usage_techniques,
            'installation' => $request->installation,
        ];

        // Se viene caricata una nuova immagine, la sostituisce
        if ($request->hasFile('image')) {
            // Elimina la vecchia immagine se esiste
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products')
            ->with('success', 'Prodotto aggiornato con successo.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products'); //DA CAPIRE
    }
}
