<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses   = Aspirasi::where('status', 'Proses')->count();
        $selesai  = Aspirasi::where('status', 'Selesai')->count();

        $aspirasiTerbaru = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('menunggu', 'proses', 'selesai', 'aspirasiTerbaru'));
    }

    public function listAspirasi(Request $request)
    {
        $query = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->filled('siswa_id')) {
            $query->where('siswa_id', $request->siswa_id);
        }
        if ($request->filled('kategori') && Kategori::isValidId($request->kategori)) {
            $query->where('id_kategori', $request->kategori);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirasi     = $query->orderBy('created_at', 'desc')->paginate(20);
        $kategoriList = Kategori::all();
        $siswaList    = Siswa::all();

        $statistik = [
            'total'    => Aspirasi::count(),
            'menunggu' => Aspirasi::where('status', 'Menunggu')->count(),
            'proses'   => Aspirasi::where('status', 'Proses')->count(),
            'selesai'  => Aspirasi::where('status', 'Selesai')->count(),
        ];

        return view('admin.aspirasi.list', compact('aspirasi', 'kategoriList', 'siswaList', 'statistik'));
    }

    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi'])->findOrFail($id);
        return view('admin.aspirasi.detail', compact('aspirasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai'
        ]);

        $aspirasi         = Aspirasi::findOrFail($id);
        $aspirasi->status = $request->status;
        $aspirasi->save();

        return redirect()->back()->with('success', 'Status aspirasi berhasil diperbarui menjadi ' . $request->status);
    }

    /**
     * Admin memberikan umpan balik TEXT ke kolom admin_feedback
     */
    public function submitFeedback(Request $request, $id)
    {
        $request->validate([
            'admin_feedback' => 'required|string|min:10|max:1000'
        ], [
            'admin_feedback.required' => 'Umpan balik harus diisi',
            'admin_feedback.min'      => 'Umpan balik minimal 10 karakter',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        if ($aspirasi->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Umpan balik hanya untuk aspirasi yang sudah Selesai.');
        }

        // Simpan ke kolom admin_feedback (BUKAN feedback yang untuk rating siswa)
        $aspirasi->admin_feedback = $request->admin_feedback;
        $aspirasi->save();

        return redirect()->back()->with('success', 'Umpan balik berhasil disimpan dan dapat dilihat oleh siswa!');
    }

    public function viewFeedback()
    {
        // Query dari kolom admin_feedback
        $feedback = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi'])
            ->whereNotNull('admin_feedback')
            ->where('status', 'Selesai')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.feedback', compact('feedback'));
    }

    public function histori()
    {
        $histori = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi'])
            ->where('status', 'Selesai')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.histori', compact('histori'));
    }
}