<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - BPA Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #F3F3F3; font-family: sans-serif; }
        .border-theme { border-color: #D9A0A0; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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
                
                <a href="{{ route('events.index') }}" class="flex items-center gap-2 md:gap-4 px-4 md:px-6 py-2 md:py-3 bg-[#F5D7D7] border-b-2 md:border-b-0 md:border-l-4 border-[#A72B2A] text-[#A72B2A] font-bold whitespace-nowrap text-sm md:text-base">
                    <i class="fa-regular fa-calendar-check text-base md:text-lg w-5 md:w-6"></i>
                    <span>Event</span>
                </a>
                
                <a href="{{ route('events.calendar') }}" class="flex items-center gap-2 md:gap-4 px-4 md:px-6 py-2 md:py-3 text-gray-600 hover:bg-gray-200 font-semibold transition whitespace-nowrap text-sm md:text-base">
                    <i class="fa-regular fa-calendar text-base md:text-lg w-5 md:w-6"></i>
                    <span>Calendar</span>
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
            <div class="max-w-5xl mx-auto border border-theme bg-[#F3F3F3] p-4 md:p-8 rounded-sm shadow-sm">
                
                <div class="mb-4 md:mb-6">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 text-[#A72B2A] font-bold text-sm hover:underline transition">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Event
                    </a>
                </div>

                <div class="w-full h-64 md:h-[400px] border-2 border-[#D9A0A0] rounded-sm overflow-hidden mb-8">
                    <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://placehold.co/1000x500/e2e8f0/475569?text=No+Image' }}" 
                         alt="{{ $event->title }}" class="w-full h-full object-cover">
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-black mb-6">{{ $event->title }}</h1>

                <div class="flex flex-wrap gap-x-8 gap-y-4 mb-8 border-b border-[#D9A0A0] pb-6">
                    <div class="flex items-center gap-2.5 text-gray-700">
                        <div class="w-8 h-8 rounded-full bg-[#F5D7D7] flex items-center justify-center text-[#A72B2A]">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <span class="font-bold text-sm">{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2.5 text-gray-700">
                        <div class="w-8 h-8 rounded-full bg-[#F5D7D7] flex items-center justify-center text-[#A72B2A]">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <span class="font-bold text-sm">
                            {{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') : '-' }} - 
                            {{ $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('h:i A') : '-' }} WIB
                        </span>
                    </div>

                    <div class="flex items-center gap-2.5 text-gray-700">
                        <div class="w-8 h-8 rounded-full bg-[#F5D7D7] flex items-center justify-center text-[#A72B2A]">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span class="font-bold text-sm">{{ $event->location }}</span>
                    </div>

                    <div class="flex items-center gap-2.5 text-gray-700">
                        <div class="w-8 h-8 rounded-full bg-[#F5D7D7] flex items-center justify-center text-[#A72B2A]">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <span class="font-bold text-sm">{{ $event->user->email ?? 'admin@bpa.com' }}</span>
                    </div>
                </div>

                <div class="text-gray-800 text-sm md:text-base leading-relaxed whitespace-pre-line text-justify font-medium">
                    {{ $event->description }}
                </div>

            </div>
        </div>
    </main>
</body>
</html>