<?php

namespace App\Http\Controllers;


use App\Models\Letter;
use App\Models\SuratSurvey;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class SurveyController extends Controller
{
    public function index()
    {
        // Memanggil seluruh data dari table letter
        $surveys = SuratSurvey::all();

        return view('survey.index', ['surveys' =>$surveys]);

    }
    public function create()
    {
        return view('survey.index')
        -> with(['user' => Auth::user()]);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'nim' => 'required',
            'pdf_file' => 'nullable|mimes:pdf|max:2048',
            'nama' => 'required',
            'alamat_instansi' => 'required',
            'alamat_tujuan' => 'required',
            'keperluan_mahasiswa' => 'required',
            'tugas_yang_dikerjakan' => 'required',

        ],[
            'alamat_instansi.required' => 'Nama dan Bagian Perusahaan harus diisi',
            'nim.required' => 'NIM harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'keperluan_mahasiswa.required' => 'Keperluan Mahasiswa harus diisi',
            'tugas_yang_dikerjakan.required' => 'Tugas Yang Dikerjakan harus diisi',
        ]);

        $surveys = new SuratSurvey();
        $surveys->id_user = $request->id_user;
        $surveys->nim = $request->nim;
        $surveys->nama = $request->nama;
        $surveys->alamat_instansi = $request->alamat_instansi;
        $surveys->alamat_tujuan = $request->alamat_tujuan;
        $surveys->keperluan_mahasiswa = $request->keperluan_mahasiswa;
        $surveys->tugas_yang_dikerjakan = $request->tugas_yang_dikerjakan;
        $surveys->status = 'PROSES';

        if ($surveys->save()) {
            return redirect('/pengajuan/{id}')->with([
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

    public function show(string $id_surat_survey)
    {
        $surveys = SuratSurvey::all();

        return view('pengajuan.pengajuan_surat', ['surveys' => $surveys])

        -> with(['user' => Auth::user()]);
    }

    public function download(string $id_surat_survey) {
        $surveys = SuratSurvey::where(['id_surat_survey'=> $id_surat_survey])->firstOrFail();

        $file_path=public_path('storage/pdf_files/'.$surveys->pdf_file);

        $fileName='pdf_file'.$surveys->id_surat_survey . '.'. pathinfo($file_path, PATHINFO_EXTENSION);

        return response()->download($file_path, $fileName);
    }
}
