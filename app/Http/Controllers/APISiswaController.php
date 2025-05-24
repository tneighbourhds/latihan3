<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class APISiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all(); // Retrieve all students
        return response()->json($siswa, 200); // Return students as JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:10|unique:siswa',
            'gender' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:siswa',
            'status_pkl' => 'required|boolean',  // Validation for status_pkl
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validation for photo upload
        ]);

        // Create new student object
        $siswa = new Siswa();
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->gender = $request->gender;
        $siswa->alamat = $request->alamat;
        $siswa->kontak = $request->kontak;
        $siswa->email = $request->email;
        $siswa->status_pkl = $request->status_pkl;

        // Handle photo upload (if exists)
        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('storage/siswa_photos'), $imageName);
            $siswa->foto = $imageName; // Save the filename to the database
        }

        // Save student record
        $siswa->save();

        return response()->json($siswa, 201); // Return the created student record
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa not found'], 404); // Return 404 if student not found
        }

        return response()->json($siswa, 200); // Return student data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa not found'], 404); // Return 404 if student not found
        }

        // Validate incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:10|unique:siswa,nis,' . $id,
            'gender' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:siswa,email,' . $id,
            'status_pkl' => 'required|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update student data
        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->gender = $request->gender;
        $siswa->alamat = $request->alamat;
        $siswa->kontak = $request->kontak;
        $siswa->email = $request->email;
        $siswa->status_pkl = $request->status_pkl;

        // Handle photo update (if a new photo is uploaded)
        if ($request->hasFile('foto')) {
            // Delete the old photo if exists
            if ($siswa->foto && Storage::exists('public/siswa_photos/' . $siswa->foto)) {
                Storage::delete('public/siswa_photos/' . $siswa->foto);
            }

            // Upload new photo
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('storage/siswa_photos'), $imageName);
            $siswa->foto = $imageName;
        }

        // Save updated student data
        $siswa->save();

        return response()->json($siswa, 200); // Return updated student record
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa not found'], 404); // Return 404 if student not found
        }

        // Delete the photo if it exists
        if ($siswa->foto && Storage::exists('public/siswa_photos/' . $siswa->foto)) {
            Storage::delete('public/siswa_photos/' . $siswa->foto);
        }

        // Delete student record
        $siswa->delete();

        return response()->json(['message' => 'Siswa deleted successfully'], 200); // Success message
    }
}
