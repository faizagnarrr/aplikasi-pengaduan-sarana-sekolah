<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📄 Detail Aspirasi</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('admin.aspirasi.list') }}" class="px-4 py-2 rounded-lg hover:bg-white/20">← Kembali ke Daftar</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-5 py-8">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        <!-- Detail Aspirasi -->
        <div class="bg-white rounded-xl p-8 shadow-md mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Aspirasi</h2>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">ID Aspirasi</label>
                    <p class="text-gray-800">#{{ $aspirasi->id_aspirasi }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Lapor</label>
                    <p class="text-gray-800">{{ $aspirasi->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Siswa</label>
                    <p class="text-gray-800">{{ $aspirasi->siswa->nama }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Kelas</label>
                    <p class="text-gray-800">{{ $aspirasi->siswa->kelas }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">NIS</label>
                    <p class="text-gray-800">{{ $aspirasi->siswa->nis }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Kategori</label>
                    <p class="text-gray-800">{{ $aspirasi->kategori->ket_kategori }}</p>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Lokasi</label>
                    <p class="text-gray-800">{{ $aspirasi->inputAspirasi->lokasi }}</p>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Keterangan Masalah</label>
                    <p class="text-gray-800">{{ $aspirasi->inputAspirasi->ket }}</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Status Saat Ini</label>
                    @if($aspirasi->status == 'Menunggu')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">Menunggu</span>
                    @elseif($aspirasi->status == 'Proses')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">Dalam Proses</span>
                    @else
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">Selesai</span>
                    @endif
                </div>
                @if($aspirasi->feedback)
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Feedback Rating</label>
                    <p class="text-gray-800">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $aspirasi->feedback)
                                <span class="text-yellow-400">⭐</span>
                            @else
                                <span class="text-gray-300">⭐</span>
                            @endif
                        @endfor
                        ({{ $aspirasi->feedback }}/5)
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white rounded-xl p-8 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Update Status Aspirasi</h2>
            
            <form action="{{ route('admin.aspirasi.updateStatus', $aspirasi->id_aspirasi) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Ubah Status</label>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-[#667eea] transition-colors">
                            <input type="radio" name="status" value="Menunggu" {{ $aspirasi->status == 'Menunggu' ? 'checked' : '' }} class="mr-3">
                            <div>
                                <div class="font-semibold text-gray-800">Menunggu</div>
                                <div class="text-sm text-gray-600">Aspirasi belum ditangani</div>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-[#667eea] transition-colors">
                            <input type="radio" name="status" value="Proses" {{ $aspirasi->status == 'Proses' ? 'checked' : '' }} class="mr-3">
                            <div>
                                <div class="font-semibold text-gray-800">Dalam Proses</div>
                                <div class="text-sm text-gray-600">Aspirasi sedang dikerjakan</div>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-[#667eea] transition-colors">
                            <input type="radio" name="status" value="Selesai" {{ $aspirasi->status == 'Selesai' ? 'checked' : '' }} class="mr-3">
                            <div>
                                <div class="font-semibold text-gray-800">Selesai</div>
                                <div class="text-sm text-gray-600">Aspirasi telah selesai ditangani</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-[#667eea] text-white rounded-lg font-semibold hover:bg-[#5568d3] transition-colors">
                        💾 Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.aspirasi.list') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>