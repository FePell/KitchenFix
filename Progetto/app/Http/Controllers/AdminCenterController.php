<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssistanceCenter;

class AdminCenterController extends Controller
{
    public function index()
    {
        $centers = AssistanceCenter::all();
        return view('admin.centers.centers', compact('centers'));
    }

    public function create()
    {
        return view('admin.centers.create-center');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        AssistanceCenter::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.centers');
    }

    public function edit(AssistanceCenter $center)
    {
        return view('admin.centers.edit-center', compact('center'));
    }

    public function update(Request $request, AssistanceCenter $center)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $center->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.centers');
    }

    public function destroy(AssistanceCenter $center)
    {
        $center->delete();
        return redirect()->route('admin.centers');
    }
}