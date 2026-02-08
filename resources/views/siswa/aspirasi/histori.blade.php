<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Aspirasi - Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📜 Histori Aspirasi</h1>
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
            <h2 class="text-xl font-bold text-gray-800 mb-5">Riwayat Aspirasi yang Sudah Selesai</h2>
            
            @if($histori->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Lapor</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Selesai</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histori as $index => $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ $item->updated_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ $item->kategori->ket_kategori }}</td>
                                    <td class="px-4 py-3">{{ $item->inputAspirasi->lokasi }}</td>
                                    <td class="px-4 py-3">{{ Str::limit($item->inputAspirasi->ket, 30) }}</td>
                                    <td class="px-4 py-3">
                                        @if($item->feedback)
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $item->feedback)
                                                        <span class="text-yellow-400">⭐</span>
                                                    @else
                                                        <span class="text-gray-300">⭐</span>
                                                    @endif
                                                @endfor
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">Belum diberi</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-gray-400 py-10">
                    Belum ada aspirasi yang selesai.
                </p>
            @endif
        </div>
    </div>
</body>
</html>