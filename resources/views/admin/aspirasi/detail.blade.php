<?php
// Lokasi file: resources/views/admin/aspirasi/detail.blade.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    {{-- Navigation Bar --}}
    <nav class="bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📄 Detail Aspirasi</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ route('admin.aspirasi.list') }}" class="px-4 py-2 rounded-lg bg-white/20 hover:bg-white/30 transition-colors">
                    ← Kembali ke Daftar
                </a>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg hover:bg-white/20 transition-colors">
                    Dashboard
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg border border-white bg-white/20 hover:bg-white/30 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-5 py-8">

        {{-- Success / Error Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-lg mb-6">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-lg mb-6">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- ===================================== --}}
        {{-- CARD 1: Informasi Lengkap Aspirasi --}}
        {{-- ===================================== --}}
        <div class="bg-white rounded-xl p-8 shadow-md mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">📋 Informasi Aspirasi</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID Aspirasi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">ID Aspirasi</label>
                    <p class="text-lg text-gray-800 font-mono">#{{ $aspirasi->id_aspirasi }}</p>
                </div>

                {{-- Tanggal Lapor --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">Tanggal Lapor</label>
                    <p class="text-lg text-gray-800">{{ $aspirasi->created_at->format('d F Y, H:i') }} WIB</p>
                </div>

                {{-- Nama Siswa --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Siswa</label>
                    <p class="text-lg text-gray-800">{{ $aspirasi->siswa->nama }}</p>
                </div>

                {{-- Kelas --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">Kelas</label>
                    <p class="text-lg text-gray-800">{{ $aspirasi->siswa->kelas }}</p>
                </div>

                {{-- NIS --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">NIS</label>
                    <p class="text-lg text-gray-800 font-mono">{{ $aspirasi->siswa->nis }}</p>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">Kategori Sarana</label>
                    <span class="inline-block px-4 py-1.5 rounded-lg bg-blue-100 text-blue-800 font-semibold text-base">
                        {{ $aspirasi->kategori->ket_kategori }}
                    </span>
                </div>

                {{-- Lokasi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">Lokasi Spesifik</label>
                    <p class="text-lg text-gray-800">📍 {{ $aspirasi->inputAspirasi->lokasi }}</p>
                </div>

                {{-- Keterangan Masalah --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">Keterangan Masalah</label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-800 leading-relaxed">{{ $aspirasi->inputAspirasi->ket }}</p>
                    </div>
                </div>

                {{-- Status Saat Ini --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Status Saat Ini</label>
                    @if($aspirasi->status == 'Menunggu')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                            ⏳ Menunggu
                        </span>
                    @elseif($aspirasi->status == 'Proses')
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                            🔧 Dalam Proses
                        </span>
                    @else
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            ✅ Selesai
                        </span>
                    @endif
                </div>

                {{-- Durasi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-1">Durasi</label>
                    <p class="text-gray-800">
                        @if($aspirasi->status == 'Selesai')
                            Selesai dalam {{ $aspirasi->created_at->diffForHumans($aspirasi->updated_at, true) }}
                        @else
                            Sudah {{ $aspirasi->created_at->diffForHumans() }}
                        @endif
                    </p>
                </div>

                {{-- Rating dari Siswa (jika ada) --}}
                @if($aspirasi->feedback)
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Rating dari Siswa</label>
                    <div class="flex items-center gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $aspirasi->feedback)
                                <span class="text-2xl text-yellow-400">⭐</span>
                            @else
                                <span class="text-2xl text-gray-300">⭐</span>
                            @endif
                        @endfor
                        <span class="text-gray-600 ml-2">({{ $aspirasi->feedback }}/5)</span>
                    </div>
                </div>
                @endif

            </div>
        </div>

        {{-- ===================================== --}}
        {{-- CARD 2: Update Status --}}
        {{-- ===================================== --}}
        <div class="bg-white rounded-xl p-8 shadow-md mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">🔄 Update Status Aspirasi</h2>

            <form action="{{ route('admin.aspirasi.updateStatus', $aspirasi->id_aspirasi) }}" method="POST">
                @csrf

                <div class="space-y-3 mb-6">

                    {{-- Menunggu --}}
                    <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-all
                        {{ $aspirasi->status == 'Menunggu' ? 'border-yellow-400 bg-yellow-50' : 'border-gray-200 hover:border-yellow-300' }}">
                        <input type="radio" name="status" value="Menunggu"
                            {{ $aspirasi->status == 'Menunggu' ? 'checked' : '' }}
                            class="mt-1 mr-4 accent-yellow-400">
                        <div>
                            <div class="font-semibold text-gray-800">⏳ Menunggu</div>
                            <div class="text-sm text-gray-500 mt-0.5">Aspirasi belum ditangani, masih dalam antrian</div>
                        </div>
                    </label>

                    {{-- Proses --}}
                    <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-all
                        {{ $aspirasi->status == 'Proses' ? 'border-blue-400 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}">
                        <input type="radio" name="status" value="Proses"
                            {{ $aspirasi->status == 'Proses' ? 'checked' : '' }}
                            class="mt-1 mr-4 accent-blue-500">
                        <div>
                            <div class="font-semibold text-gray-800">🔧 Dalam Proses</div>
                            <div class="text-sm text-gray-500 mt-0.5">Aspirasi sedang ditangani oleh tim maintenance</div>
                        </div>
                    </label>

                    {{-- Selesai --}}
                    <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-all
                        {{ $aspirasi->status == 'Selesai' ? 'border-green-400 bg-green-50' : 'border-gray-200 hover:border-green-300' }}">
                        <input type="radio" name="status" value="Selesai"
                            {{ $aspirasi->status == 'Selesai' ? 'checked' : '' }}
                            class="mt-1 mr-4 accent-green-500">
                        <div>
                            <div class="font-semibold text-gray-800">✅ Selesai</div>
                            <div class="text-sm text-gray-500 mt-0.5">Masalah telah selesai diperbaiki</div>
                        </div>
                    </label>

                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white rounded-lg font-semibold shadow-lg hover:-translate-y-0.5 hover:shadow-xl transition-all">
                        💾 Simpan Perubahan Status
                    </button>
                    <a href="{{ route('admin.aspirasi.list') }}"
                        class="px-8 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- ===================================== --}}
        {{-- CARD 3: Form Umpan Balik dari Admin --}}
        {{-- ===================================== --}}
        @if($aspirasi->status == 'Selesai')
            <div class="bg-white rounded-xl p-8 shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-2">💬 Umpan Balik untuk Siswa</h2>
                <p class="text-gray-600 mb-6">Berikan keterangan kepada siswa tentang penanganan yang telah dilakukan</p>

                {{-- Tampilkan feedback yang sudah ada --}}
                @if($aspirasi->admin_feedback)
                    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-4 mb-6">
                        <p class="text-xs font-semibold text-blue-700 uppercase tracking-wide mb-2">Umpan Balik Saat Ini:</p>
                        <p class="text-gray-800">{{ $aspirasi->admin_feedback }}</p>
                    </div>
                @endif

                <form action="{{ route('admin.aspirasi.submitFeedback', $aspirasi->id_aspirasi) }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $aspirasi->admin_feedback ? 'Ubah Umpan Balik' : 'Tulis Umpan Balik' }}
                        </label>
                        <textarea
                            name="admin_feedback"
                            rows="5"
                            required
                            placeholder="Contoh: Masalah AC sudah diperbaiki. Teknisi telah mengganti kompresor yang rusak pada tanggal 15 Januari 2025. AC sudah berfungsi normal kembali."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg resize-y focus:outline-none focus:border-[#667eea] focus:ring-4 focus:ring-[#667eea]/10">{{ old('admin_feedback', $aspirasi->admin_feedback) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Minimal 10 karakter. Jelaskan apa yang sudah dilakukan.</p>
                        @error('admin_feedback')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white rounded-lg font-semibold shadow-lg hover:-translate-y-0.5 hover:shadow-xl transition-all">
                        💾 {{ $aspirasi->admin_feedback ? 'Update Umpan Balik' : 'Kirim Umpan Balik' }}
                    </button>
                </form>
            </div>

        @else
            {{-- Info jika status belum Selesai --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5">
                <p class="text-yellow-800">
                    ℹ️ Form umpan balik akan muncul setelah status aspirasi diubah menjadi <strong>Selesai</strong>.
                </p>
            </div>
        @endif

    </div>
</body>
</html>