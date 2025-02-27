<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancies;
use Illuminate\Support\Facades\Auth;

class JobVacanciesController extends Controller
{
    /**
     * Menampilkan semua lowongan kerja yang sudah disetujui (approved)
     */
    public function index()
    {
        $job = JobVacancies::where('status', 'approved')->get();
        return response()->json($job);
    }

    /**
     * Menampilkan detail lowongan kerja berdasarkan ID
     */
    public function show($id)
    {
        $job = JobVacancies::findOrFail($id);
        return response()->json($job);
    }

    /**
     * Admin menambahkan lowongan kerja
     */
    public function store(Request $request)
    {
        // Pastikan hanya admin yang bisa menambahkan
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string',
        ]);

        $job = JobVacancies::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'location' => $validated['location'],
            'status' => 'pending', // Default pending, harus disetujui admin
        ]);

        return response()->json([
            'message' => 'Lowongan berhasil dibuat dan menunggu persetujuan.',
            'job' => $job,
        ], 201);
    }

    /**
     * Admin menyetujui atau menolak lowongan kerja
     */
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $job = JobVacancies::findOrFail($id);
        $job->status = $validated['status'];
        $job->save();

        return response()->json(['message' => 'Status lowongan diperbarui', 'job' => $job]);
    }

    /**
     * Admin menghapus lowongan kerja
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $job = JobVacancies::findOrFail($id);
        $job->delete();

        return response()->json(['message' => 'Lowongan berhasil dihapus']);
    }
}
