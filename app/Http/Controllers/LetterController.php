<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Memanggil seluruh data dari table letter
        $letters = Letter::all();

        return view('letter.izin', ['letters' => $letters]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('letter.izin')
        ->with(['user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_user' => 'required',
            'nim' => 'required',
            'nama' => 'required',
            'kelas_perkuliahan' => 'required',
            'nama_dosen_wali' => 'required',
            'nama_dan_nomor_telepon_orang_tua_wali' => 'required',
            'jenis_perizinan' => 'required',
            'tanggal_akhir_izin' => 'required',
            'tanggal_mulai_izin' => 'required',

            ], [
            'nim.required' => 'NIM harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'kelas_perkuliahan.required' => 'Kelas Perkuliahan harus diisi.',
            'nama_dosen_wali.required' => 'Nama dosen wali harus diisi.',
            'nama_dan_nomor_telepon_orang_tua_wali.required' => 'Nomor Telepon harus diisi',
            'jenis_perizinan.required' => 'Jenis Surat harus diisi.',
            'tanggal_akhir_izin.required' => 'Keperluan harus diisi.',
            'tanggal_mulai_izin.required' => 'Tahun Ajaran harus diisi.',

            ]);

if ($request->hasFile('foto1')) {
    $foto1 = $request->file('foto1')->store('uploads');
    $foto1 = basename($foto1);
} else {
    $foto1 = null;
}

if ($request->hasFile('foto2')) {
    $foto2 = $request->file('foto2')->store('uploads');
    $foto2 = basename($foto2);
} else {
    $foto2 = null;
}

if ($request->hasFile('foto3')) {
    $foto3 = $request->file('foto3')->store('uploads');
    $foto3 = basename($foto3);
} else {
    $foto3 = null;
}


        $letters = new Letter();
        $letters->id_user = $request->id_user;
        $letters->nim = $request->nim;
        $letters->nama = $request->nama;
        $letters->kelas_perkuliahan = $request->kelas_perkuliahan;
        $letters->nama_dan_nomor_telepon_orang_tua_wali = $request->nama_dan_nomor_telepon_orang_tua_wali;
        $letters->nama_dosen_wali = $request->nama_dosen_wali;
        $letters->jenis_perizinan = $request->jenis_perizinan;
        $letters->tanggal_akhir_izin = $request->tanggal_akhir_izin;
        $letters->tanggal_mulai_izin = $request->tanggal_mulai_izin;
        $letters->status = 'PROSES';
        $letters->foto1 = $foto1;
        $letters->foto2 = $foto2;
        $letters->foto3 = $foto3;
        // $letters->foto1 = $path1 ?? 'foto tidak ada';
        // $letters->foto2 = $path2 ?? 'foto tidak ada';
        // $letters->foto3 = $path3 ?? 'foto tidak ada';

        if ($letters->save()) {
            return redirect('/pengajuan/{id_user}')->with([
                'notifikasi' => 'Data Berhasil disimpan !',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->
                with([
                    'notifikasi' => 'Data gagal disimpan !',
                    'type' => 'error'
                ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id_surat_izin)
    {
        $letters = Letter::all();

        return view('pengajuan.pengajuan_surat', ['letters' => $letters])
        ->with(['user' => Auth::user()]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $letter = Letter::where(['nim' => $id]);
        if ($letter->count() < 1) {
            return redirect('/letter')->with([
                'notifikasi' => 'Data siswa tidak ditemukan !',
                'type' => 'error'
            ]);
        }
        return view('letter.edit', ['letter' => $letter->first()]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $letter = letter::where(['nim' => $id]);
        if ($letter->count() < 1) {
            return redirect('/letter')->with([
                'notifikasi' => 'Data siswa tidak ditemukan !',
                'type' => 'error'
            ]);
        }
        if ($letter->first()->delete()) {
            return redirect('/letter')->with([
                'notifikasi' => 'Data Berhasil dihapus !',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Data gagal dihapus !',
                'type' => 'error'
            ]);
        }
    }
}
