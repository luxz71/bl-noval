<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan form register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi user baru
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat user baru dengan role 'user'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // Default role user
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Memvalidasi login dan membuat session
     */
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil kredensial
        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke halaman produk
            return redirect()->route('produk.index');
        }

        // Jika gagal, kembali dengan pesan error
        return back()->with('error', 'Email atau password salah');
    }

    /**
     * Menampilkan halaman profile
     */
    public function profile()
    {
        return view('auth.profile');
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek password lama
        if (!password_verify($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini salah');
        }

        // Update password baru
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }

    /**
     * Logout user dan hapus session
     */
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Hapus session
        $request->session()->invalidate();

        // Regenerate token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
