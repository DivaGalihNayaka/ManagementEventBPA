<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BPA Telkom University</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            background-color: #EBEBEB; /* Warna background luar */
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen font-sans p-4">

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-[#A72B2A] tracking-wide">BPA Telkom University</h1>
        <p class="text-sm font-semibold text-[#555555] mt-1 tracking-wider uppercase">Event Management System</p>
    </div>

    <div class="bg-white p-10 rounded-none shadow-sm w-full max-w-md">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-sm font-bold text-[#555555] uppercase tracking-wide mb-2">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-[#EAEAEA] border border-[#C5C5C5] px-3 py-3 text-gray-800 focus:outline-none focus:border-[#A72B2A]">
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-bold text-[#555555] uppercase tracking-wide mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full bg-[#EAEAEA] border border-[#C5C5C5] px-3 py-3 text-gray-800 focus:outline-none focus:border-[#A72B2A]">
                @error('password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-10">
                <div class="flex items-center">
                    <input id="show_password" type="checkbox" onclick="togglePassword()"
                        class="w-4 h-4 text-[#A72B2A] border-gray-300 rounded focus:ring-[#A72B2A]">
                    <label for="show_password" class="ml-2 text-sm text-[#555555]">Tampilkan</label>
                </div>
                <div>
                    <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#C23331] hover:underline">
                        Lupa Password?
                    </a>
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-[#C23331] hover:bg-[#A72B2A] text-white font-medium py-3 text-lg transition duration-200">
                Masuk
            </button>
        </form>
    </div>

    <div class="mt-8 text-sm text-black">
        Belum punya akun? <a href="{{ route('register') }}" class="text-[#C23331] font-medium hover:underline">Daftar sekarang</a>
    </div>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>
</html>