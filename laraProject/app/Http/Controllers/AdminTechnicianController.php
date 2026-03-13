<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminTechnicianController extends Controller
{
    public function index()
    {
        $technicians = User::whereIn('role', ['technician', 'staff'])->get();

        return view('admin.technicians.technicians', compact('technicians'));
    }
}