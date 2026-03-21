<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\AssistanceCenter;

class HomeController extends Controller
{
    public function index()
    {
        /* Se non si è loggati o se si è tecnici di assistenza, 
        si viene indirizzati nella pagina welcome */
        if (!Auth::check() || Auth::user()->role === 'technician') { 
            $centers = AssistanceCenter::all();   
            return view('welcome', compact('centers'));
        }

        /* Se si è loggati come staff o amministratore, 
        si viene indirizzati nella pagina corretta */
        return match (Auth::user()->role) {
            'staff' => redirect()->route('staff.products'),
            'admin' => redirect()->route('admin.products'),
            default => abort(403),
        };
    }
}