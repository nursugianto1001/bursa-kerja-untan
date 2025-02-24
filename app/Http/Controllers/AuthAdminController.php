<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthAdminController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Admin registered successfully'], 201);
    }

    public function login(Request $request)
{
    $request->validate([
        'nip' => 'required|string',
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $admin = Admin::where('email', $request->email)
                 ->where('nip', $request->nip)
                 ->first();

    if (!$admin || !Hash::check($request->password, $admin->password)) {
        throw ValidationException::withMessages([
            'email' => 'Invalid credentials',
        ]);
    }

    $token = $admin->createToken('admin-token')->plainTextToken;

    return response()->json([
        'message' => 'Login berhasil!',
        'token' => $token,
        'admin' => $admin,
    ]);
}

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

