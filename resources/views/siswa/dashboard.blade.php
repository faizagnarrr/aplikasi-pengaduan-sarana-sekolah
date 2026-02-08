<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">🎓 Dashboard Siswa</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('siswa.aspirasi.form') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">➕ Ajukan Aspirasi</a>
                <a href="{{ route('siswa.aspirasi.status') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">📊 Status Aspirasi</a>
                <a href="{{ route('siswa.aspirasi.histori') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">📜 Histori</a>
                <form action="{{ route('siswa.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-5 py-8">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-lg mb-5">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white p-8 rounded-xl mb-8 shadow-xl">
            <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ $siswa->nama }}! 👋</h2>
            <p class="opacity-90">NIS: {{ $siswa->nis }} | Kelas: {{ $siswa->kelas }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-md text-center hover:-translate-y-1 transition-transform">
                <div class="text-4xl mb-2">📝</div>
                <div class="text-4xl font-bold text-[#9b59b6] mb-1">{{ $totalAspirasi }}</div>
                <h3 class="text-gray-600 text-sm font-semibold uppercase">Total Aspirasi</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center hover:-translate-y-1 transition-transform">
                <div class="text-4xl mb-2">⏳</div>
                <div class="text-4xl font-bold text-[#f39c12] mb-1">{{ $menunggu }}</div>
                <h3 class="text-gray-600 text-sm font-semibold uppercase">Menunggu</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center hover:-translate-y-1 transition-transform">
                <div class="text-4xl mb-2">🔧</div>
                <div class="text-4xl font-bold text-[#3498db] mb-1">{{ $proses }}</div>
                <h3 class="text-gray-600 text-sm font-semibold uppercase">Dalam Proses</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center hover:-translate-y-1 transition-transform">
                <div class="text-4xl mb-2">✅</div>
                <div class="text-4xl font-bold text-[#27ae60] mb-1">{{ $selesai }}</div>
                <h3 class="text-gray-600 text-sm font-semibold uppercase">Selesai</h3>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl mb-8 shadow-md text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-3">📢 Ada Masalah dengan Sarana Sekolah?</h2>
            <p class="text-gray-600 mb-6">Laporkan masalah yang Anda temukan dan kami akan segera menindaklanjutinya!</p>
            <a href="{{ route('siswa.aspirasi.form') }}" class="inline-block px-10 py-4 bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white rounded-lg font-semibold shadow-lg hover:-translate-y-1 transition-all">
                Ajukan Aspirasi Baru
            </a>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-5">📋 Aspirasi Terbaru Anda</h2>
            @if($aspirasiTerbaru->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan</th>
                                <th class="px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aspirasiTerbaru as $aspirasi)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-4">{{ $aspirasi->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-4">{{ $aspirasi->kategori->ket_kategori ?? 'N/A' }}</td>
                                    <td class="px-4 py-4">{{ $aspirasi->inputAspirasi->lokasi ?? 'N/A' }}</td>
                                    <td class="px-4 py-4">{{ Str::limit($aspirasi->inputAspirasi->ket ?? 'N/A', 40) }}</td>
                                    <td class="px-4 py-4">
                                        @if($aspirasi->status == 'Menunggu')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Menunggu</span>
                                        @elseif($aspirasi->status == 'Proses')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Proses</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-center mt-5">
                    <a href="{{ route('siswa.aspirasi.status') }}" class="text-[#f5576c] hover:underline">
                        Lihat Semua Aspirasi →
                    </a>
                </p>
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