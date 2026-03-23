<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) //Lista prodotti -----------------------------------------------------------------------]
    {
        $search = trim($request->input('search', ''));
        $query = Product::query();
        $searchError = null;

        if ($search !== '') 
        {
            if (str_contains($search, '*')) 
            {
                if (substr_count($search, '*') === 1 && str_ends_with($search, '*')) 
                {
                    $term = substr($search, 0, -1);

                    if ($term !== '') {
                        $query->where(function ($q) use ($term) {
                            $q->where('name', 'like', $term . '%')
                            ->orWhere('name', 'like', '% ' . $term . '%');
                        });
                    } else {
                        $searchError = 'Inserisci almeno un carattere prima di *.';
                        $query->whereRaw('1 = 0');
                    }
                } else {
                    $searchError = 'Il carattere * è ammesso solo come ultimo carattere.';
                    $query->whereRaw('1 = 0');
                }
            } else {
                $query->where(function ($q) use ($search) {
                    $q->where('name', $search)
                    ->orWhere('name', 'like', $search . ' %')
                    ->orWhere('name', 'like', '% ' . $search)
                    ->orWhere('name', 'like', '% ' . $search . ' %');
                });
            }
        }

        $products = $query->get();

        if ($request->ajax()) {
            return response()->json([
                'products' => $products,
                'searchError' => $searchError,
            ]);
        }

        return view('products.products', compact('products', 'searchError'));

        $products = $query->get();

        //AJAX ---------------------------------------------------------------------------------------------------------------------]
        if ($request->ajax()) {
            return response()->json([
                'products' => $products,
                'searchError' => $searchError,
            ]);
        }
        //--------------------------------------------------------------------------------------------------------------------------]

        return view('products.products', compact('products', 'searchError'));
    }

    public function show(Product $product) //Dettagli prodotto singolo -------------------------------------------------------------]
    {
        $product->load('malfunctions');
        return view('products.product-details', compact('product'));
    }

    public function malfunctions(Request $request, Product $product) //Malfunzionamenti prodotto -----------------------------------]
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