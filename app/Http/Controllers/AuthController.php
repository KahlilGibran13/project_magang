<?php

namespace App\Http\Controllers;

use App\Models\c_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * fungsi yang digunakan untuk melakukan pengecekan data user yang digunakan untuk login
     */
    public function authentication(Request $request)
    {
        /**
         * memvalidasi data yang dikirimkan oleh user
         */
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        /**
         * mengubah key email menjadi user_name
         */
        $credentials = [
            'user_name' => $credentials['email'], 
            'password' => $credentials['password']
        ];

        /**
         * melakukan pengecekan data user yang digunakan untuk login
         */
        if (Auth::attempt($credentials)) {

            /**
             * jika data user yang digunakan untuk login benar maka akan diarahkan ke halaman dashboard
             */
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        /** 
         * jika data user yang digunakan untuk login salah maka akan diarahkan kembali ke halaman login
         */
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * fungsi yang digunakan untuk melakukan logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        /**
         * jika user berhasil logout maka akan diarahkan ke halaman login
         */
        return redirect('/masuk');
    }

    /**
     * fungsi yang digunakan untuk menampilkan meyimpan data user yang digunakan untuk registrasi
     */
    public function register(Request $request)
    {
        /**
         * memvalidasi data yang dikirimkan oleh user
         */
        $credentials = $request->validate([
            'user_fullname' => ['required'],
            'user_name' => ['required', 'email'],
            'user_password' => ['required', 'confirmed'],
            'user_role_id' => 'required'
        ]);

        /**
         * mengenkripsi password user
         */
        $credentials['user_password'] = bcrypt($credentials['user_password']);

        /**
         * menyimpan data user yang digunakan untuk registrasi
         */
        $regist = c_user::create($credentials);

        /**
         * jika data user yang digunakan untuk registrasi berhasil disimpan maka akan diarahkan ke halaman login
         */
        if ($regist) {
            return redirect()->route('login');
        }

        /**
         * jika data user yang digunakan untuk registrasi gagal disimpan maka akan diarahkan kembali ke halaman registrasi
         */
        return back()->withErrors([
            'error' => 'Gagal Mendaftar',
        ]);
    }
}
