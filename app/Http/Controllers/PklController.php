<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Guru;
use App\Models\Pkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PklController extends Controller
{
    /**
     * Menyimpan data PKL ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Simpan data PKL
                $pkl = new Pkl();
                $pkl->siswa_id = $request->siswa_id;
                $pkl->industri_id = $request->industri_id;
                $pkl->guru_id = $request->guru_id;
                $pkl->mulai = $request->mulai;
                $pkl->selesai = $request->selesai;
                $pkl->save();

                // Update status PKL pada siswa
                $siswa = Siswa::find($request->siswa_id);
                $siswa->status_pkl = true; // Mengubah status PKL menjadi disetujui
                $siswa->save();
            });

            return redirect()->route('pkl.index')->with('success', 'Data PKL berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. Transaksi dibatalkan.');
        }
    }

    /**
     * Mengupdate data PKL
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                // Cari data PKL yang akan diupdate
                $pkl = Pkl::findOrFail($id);
                $pkl->siswa_id = $request->siswa_id;
                $pkl->industri_id = $request->industri_id;
                $pkl->guru_id = $request->guru_id;
                $pkl->mulai = $request->mulai;
                $pkl->selesai = $request->selesai;
                $pkl->save();

                // Update status PKL pada siswa
                $siswa = Siswa::find($request->siswa_id);

                // Cek apakah status PKL perlu diubah
                if ($siswa->status_pkl == true) {
                    $siswa->status_pkl = false; // Mengubah status PKL menjadi false
                    $siswa->save();

                    // Debugging: Menampilkan pesan untuk memeriksa penghapusan
                    $deleted = Pkl::where('siswa_id', $siswa->id)->delete(); // Menghapus data PKL yang terkait

                    // Jika tidak ada data yang dihapus
                    if ($deleted === 0) {
                        dd('Tidak ada data PKL yang dihapus. ID siswa: ' . $siswa->id);
                    } else {
                        dd('Data PKL dihapus. ID siswa: ' . $siswa->id);
                    }
                } else {
                    $siswa->status_pkl = true; // Mengubah status PKL menjadi true
                    $siswa->save();
                }
            });

            return redirect()->route('pkl.index')->with('success', 'Data PKL berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data. Transaksi dibatalkan.');
        }
    }

    /**
     * Menghapus data PKL
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $pkl = Pkl::findOrFail($id);
                $pkl->delete(); // Hapus data PKL
            });

            return redirect()->route('pkl.index')->with('success', 'Data PKL berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
