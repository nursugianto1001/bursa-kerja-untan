<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthAlumniController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:alumnis',
            'email' => 'required|email|unique:alumnis',
            'program_studi' => 'required',
            'jurusan' => 'required',
            'tahun_masuk' => 'required|digits:4',
            'tahun_lulus' => 'required|digits:4',
            'password' => 'required|min:6',
        ]);

        $alumni = Alumni::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'program_studi' => $request->program_studi,
            'jurusan' => $request->jurusan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Alumni registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $alumni = Alumni::where('email', $request->email)->first();

        if (!$alumni || !Hash::check($request->password, $alumni->password)) {
            throw ValidationException::withMessages(['email' => 'Invalid credentials']);
        }

        $token = $alumni->createToken('alumni-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

