<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umpan Balik - Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">💬 Umpan Balik dari Admin</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Dashboard</a>
                <a href="{{ route('siswa.aspirasi.status') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Status</a>
                <a href="{{ route('siswa.aspirasi.histori') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Histori</a>
                <form action="{{ route('siswa.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-5 py-8">
        <div class="bg-white rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Umpan Balik untuk Aspirasi Anda</h2>
            <p class="text-gray-600 mb-6">Keterangan dari admin tentang penanganan aspirasi Anda</p>

            {{-- Gunakan $feedbackList sesuai dengan variable dari Controller --}}
            @if($feedbackList->count() > 0)
                <div class="space-y-5">
                    @foreach($feedbackList as $item)
                        <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-[#f5576c] transition-colors">
                            {{-- Header: kategori & status --}}
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">{{ $item->kategori->ket_kategori }}</h3>
                                    <p class="text-sm text-gray-500">📍 {{ $item->inputAspirasi->lokasi }}</p>
                                    <p class="text-xs text-gray-400 mt-1">Dilaporkan: {{ $item->created_at->format('d F Y') }}</p>
                                </div>
                                <span class="px-4 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    ✅ Selesai
                                </span>
                            </div>

                            {{-- Masalah yang dilaporkan --}}
                            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                <p class="text-xs font-semibold text-gray-500 mb-1">MASALAH YANG DILAPORKAN:</p>
                                <p class="text-gray-700 text-sm">{{ $item->inputAspirasi->ket }}</p>
                            </div>

                            {{-- Umpan balik dari admin --}}
                            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-4">
                                <p class="text-xs font-semibold text-blue-700 mb-2">💬 UMPAN BALIK DARI ADMIN:</p>
                                <p class="text-gray-800">{{ $item->admin_feedback }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-5xl mb-4">📭</p>
                    <p class="text-gray-500 text-lg">Belum ada umpan balik dari admin.</p>
                    <p class="text-gray-400 text-sm mt-2">Umpan balik akan muncul setelah admin menyelesaikan dan memberi keterangan pada aspirasi Anda.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>