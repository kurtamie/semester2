<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratSurvey;
use App\Models\Letter;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function show(string $id_user)
    {
        $surveys = SuratSurvey::all();

        $letters = Letter::all();

        return view('admin.riwayat',['letters' => $letters], ['surveys' => $surveys])

        -> with(['user' => Auth::user()]);
    }
}
