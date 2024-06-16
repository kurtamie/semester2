<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


class LoginController extends Controller
{
    public function index() {
        if($user = Auth::user())
        {
            // if($user->level == 'admin')
            // {
            //     return redirect()->intended('admin');

            // } elseif ($user->level=='mahasiswa')
            // {
            //     return redirect()->intended('mahasiswa');
            // }
            return redirect()->intended('home');
        }

        return view('login.view_login');
    }

    public function proses(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
        ]);

        $kredensial = $request->only('username','password');

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // if ($user->level =='admin') {
            //     return redirect()->intended('admin');
            // } elseif ($user->level =='mahasiswa') {
            //     return redirect()->intended('mahasiswa');
            // }
            if($user){
                return redirect()->intended('home');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username'=>'Maaf username atau password anda salah',
        ])->onlyInput('username');
    }

    public function register() {
        return view('register.register');
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'nama' => 'required',
            'nim' => 'required|unique:users', // Menambahkan aturan unik pada kolom 'nim'
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'nama.required' => 'Nama harus diisi.',
            'nim.required' => 'NIM harus diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password studi harus diisi.',
        ]);

        // Cek apakah NIM atau username sudah ada dalam database
        if (User::where('nim', $validatedData['nim'])->exists() || User::where('username', $validatedData['username'])->exists()) {
            return redirect()->back()->with([
                'notifikasi' => 'NIM atau Username sudah digunakan.',
                'type' => 'error'
            ]);
        }

        $user = User::create([
            'username' => $validatedData['username'],
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'nim' => $validatedData['nim'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if ($user->save()) {
            return redirect('/login')->with([
                'notifikasi' => 'Akun anda telah dibuat!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Gagal membuat akun! isi dengan benar!',
                'type' => 'error'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session::flush();

        return redirect('login');
    }

}
