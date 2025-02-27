<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register user baru (Alumni atau Admin Kampus)
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,alumni',
            'nip' => 'nullable|required_if:role,admin|unique:users',
            'nim' => 'nullable|required_if:role,alumni|unique:users',
            'program_studi' => 'nullable|required_if:role,alumni',
            'jurusan' => 'nullable|required_if:role,alumni',
            'tahun_masuk' => 'nullable|required_if:role,alumni|digits:4',
            'tahun_lulus' => 'nullable|required_if:role,alumni|digits:4',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nip' => $validated['nip'] ?? null,
            'nim' => $validated['nim'] ?? null,
            'program_studi' => $validated['program_studi'] ?? null,
            'jurusan' => $validated['jurusan'] ?? null,
            'tahun_masuk' => $validated['tahun_masuk'] ?? null,
            'tahun_lulus' => $validated['tahun_lulus'] ?? null,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Login user (Admin Kampus atau Alumni)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil!',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Logout user & hapus token
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil!',
        ]);
    }

    /**
     * Mendapatkan informasi user yang sedang login
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }
}
