<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('malfunctions');
        $searchError = null;

        if ($request->filled('search')) {
            $search = trim($request->search);

            if (str_contains($search, '*')) 
            {
                if (substr_count($search, '*') === 1 && str_ends_with($search, '*')) 
                {
                    $term = substr($search, 0, -1);

                    if ($term !== '') {
                        $query->where('name', 'like', $term . '%');
                    } else {
                        $searchError = 'Inserisci almeno un carattere prima di *.';
                        $query->whereRaw('1 = 0');
                    }
                } else 
                {
                    $searchError = 'Il carattere * è ammesso solo come ultimo carattere.';
                    $query->whereRaw('1 = 0');
                }
            } else 
            {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '% ' . $search . ' %')
                      ->orWhere('name', 'like', $search . ' %')
                      ->orWhere('name', 'like', '% ' . $search)
                      ->orWhere('name', $search);
                });
            }
        }

        $products = $query->get();
        return view('products.products', compact('products', 'searchError'));
    }

    public function malfunctions(Request $request, Product $product)
    {
        $query = $product->malfunctions();

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', '% ' . $search . ' %')
                ->orWhere('description', 'like', $search . ' %')
                ->orWhere('description', 'like', '% ' . $search)
                ->orWhere('description', $search);
            });
        }

        $malfunctions = $query->get();
        return view('products.malfunctions', compact('product', 'malfunctions'));
    }
}