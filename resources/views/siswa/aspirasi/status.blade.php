<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Aspirasi - Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📊 Status Aspirasi</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Dashboard</a>
                <a href="{{ route('siswa.aspirasi.form') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">➕ Ajukan Aspirasi</a>
                <a href="{{ route('siswa.aspirasi.histori') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">📜 Histori</a>
                <form action="{{ route('siswa.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-5 py-8">
        <div class="bg-white rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-5">Status Semua Aspirasi Anda</h2>
            
            @if($aspirasi->count() > 0)
                <div class="space-y-4">
                    @foreach($aspirasi as $item)
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-[#f5576c] transition-colors">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">{{ $item->kategori->ket_kategori }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->inputAspirasi->lokasi }}</p>
                                </div>
                                @if($item->status == 'Menunggu')
                                    <span class="px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">⏳ Menunggu</span>
                                @elseif($item->status == 'Proses')
                                    <span class="px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">🔧 Dalam Proses</span>
                                @else
                                    <span class="px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">✅ Selesai</span>
                                @endif
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-700">{{ $item->inputAspirasi->ket }}</p>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm text-gray-600">
                                <span>Dilaporkan: {{ $item->created_at->format('d F Y, H:i') }}</span>
                                @if($item->status == 'Selesai' && !$item->feedback)
                                    <form action="{{ route('siswa.aspirasi.feedback', $item->id_aspirasi) }}" method="POST" class="inline">
                                        @csrf
                                        <select name="rating" required class="px-3 py-1 border border-gray-300 rounded mr-2">
                                            <option value="">Beri Rating</option>
                                            <option value="1">⭐ 1</option>
                                            <option value="2">⭐ 2</option>
                                            <option value="3">⭐ 3</option>
                                            <option value="4">⭐ 4</option>
                                            <option value="5">⭐ 5</option>
                                        </select>
                                        <button type="submit" class="px-4 py-1 bg-[#f5576c] text-white rounded hover:bg-[#e04858]">
                                            Submit Rating
                                        </button>
                                    </form>
                                @elseif($item->feedback)
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-600">Rating Anda:</span>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $item->feedback)
                                                <span class="text-yellow-400">⭐</span>
                                            @else
                                                <span class="text-gray-300">⭐</span>
                                            @endif
                                        @endfor
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-400 py-10">
                    Anda belum pernah mengajukan aspirasi. <br>
                    <a href="{{ route('siswa.aspirasi.form') }}" class="text-[#f5576c] hover:underline">
                        Ajukan aspirasi pertama Anda sekarang!
                    </a>
                </p>
            @endif
        </div>
    </div>
</body>
</html>