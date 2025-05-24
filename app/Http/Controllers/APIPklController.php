<?php

namespace App\Http\Controllers;

use App\Models\Pkl;
use Illuminate\Http\Request;

class APIPklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pkl = Pkl::with(['siswa', 'industri', 'guru'])->get();
        return response()->json($pkl, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'industri_id' => 'required|exists:industri,id',
            'guru_id' => 'required|exists:guru,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        $pkl = Pkl::create($request->all());

        return response()->json($pkl, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pkl = Pkl::with(['siswa', 'industri', 'guru'])->find($id);

        if ($pkl) {
            return response()->json($pkl, 200);
        }

        return response()->json(['message' => 'PKL not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'industri_id' => 'required|exists:industri,id',
            'guru_id' => 'required|exists:guru,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        $pkl = Pkl::find($id);

        if (!$pkl) {
            return response()->json(['message' => 'PKL not found'], 404);
        }

        $pkl->update($request->all());

        return response()->json($pkl, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pkl = Pkl::find($id);

        if (!$pkl) {
            return response()->json(['message' => 'PKL not found'], 404);
        }

        $pkl->delete();

        return response()->json(['message' => 'PKL deleted successfully'], 200);
    }
}
