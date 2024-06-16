<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratSurvey;
use App\Models\Letter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function show(string $id_user)
    {
        $surveys = SuratSurvey::all();

        $letters = Letter::all();

        return view('pengajuan.pengajuan_surat',['letters' => $letters], ['surveys' => $surveys])

        -> with(['user' => Auth::user()]);
    }

    public function edit($id_surat_izin)
    {
        $suratIzin = Letter::where('id_surat_izin', $id_surat_izin)->first();

        if (!$suratIzin) {
            return redirect('/pengajuan/{id_user}')->with([
                'notifikasi' => 'Data siswa tidak ditemukan!',
                'type' => 'error'
            ]);
        }

        return view('surat_izin.edit', compact('suratIzin'));
    }

    public function update(Request $request, $id_surat_izin)
    {
        $suratIzin = Letter::where('id_surat_izin', $id_surat_izin)->firstOrFail();

        $validatedData = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'jenis_perizinan' => 'required',
            'kelas_perkuliahan' => 'required',
            'nama_dan_nomor_telepon_orang_tua_wali' => 'required',
            'nama_dosen_wali' => 'required',
            'tanggal_mulai_izin' => 'required',
            'tanggal_akhir_izin' => 'required',
            'foto1' => 'nullable|image',
            'foto2' => 'nullable|image',
            'foto3' => 'nullable|image',
        ]);

        // Proses validasi lainnya dan manipulasi data

        $suratIzin->nim = $request->nim;
        $suratIzin->nama = $request->nama;
        $suratIzin->jenis_perizinan = $request->jenis_perizinan;
        $suratIzin->kelas_perkuliahan = $request->kelas_perkuliahan;
        $suratIzin->nama_dan_nomor_telepon_orang_tua_wali = $request->nama_dan_nomor_telepon_orang_tua_wali;
        $suratIzin->nama_dosen_wali = $request->nama_dosen_wali;
        $suratIzin->tanggal_mulai_izin = $request->tanggal_mulai_izin;
        $suratIzin->tanggal_akhir_izin = $request->tanggal_akhir_izin;

        // Cek apakah ada perubahan pada foto 1
        if ($request->hasFile('foto1')) {
            // Menghapus foto lama jika ada
            if ($suratIzin->foto1 && Storage::exists('uploads/' . $suratIzin->foto1)) {
                Storage::delete('uploads/' . $suratIzin->foto1);
            }

            $foto1 = $request->file('foto1')->store('uploads');
            $suratIzin->foto1 = basename($foto1);
        }

        // Cek apakah ada perubahan pada foto 2
        if ($request->hasFile('foto2')) {
            // Menghapus foto lama jika ada
            if ($suratIzin->foto2 && Storage::exists('uploads/' . $suratIzin->foto2)) {
                Storage::delete('uploads/' . $suratIzin->foto2);
            }

            $foto2 = $request->file('foto2')->store('uploads');
            $suratIzin->foto2 = basename($foto2);
        }

        // Cek apakah ada perubahan pada foto 3
        if ($request->hasFile('foto3')) {
            // Menghapus foto lama jika ada
            if ($suratIzin->foto3 && Storage::exists('uploads/' . $suratIzin->foto3)) {
                Storage::delete('uploads/' . $suratIzin->foto3);
            }

            $foto3 = $request->file('foto3')->store('uploads');
            $suratIzin->foto3 = basename($foto3);
        }

        // Simpan perubahan
        if ($suratIzin->save()) {
            return redirect('/pengajuan/{id_user}')->with([
                'notifikasi' => 'Perubahan berhasil disimpan!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal menyimpan perubahan!',
                'type' => 'error'
            ]);
        }
    }
}
