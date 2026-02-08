<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Perbaikan - Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">🔧 Progress Perbaikan</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Dashboard</a>
                <a href="{{ route('siswa.aspirasi.form') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">➕ Ajukan Aspirasi</a>
                <a href="{{ route('siswa.aspirasi.status') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">📊 Status</a>
                <form action="{{ route('siswa.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-5 py-8">
        <div class="bg-white rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-5">Aspirasi yang Sedang Diproses</h2>
            
            @if($progress->count() > 0)
                <div class="space-y-6">
                    @foreach($progress as $item)
                        <div class="border-2 border-blue-200 rounded-lg p-6 bg-blue-50">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">{{ $item->kategori->ket_kategori }}</h3>
                                    <p class="text-gray-600">{{ $item->inputAspirasi->lokasi }}</p>
                                </div>
                                <span class="px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">🔧 Dalam Proses</span>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-700"><strong>Keterangan:</strong> {{ $item->inputAspirasi->ket }}</p>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm text-gray-600">Tanggal Lapor</p>
                                    <p class="font-semibold text-gray-800">{{ $item->created_at->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Durasi Proses</p>
                                    <p class="font-semibold text-gray-800">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-white p-4 rounded-lg">
                                <p class="text-sm text-blue-600">ℹ️ Tim kami sedang menangani masalah ini. Terima kasih atas kesabaran Anda!</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-400 py-10">
                    Tidak ada aspirasi yang sedang diproses saat ini.
                </p>
            @endif
        </div>
    </div>
</body>
</html>