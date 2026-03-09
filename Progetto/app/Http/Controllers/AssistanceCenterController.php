<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssistanceCenterController extends Controller
{
    public function index()
    {
        $centers = DB::table('assistance_centers')->get();

        return view('centri', compact('centers'));
    }
}
