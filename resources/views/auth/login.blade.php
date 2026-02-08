<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengaduan Sarana Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center p-5 bg-gradient-to-br from-[#667eea] to-[#764ba2]">
    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white p-8 text-center">
            <h1 class="text-3xl font-bold mb-2">Sistem Pengaduan Sarana Sekolah</h1>
            <p class="text-sm opacity-90">Platform digital untuk pelaporan dan pengelolaan sarana prasarana sekolah</p>
        </div>

        <div class="grid md:grid-cols-2 gap-0.5 bg-gray-300">
            <!-- Form Login Admin -->
            <div class="bg-white p-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Login Admin</h2>
                <p class="text-gray-600 mb-6 text-sm">Masuk untuk mengelola aspirasi siswa</p>

                @if ($errors->has('username'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                        {{ $errors->first('username') }}
                    </div>
                @endif

                <form action="{{ route('login.admin') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="admin_username" class="block mb-2 text-gray-700 font-medium text-sm">Username</label>
                        <input type="text" id="admin_username" name="username" placeholder="Masukkan username admin" value="{{ old('username') }}" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-sm transition-all duration-300 focus:outline-none focus:border-[#667eea] focus:ring-4 focus:ring-[#667eea]/10">
                    </div>
                    <div class="mb-5">
                        <label for="admin_password" class="block mb-2 text-gray-700 font-medium text-sm">Password</label>
                        <input type="password" id="admin_password" name="password" placeholder="Masukkan password" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-sm transition-all duration-300 focus:outline-none focus:border-[#667eea] focus:ring-4 focus:ring-[#667eea]/10">
                    </div>
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#667eea] to-[#764ba2] text-white rounded-lg font-semibold text-base transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#667eea]/30">
                        Masuk sebagai Admin
                    </button>
                </form>
            </div>

            <!-- Form Login Siswa -->
            <div class="bg-white p-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Login Siswa</h2>
                <p class="text-gray-600 mb-6 text-sm">Masuk untuk mengajukan aspirasi</p>

                @if ($errors->has('nis'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                        {{ $errors->first('nis') }}
                    </div>
                @endif

                <form action="{{ route('login.siswa') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="siswa_nis" class="block mb-2 text-gray-700 font-medium text-sm">NIS (Nomor Induk Siswa)</label>
                        <input type="text" id="siswa_nis" name="nis" placeholder="Masukkan NIS Anda" value="{{ old('nis') }}" required maxlength="10" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-sm transition-all duration-300 focus:outline-none focus:border-[#f5576c] focus:ring-4 focus:ring-[#f5576c]/10">
                    </div>
                    <div class="mb-5">
                        <label for="siswa_password" class="block mb-2 text-gray-700 font-medium text-sm">Password</label>
                        <input type="password" id="siswa_password" name="password" placeholder="Masukkan password" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-sm transition-all duration-300 focus:outline-none focus:border-[#f5576c] focus:ring-4 focus:ring-[#f5576c]/10">
                    </div>
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#f093fb] to-[#f5576c] text-white rounded-lg font-semibold text-base transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f5576c]/30">
                        Masuk sebagai Siswa
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>