<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Aspirasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    /* Fix dropdown z-index issue */
    select {
        appearance: auto !important;
        -webkit-appearance: auto !important;
        -moz-appearance: auto !important;
    }
    
    /* Ensure dropdown can expand properly */
    select option {
        padding: 10px;
    }
</style>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white shadow-lg">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">📝 Ajukan Aspirasi</h1>
            <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 rounded-lg bg-white/20 hover:bg-white/30">← Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-5 py-10">
        <div class="bg-white rounded-xl p-10 shadow-lg">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">📢 Form Pengaduan Sarana Sekolah</h2>
                <p class="text-gray-600">Laporkan masalah atau kerusakan sarana sekolah yang Anda temukan</p>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
                <h3 class="text-blue-800 font-semibold mb-2">💡 Petunjuk Pengisian</h3>
                <p class="text-gray-700 text-sm">Mohon isi form ini dengan jelas dan detail. Semakin detail informasi yang Anda berikan, semakin cepat kami dapat memperbaikinya.</p>
            </div>

            <form action="{{ route('siswa.aspirasi.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="id_kategori" class="block mb-2 text-gray-700 font-semibold text-sm">
                        Kategori Sarana <span class="text-red-600">*</span>
                    </label>
                    <select name="id_kategori" id="id_kategori" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#f5576c] focus:ring-4 focus:ring-[#f5576c]/10">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <span class="block mt-1 text-xs text-gray-500">Pilih kategori yang sesuai dengan sarana yang bermasalah</span>
                    @error('id_kategori')
                        <span class="block mt-1 text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="lokasi" class="block mb-2 text-gray-700 font-semibold text-sm">
                        Lokasi Spesifik <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="lokasi" id="lokasi" placeholder="Contoh: Lab Komputer Lantai 2" value="{{ old('lokasi') }}" maxlength="50" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#f5576c] focus:ring-4 focus:ring-[#f5576c]/10">
                    <span class="block mt-1 text-xs text-gray-500">Sebutkan lokasi yang spesifik (maksimal 50 karakter)</span>
                    @error('lokasi')
                        <span class="block mt-1 text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="ket" class="block mb-2 text-gray-700 font-semibold text-sm">
                        Keterangan Masalah <span class="text-red-600">*</span>
                    </label>
                    <textarea name="ket" id="ket" placeholder="Jelaskan masalah yang Anda temukan secara detail" maxlength="50" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg resize-y min-h-[100px] focus:outline-none focus:border-[#f5576c] focus:ring-4 focus:ring-[#f5576c]/10">{{ old('ket') }}</textarea>
                    <span class="block mt-1 text-xs text-gray-500">Jelaskan masalah dengan jelas (maksimal 50 karakter)</span>
                    @error('ket')
                        <span class="block mt-1 text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-center gap-4 mt-8">
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white rounded-lg font-semibold shadow-lg hover:-translate-y-1 transition-all">
                        ✓ Submit Aspirasi
                    </button>
                    <a href="{{ route('siswa.dashboard') }}" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        ✕ Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>