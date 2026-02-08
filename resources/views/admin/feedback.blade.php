<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">⭐ Feedback Siswa</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Dashboard</a>
                <a href="{{ route('admin.aspirasi.list') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Daftar Aspirasi</a>
                <a href="{{ route('admin.histori') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Histori</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-5 py-8">
        <div class="bg-white rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-5">Feedback dari Siswa</h2>
            <p class="text-gray-600 mb-6">Daftar aspirasi yang sudah selesai dan telah diberi feedback oleh siswa</p>
            
            @if($feedback->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Selesai</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Rating</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedback as $index => $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3">{{ $item->siswa->nama }}</td>
                                    <td class="px-4 py-3">{{ $item->kategori->ket_kategori }}</td>
                                    <td class="px-4 py-3">{{ $item->inputAspirasi->lokasi }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $item->feedback)
                                                    <span class="text-yellow-400">⭐</span>
                                                @else
                                                    <span class="text-gray-300">⭐</span>
                                                @endif
                                            @endfor
                                            <span class="text-sm text-gray-600">({{ $item->feedback }}/5)</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('admin.aspirasi.detail', $item->id_aspirasi) }}" class="px-4 py-1.5 bg-[#667eea] text-white text-sm rounded-md hover:bg-[#5568d3]">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-gray-400 py-10">Belum ada feedback dari siswa.</p>
            @endif
        </div>
    </div>
</body>
</html>