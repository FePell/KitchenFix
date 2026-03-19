<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.products', compact('products'));
    }

    public function createProduct() //Crea nuovo prodotto --------------------------------------------------------------------------]
    {
        return view('admin.products.form-product');
    }

    public function storeProduct(Request $request) //Aggiunge prodotto nel database ------------------------------------------------] 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'usage_techniques' => 'required|string',
            'installation' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'usage_techniques' => $request->usage_techniques,
            'installation' => $request->installation,
            'image' => $imageName
        ]);

        return redirect()->route('admin.products');
    }

    public function editProduct(Product $product) //Modifica dati prodotto ---------------------------------------------------------]
    {
        return view('admin.products.form-product', compact('product'));
    }

    public function updateProduct(Request $request, Product $product) //Aggiorna prodotto nel database -----------------------------]
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

            $imageName = time() . '.' . $request->image->extension(); //Genera nome immagine
            $request->image->move(public_path('images'), $imageName);

            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products');
    }

    public function destroyProduct(Product $product) //Rimuove un prodotto dal database --------------------------------------------]
    {
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }
        $product->delete();

        return redirect()->route('admin.products');
    }
}
