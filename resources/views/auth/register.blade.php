<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BPA Telkom University</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            background-color: #EBEBEB; /* Warna abu-abu background luar */
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen font-sans p-4">

    <!-- Header Atas -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-[#A72B2A] tracking-wide">BPA Telkom University</h1>
        <p class="text-sm font-semibold text-[#555555] mt-1 tracking-wider uppercase">Event Management System</p>
    </div>

    <!-- Kotak Form Putih -->
    <div class="bg-white p-10 rounded-none shadow-sm w-full max-w-md">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Input Full Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-bold text-[#555555] uppercase tracking-wide mb-2">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full bg-[#EAEAEA] border border-[#C5C5C5] px-3 py-3 text-gray-800 focus:outline-none focus:border-[#A72B2A]">
                @error('name')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input Email Address -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-bold text-[#555555] uppercase tracking-wide mb-2">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-[#EAEAEA] border border-[#C5C5C5] px-3 py-3 text-gray-800 focus:outline-none focus:border-[#A72B2A]">
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-bold text-[#555555] uppercase tracking-wide mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full bg-[#EAEAEA] border border-[#C5C5C5] px-3 py-3 text-gray-800 focus:outline-none focus:border-[#A72B2A]">
                @error('password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Checkbox Persyaratan -->
            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="terms" name="terms" type="checkbox" required
                        class="w-4 h-4 text-[#A72B2A] border-gray-300 rounded focus:ring-[#A72B2A]">
                </div>
                <div class="ml-3 text-xs leading-relaxed text-[#555555]">
                    Saya menyetujui <a href="#" class="text-[#A72B2A] hover:underline font-medium">Persyaratan Layanan</a> dan <a href="#" class="text-[#A72B2A] hover:underline font-medium">Kebijakan Privasi</a> BPA Telkom University
                </div>
            </div>

            <!-- Tombol Buat Akun -->
            <button type="submit" 
                class="w-full bg-[#C23331] hover:bg-[#A72B2A] text-white font-medium py-3 text-base transition duration-200">
                Buat Akun
            </button>
        </form>
    </div>

    <!-- Footer Bawah -->
    <div class="mt-6 text-sm text-black">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-[#C23331] font-medium hover:underline">Login</a>
    </div>

</body>
</html>