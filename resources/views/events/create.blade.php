<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Event - BPA Telkom</title>
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
            <a href="{{ route('events.create') }}" class="w-1/2 md:w-full bg-[#8b2322] hover:bg-[#A72B2A] text-white font-bold py-2 md:py-3 text-center rounded-md flex justify-center items-center gap-2 transition text-sm md:text-base shadow-inner">
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
            <div class="max-w-4xl mx-auto border border-theme bg-[#F3F3F3] p-5 md:p-8 rounded-sm shadow-sm">
                <div class="mb-6">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-700">Informasi Event</h3>
                    <p class="text-xs md:text-sm text-gray-500 font-medium mt-1">Detail tentang acara yang akan dibuat</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc pl-5 text-sm font-semibold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Judul Event</label>
                        <input type="text" name="title" placeholder="Contoh : Market Day" required value="{{ old('title') }}" class="w-full bg-[#F3F3F3] border border-theme px-3 md:px-4 py-2 md:py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Tanggal Mulai</label>
                            <input type="date" name="start_date" required value="{{ old('start_date') }}" class="w-full bg-[#F3F3F3] border border-theme px-3 md:px-4 py-2 md:py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]">
                        </div>
                        <div>
                            <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Tanggal Selesai</label>
                            <input type="date" name="end_date" required value="{{ old('end_date') }}" class="w-full bg-[#F3F3F3] border border-theme px-3 md:px-4 py-2 md:py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Jam Mulai</label>
                            <input type="time" name="start_time" required value="{{ old('start_time') }}" class="w-full bg-[#F3F3F3] border border-theme px-3 md:px-4 py-2 md:py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]">
                        </div>
                        <div>
                            <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Jam Selesai</label>
                            <input type="time" name="end_time" required value="{{ old('end_time') }}" class="w-full bg-[#F3F3F3] border border-theme px-3 md:px-4 py-2 md:py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Deskripsi</label>
                        <textarea name="description" rows="3" placeholder="Ceritakan tentang event yang ingin dibuat!!" required class="w-full bg-[#F3F3F3] border border-theme px-3 md:px-4 py-2 md:py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A] resize-none">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Cover Image</label>
                        <div class="relative w-full h-40 md:h-48 border border-theme bg-[#F3F3F3] hover:bg-gray-200 transition cursor-pointer flex flex-col items-center justify-center overflow-hidden">
                            <img id="event-preview" src="" class="absolute inset-0 w-full h-full object-cover z-10 hidden">
                            <input type="file" id="event-image-input" name="image" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                            <div id="default-icon" class="text-center z-0">
                                <i class="fa-solid fa-camera-retro text-3xl md:text-4xl text-gray-800 mb-2"></i>
                                <span class="block text-xs md:text-sm text-gray-500 font-medium mt-2">Click untuk mengambil foto</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">Lokasi</label>
                        <input type="text" name="location" placeholder="Contoh : GKU lt.2" required value="{{ old('location') }}" class="w-full bg-[#F3F3F3] border border-theme px-3 md:px-4 py-2 md:py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#A72B2A]">
                    </div>

                    <div class="flex justify-end items-center gap-6 pt-6">
                        <a href="{{ route('dashboard') }}" class="text-[#A72B2A] font-bold text-sm hover:underline">Cancel</a>
                        <button type="submit" class="bg-[#A72B2A] text-white px-6 md:px-8 py-2.5 text-sm font-bold shadow-sm hover:bg-[#8b2322] transition">Publish Event</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('event-image-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('event-preview');
                    const icon = document.getElementById('default-icon');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    icon.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>