<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Siswa;


class AdminController extends Controller
{
    public function dashboard()
    {
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();

        $aspirasiTerbaru = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('menunggu', 'proses', 'selesai', 'aspirasiTerbaru'));
    }

    public function listAspirasi(Request $request)
    {
        $query = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi']);

        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->has('bulan') && $request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }

        if ($request->has('siswa_id') && $request->siswa_id) {
            $query->where('siswa_id', $request->siswa_id);
        }

        if ($request->has('kategori') && $request->kategori) {
            if (Kategori::isValidId($request->kategori)) {
                $query->where('id_kategori', $request->kategori);
            }
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $aspirasi = $query->orderBy('created_at', 'desc')->paginate(20);

        $kategoriList = Kategori::all();
        $siswaList = Siswa::all();

        $statistik = [
            'total' => $query->count(),
            'menunggu' => Aspirasi::where('status', 'Menunggu')->count(),
            'proses' => Aspirasi::where('status', 'Proses')->count(),
            'selesai' => Aspirasi::where('status', 'Selesai')->count(),
        ];

        return view('admin.aspirasi.list', compact('aspirasi', 'kategoriList', 'siswaList', 'statistik'));
    }

    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi'])
            ->findOrFail($id);

        return view('admin.aspirasi.detail', compact('aspirasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->status = $request->status;
        $aspirasi->save();

        return redirect()->back()->with('success', 'Status aspirasi berhasil diperbarui');
    }

    public function submitFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|max:500'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->feedback = $request->feedback;
        $aspirasi->save();

        return redirect()->back()->with('success', 'Umpan balik berhasil disimpan');
    }

    public function viewFeedback()
    {
    $feedback = Aspirasi::with(['siswa', 'kategori', 'inputAspirasi'])
        ->whereNotNull('feedback')
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