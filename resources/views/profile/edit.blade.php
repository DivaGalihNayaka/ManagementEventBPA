<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - BPA Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #F3F3F3; font-family: sans-serif; }
        .border-theme { border-color: #D9A0A0; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        input[type="file"]::file-selector-button { display: none; }
    </style>
</head>
<body class="flex flex-col md:flex-row md:h-screen md:overflow-hidden text-gray-800">

    <aside class="w-full md:w-64 bg-[#F3F3F3] border-b-2 md:border-b-0 md:border-r-2 border-theme flex flex-col justify-between shrink-0">
        <div>
            <div class="p-4 md:p-6 pt-6 md:pt-8 pb-3 md:pb-10 flex md:flex-col justify-between items-center md:items-start">
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-[#A72B2A]">BPA Telkom</h1>
                    <p class="text-xs md:text-sm text-gray-500 font-semibold mt-0 md:mt-1">Event System</p>
                </div>
            </div>

            <nav class="flex flex-row md:flex-col gap-1 md:gap-2 px-4 md:px-0 overflow-x-auto no-scrollbar pb-3 md:pb-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 md:gap-4 px-4 md:px-6 py-2 md:py-3 text-gray-600 hover:bg-gray-200 font-semibold transition whitespace-nowrap text-sm md:text-base">
                    <i class="fa-solid fa-house text-base md:text-lg w-5 md:w-6"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('events.index') }}" class="flex items-center gap-2 md:gap-4 px-4 md:px-6 py-2 md:py-3 text-gray-600 hover:bg-gray-200 font-semibold transition whitespace-nowrap text-sm md:text-base">
                    <i class="fa-regular fa-calendar-check text-base md:text-lg w-5 md:w-6"></i>
                    <span>Event</span>
                </a>
                <a href="#" class="flex items-center gap-2 md:gap-4 px-4 md:px-6 py-2 md:py-3 text-gray-600 hover:bg-gray-200 font-semibold transition whitespace-nowrap text-sm md:text-base">
                    <i class="fa-regular fa-calendar text-base md:text-lg w-5 md:w-6"></i>
                    <span>Calender</span>
                </a>
            </nav>
        </div>

        <div class="p-4 md:p-6 flex flex-row md:flex-col gap-3 md:gap-4 border-t border-gray-200 md:border-t-0 items-center">
            <a href="{{ route('events.create') }}" class="w-1/2 md:w-full bg-[#A72B2A] hover:bg-[#8b2322] text-white font-bold py-2 md:py-3 text-center rounded-md flex justify-center items-center gap-2 transition text-sm md:text-base">
                <i class="fa-solid fa-plus text-xs md:text-sm"></i> Buat Event
            </a>
            <a href="{{ route('keluar') }}" class="w-1/2 md:w-full flex items-center justify-center md:justify-start gap-2 md:gap-4 px-2 py-2 text-gray-700 font-semibold hover:text-[#A72B2A] transition text-center md:text-left cursor-pointer text-sm md:text-base">
                <i class="fa-solid fa-arrow-right-from-bracket text-base md:text-lg"></i>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0">
        <header class="h-16 md:h-20 border-b-2 border-theme flex items-center justify-center relative bg-[#F3F3F3] z-50 shrink-0">
            <h2 class="text-xl md:text-2xl font-bold text-[#A72B2A] tracking-wider">BPA AKSES</h2>
            <a href="{{ route('profile.edit') }}" class="absolute right-4 md:right-8 w-8 h-8 md:w-10 md:h-10 bg-[#8b2322] hover:bg-[#A72B2A] rounded-full shadow-inner flex items-center justify-center text-white focus:outline-none ring-2 ring-offset-2 ring-red-300 overflow-hidden transition cursor-pointer">
                @if(Auth::check() && Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                @else
                    <i class="fa-solid fa-user text-xs md:text-sm"></i>
                @endif
            </a>
        </header>

        <div class="flex-1 p-4 md:p-8 overflow-y-auto">
            <div class="max-w-5xl mx-auto">
                @if (session('status') === 'profile-updated')
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm text-sm">
                        <span class="block sm:inline font-semibold"><i class="fa-solid fa-check-circle mr-2"></i> Profil berhasil diperbarui!</span>
                    </div>
                @endif

                <div class="mb-6 mt-2 md:mt-0">
                    <h3 class="text-xl md:text-2xl font-extrabold text-black tracking-wide">Profile Settings</h3>
                    <p class="text-xs md:text-sm font-bold text-gray-500 mt-1">Kelola informasi pribadi dan identitas kampus Anda.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="col-span-1 border border-theme bg-[#F3F3F3] flex flex-col items-center justify-center py-8 md:py-12 px-6">
                        <p class="text-xs font-bold text-gray-600 mb-6">Selamat Datang</p>
                        <div class="relative w-28 h-28 md:w-32 md:h-32 bg-[#D4D4D4] border-2 border-[#A72B2A] rounded-xl cursor-pointer mb-6 hover:bg-gray-300 transition">
                            <img id="photo-preview" src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : '' }}" class="absolute inset-0 w-full h-full object-cover rounded-lg z-10 {{ Auth::user()->profile_photo ? '' : 'hidden' }}">
                            <input type="file" id="photo-input" name="profile_photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30" form="profile-form">
                            <div class="absolute bottom-1 right-2 z-20 bg-[#D4D4D4]/50 rounded px-1">
                                <i class="fa-solid fa-camera text-lg md:text-xl text-black"></i>
                            </div>
                        </div>
                        <h4 class="text-xl md:text-2xl font-bold text-black text-center">{{ Auth::user()->name ?? 'Full Name' }}</h4>
                    </div>

                    <div class="col-span-1 lg:col-span-2 border border-theme bg-[#F3F3F3] p-5 md:p-8">
                        <form id="profile-form" action="{{ route('profile.update') }}" method="POST" class="h-full flex flex-col" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 md:gap-y-6 flex-1">
                                <div><label class="block text-xs md:text-sm font-bold text-gray-600 mb-1.5 md:mb-2">Full Name</label><input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" required class="w-full bg-[#F3F3F3] border border-theme px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]"></div>
                                <div><label class="block text-xs md:text-sm font-bold text-gray-600 mb-1.5 md:mb-2">Email Address</label><input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" required class="w-full bg-[#F3F3F3] border border-theme px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]"></div>
                                <div><label class="block text-xs md:text-sm font-bold text-gray-600 mb-1.5 md:mb-2">Nomor Telepon</label><input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}" class="w-full bg-[#F3F3F3] border border-theme px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]"></div>
                                <div><label class="block text-xs md:text-sm font-bold text-gray-600 mb-1.5 md:mb-2">Departement</label><input type="text" name="department" value="{{ Auth::user()->department ?? '' }}" class="w-full bg-[#F3F3F3] border border-theme px-3 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]"></div>
                            </div>
                            <div class="flex justify-end items-center gap-6 md:gap-8 mt-8 md:mt-10">
                                <a href="{{ route('dashboard') }}" class="text-[#A72B2A] font-bold text-sm hover:underline">Cancel</a>
                                <button type="submit" class="bg-[#A72B2A] text-white px-5 md:px-6 py-2 md:py-2.5 text-sm font-bold shadow-sm hover:bg-[#8b2322] transition">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('photo-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewElement = document.getElementById('photo-preview');
                    previewElement.src = e.target.result;
                    previewElement.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>