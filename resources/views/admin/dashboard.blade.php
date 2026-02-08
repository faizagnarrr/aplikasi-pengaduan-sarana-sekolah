<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">🏫 Dashboard Admin</h1>
            <div class="flex gap-4 items-center">
                <span class="text-sm">Selamat datang, Admin!</span>
                <a href="{{ route('admin.aspirasi.list') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Daftar Aspirasi</a>
                <a href="{{ route('admin.feedback') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Feedback</a>
                <a href="{{ route('admin.histori') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Histori</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-5 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-md hover:-translate-y-1 transition-transform">
                <h3 class="text-gray-600 text-sm font-semibold uppercase mb-2">⏳ Menunggu</h3>
                <div class="text-4xl font-bold text-[#f39c12] mb-1">{{ $menunggu }}</div>
                <p class="text-gray-600 text-sm">Aspirasi belum ditangani</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:-translate-y-1 transition-transform">
                <h3 class="text-gray-600 text-sm font-semibold uppercase mb-2">🔧 Dalam Proses</h3>
                <div class="text-4xl font-bold text-[#3498db] mb-1">{{ $proses }}</div>
                <p class="text-gray-600 text-sm">Aspirasi sedang dikerjakan</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:-translate-y-1 transition-transform">
                <h3 class="text-gray-600 text-sm font-semibold uppercase mb-2">✅ Selesai</h3>
                <div class="text-4xl font-bold text-[#27ae60] mb-1">{{ $selesai }}</div>
                <p class="text-gray-600 text-sm">Aspirasi telah ditangani</p>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-5">📋 Aspirasi Terbaru</h2>
            @if($aspirasiTerbaru->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama Siswa</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kelas</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aspirasiTerbaru as $index => $aspirasi)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-4">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4">{{ $aspirasi->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-4">{{ $aspirasi->siswa->nama ?? 'N/A' }}</td>
                                    <td class="px-4 py-4">{{ $aspirasi->siswa->kelas ?? 'N/A' }}</td>
                                    <td class="px-4 py-4">{{ $aspirasi->kategori->ket_kategori ?? 'N/A' }}</td>
                                    <td class="px-4 py-4">{{ $aspirasi->inputAspirasi->lokasi ?? 'N/A' }}</td>
                                    <td class="px-4 py-4">
                                        @if($aspirasi->status == 'Menunggu')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Menunggu</span>
                                        @elseif($aspirasi->status == 'Proses')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Proses</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <a href="{{ route('admin.aspirasi.detail', $aspirasi->id_aspirasi) }}" class="px-4 py-1.5 bg-[#667eea] text-white text-sm rounded-md hover:bg-[#5568d3]">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-gray-400 py-10">Belum ada aspirasi yang masuk.</p>
            @endif
        </div>
    </div>
</body>
</html>