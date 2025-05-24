<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industri;

class APIIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri = Industri::all();
        return response()->json($industri, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $industri = Industri::create($request->all());

        return response()->json($industri, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $industri = Industri::find($id);

        if ($industri) {
            return response()->json($industri, 200);
        } else {
            return response()->json(['message' => 'Industri not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $industri = Industri::find($id);

        if (!$industri) {
            return response()->json(['message' => 'Industri not found'], 404);
        }

        $industri->update($request->all());

        return response()->json($industri, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $industri = Industri::find($id);

        if (!$industri) {
            return response()->json(['message' => 'Industri not found'], 404);
        }

        $industri->delete();

        return response()->json(['message' => 'Industri deleted successfully'], 200);
    }
}
