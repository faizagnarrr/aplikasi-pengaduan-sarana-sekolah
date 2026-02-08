<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aspirasi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📋 Daftar Aspirasi</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">Dashboard</a>
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
        <!-- Filter Section -->
        <div class="bg-white rounded-xl p-6 shadow-md mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">🔍 Filter Aspirasi</h3>
            <form method="GET" action="{{ route('admin.aspirasi.list') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#667eea]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#667eea]">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#667eea]">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="px-6 py-2 bg-[#667eea] text-white rounded-lg hover:bg-[#5568d3] transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('admin.aspirasi.list') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Statistics -->
        @if(isset($statistik))
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                <div class="text-2xl font-bold text-[#9b59b6]">{{ $statistik['total'] }}</div>
                <div class="text-sm text-gray-600">Total</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                <div class="text-2xl font-bold text-[#f39c12]">{{ $statistik['menunggu'] }}</div>
                <div class="text-sm text-gray-600">Menunggu</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                <div class="text-2xl font-bold text-[#3498db]">{{ $statistik['proses'] }}</div>
                <div class="text-sm text-gray-600">Proses</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                <div class="text-2xl font-bold text-[#27ae60]">{{ $statistik['selesai'] }}</div>
                <div class="text-sm text-gray-600">Selesai</div>
            </div>
        </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-xl p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-5">Daftar Semua Aspirasi</h2>
            
            @if($aspirasi->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kelas</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aspirasi as $index => $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $aspirasi->firstItem() + $index }}</td>
                                    <td class="px-4 py-3">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ $item->siswa->nama }}</td>
                                    <td class="px-4 py-3">{{ $item->siswa->kelas }}</td>
                                    <td class="px-4 py-3">{{ $item->kategori->ket_kategori }}</td>
                                    <td class="px-4 py-3">{{ $item->inputAspirasi->lokasi }}</td>
                                    <td class="px-4 py-3">
                                        @if($item->status == 'Menunggu')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Menunggu</span>
                                        @elseif($item->status == 'Proses')
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Proses</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Selesai</span>
                                        @endif
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

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $aspirasi->links() }}
                </div>
            @else
                <p class="text-center text-gray-400 py-10">Tidak ada aspirasi ditemukan.</p>
            @endif
        </div>
    </div>
</body>
</html>