<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;


class SiswaController extends Controller
{

    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();

        $totalAspirasi = Aspirasi::where('siswa_id', $siswa->id)->count();
        $menunggu = Aspirasi::where('siswa_id', $siswa->id)->where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('siswa_id', $siswa->id)->where('status', 'Proses')->count();
        $selesai = Aspirasi::where('siswa_id', $siswa->id)->where('status', 'Selesai')->count();

        $aspirasiTerbaru = Aspirasi::with(['kategori', 'inputAspirasi'])
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('siswa.dashboard', compact('siswa', 'totalAspirasi', 'menunggu', 'proses', 'selesai', 'aspirasiTerbaru'));
    }

    public function formAspirasi()
    {
        $kategoriList = Kategori::all();
        
        return view('siswa.aspirasi.form', compact('kategoriList'));
    }

    public function storeAspirasi(Request $request)
    {
        $request->validate([
            'id_kategori' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!Kategori::isValidId($value)) {
                        $fail('Kategori yang dipilih tidak valid.');
                    }
                },
            ],
            'lokasi' => 'required|string|max:50',
            'ket' => 'required|string|max:50',
        ]);

        $siswa = Auth::guard('siswa')->user();

        $idPelaporan = time();

        try {
            DB::beginTransaction();

            $inputAspirasi = InputAspirasi::create([
                'id_pelaporan' => $idPelaporan,
                'nis' => $siswa->nis,
                'id_kategori' => $request->id_kategori,
                'lokasi' => $request->lokasi,
                'ket' => $request->ket,
            ]);

            $idAspirasi = time() + 1;

            $aspirasi = Aspirasi::create([
                'id_aspirasi' => $idAspirasi,
                'siswa_id' => $siswa->id,
                'id_kategori' => $request->id_kategori,
                'id_pelaporan' => $idPelaporan,
                'status' => 'Menunggu',
            ]);

            DB::commit();

            $kategoriNama = Kategori::getNameById($request->id_kategori);
            return redirect()->route('siswa.dashboard')
                ->with('success', "Aspirasi untuk kategori {$kategoriNama} berhasil diajukan! Tim kami akan segera menindaklanjuti.");

        } catch (\Exception $e) {
            DB::rollBack();
            
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan aspirasi. Silakan coba lagi.');
        }
    }

    public function statusPenyelesaian()
{
    $siswa = Auth::guard('siswa')->user();

    $aspirasi = Aspirasi::with(['kategori', 'inputAspirasi'])
        ->where('siswa_id', $siswa->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('siswa.aspirasi.status', compact('aspirasi'));
}
    public function historiUser()
{
    $siswa = Auth::guard('siswa')->user();

    $histori = Aspirasi::with(['kategori', 'inputAspirasi'])
        ->where('siswa_id', $siswa->id)
        ->where('status', 'Selesai')
        ->orderBy('updated_at', 'desc')
        ->get();

    return view('siswa.aspirasi.histori', compact('histori'));
}

    public function viewFeedback()
    {
        $siswa = Auth::guard('siswa')->user();

        $aspirasiWithFeedback = Aspirasi::with(['kategori', 'inputAspirasi'])
            ->where('siswa_id', $siswa->id)
            ->whereNotNull('feedback')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('siswa.aspirasi.feedback', compact('aspirasiWithFeedback'));
    }

    public function progressPerbaikan()
    {
    $siswa = Auth::guard('siswa')->user();

    $progress = Aspirasi::with(['kategori', 'inputAspirasi'])
        ->where('siswa_id', $siswa->id)
        ->whereIn('status', ['Menunggu', 'Proses'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('siswa.aspirasi.progress', compact('progress'));
}
}