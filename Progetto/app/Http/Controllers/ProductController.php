<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('malfunctions');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

        return view('products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Qui invece carichiamo i malfunzionamenti per la pagina dettaglio
        $product->load('malfunctions');

        return view('products_show', compact('product'));
    }
}