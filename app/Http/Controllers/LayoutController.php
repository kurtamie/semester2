<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratSurvey;
use App\Models\Letter;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index ()
    {

        {
            $totalDiproses = Letter::where('status', 'PROSES')->count();
            $totalSelesai = Letter::where('status', 'SELESAI')->count();
            $totalTolak = Letter::where('status', 'TOLAK')->count();

            $totalProses = SuratSurvey::where('status', 'PROSES')->count();
            $totalDiterima = SuratSurvey::where('status', 'TERIMA')->count();
            $totalDitolak = SuratSurvey::where('status', 'TOLAK')->count();


            $letters = Letter::count();
            $surveys = SuratSurvey::count();

            return view('layout.home', [
                'letters' => $letters,
                'totalDiproses' => $totalDiproses,
                'totalSelesai' => $totalSelesai,
                'totalTolak' => $totalTolak,
                ], [
                'surveys' => $surveys,
                'totalProses' => $totalProses,
                'totalDiterima' => $totalDiterima,
                'totalDitolak' => $totalDitolak,

                ])->with(['user' => Auth::user()]);
        }


        // $surveysCount = SuratSurvey::count();

        // $lettersCount = Letter::count();
        // return view('layout.home',['letters_count' => $lettersCount], ['surveys_count' => $surveysCount])

        // -> with(['user' => Auth::user()]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
