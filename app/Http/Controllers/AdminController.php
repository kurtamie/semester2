<?php namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\SuratSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminController extends Controller {

    public function accept($id_surat_izin) {
        $data = Letter::find($id_surat_izin);
        $data ->status='SELESAI';
        $data ->save();
        return redirect()->back();
    }

    public function reject($id_surat_izin) {
        $data = Letter::find($id_surat_izin);
        $data ->status='TOLAK';
        $data ->save();
        return redirect()->back();
    }

    public function tolak($id_surat_survey) {
        $data = SuratSurvey::find($id_surat_survey);
        $data ->status='TOLAK';
        $data ->save();
        return redirect()->back();
    }

    public function upload(Request $request, $id_surat_survey) {
    // Validasi file yang diunggah
    $request->validate([
        'pdf_file' => 'nullable|mimes:pdf|max:2048',
    ]);

    // Cek apakah ada file yang diunggah
    if ($request->hasFile('pdf_file')) {
        // Simpan file PDF yang diunggah ke direktori tertentu
        $pdfFile = $request->file('pdf_file');
        $fileName = $id_surat_survey . '.' . $pdfFile->getClientOriginalExtension();
        $pdfFile->storeAs('pdf_files', $fileName);

        // Update data dengan status terkait dan nama file PDF
        $data = SuratSurvey::find($id_surat_survey);

        // Periksa apakah data ditemukan
        if ($data) {
            $data->status = 'TERIMA';
            $data->pdf_file = $fileName;
            $data->save();

            return redirect()->back()->with('success', 'File PDF berhasil diunggah!');
        }
        } else {
        // Update data dengan status terkait, tetapi tidak menyimpan nama file PDF
        $data = SuratSurvey::find($id_surat_survey);

        // Periksa apakah data ditemukan
        if ($data) {
            $data->status = 'TERIMA';
            $data->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        }
        }

    return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah file PDF.');
    }

    public function tabel_izin(){

        $letters = Letter::all();

        return view('admin.tabel_izin',['letters' => $letters])

        -> with(['user' => Auth::user()]);

    }

    public function tabel_survey(){

        $surveys = SuratSurvey::all();

        return view('admin.tabel_survey',['surveys' => $surveys])

        -> with(['user' => Auth::user()]);

    }
}
