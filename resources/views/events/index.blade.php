<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Kampus - BPA Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #F3F3F3; font-family: sans-serif; }
        .border-theme { border-color: #D9A0A0; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
</head>
<body class="flex flex-col md:flex-row md:h-screen md:overflow-hidden text-gray-800">

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#F3F3F3] border-r-2 border-theme flex flex-col justify-between transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out shrink-0 h-full">
        <div>
            <button class="lg:hidden absolute top-5 right-5 text-gray-500 hover:text-[#A72B2A]" onclick="toggleSidebar()">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>

            <div class="p-6 pt-8 pb-10 flex flex-col items-start">
                <h1 class="text-2xl font-bold text-[#A72B2A]">BPA Telkom</h1>
                <p class="text-sm text-gray-500 font-semibold mt-1">Event System</p>
            </div>

            <nav class="flex flex-col gap-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-gray-200 font-semibold transition text-base">
                    <i class="fa-solid fa-house text-lg w-6 text-center"></i>
                    <span>Home</span>
                </a>
                
                <a href="{{ route('events.index') }}" class="flex items-center gap-4 px-6 py-3 bg-[#F5D7D7] border-l-4 border-[#A72B2A] text-[#A72B2A] font-bold text-base transition">
                    <i class="fa-regular fa-calendar-check text-lg w-6 text-center"></i>
                    <span>Event</span>
                </a>
                
                <a href="{{ route('events.calendar') }}" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-gray-200 font-semibold transition text-base">
                    <i class="fa-regular fa-calendar text-lg w-6 text-center"></i>
                    <span>Calendar</span>
                </a>
            </nav>
        </div>

        <div class="p-6 flex flex-col gap-4 border-t border-gray-200 items-center">
            <a href="{{ route('events.create') }}" class="w-full bg-[#A72B2A] hover:bg-[#8b2322] text-white font-bold py-3 text-center rounded-md flex justify-center items-center gap-2 transition text-base shadow-sm">
                <i class="fa-solid fa-plus text-sm"></i> Buat Event
            </a>
            <a href="{{ route('keluar') }}" class="w-full flex items-center justify-start gap-4 px-2 py-2 text-gray-700 font-semibold hover:text-[#A72B2A] transition cursor-pointer text-base">
                <i class="fa-solid fa-arrow-right-from-bracket text-lg w-6 text-center"></i>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden relative">
        <header class="h-16 md:h-20 border-b-2 border-theme flex items-center justify-center relative bg-[#F3F3F3] z-30 shrink-0">
            <button class="lg:hidden absolute left-4 md:left-6 text-[#A72B2A] p-2 focus:outline-none" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars text-xl md:text-2xl"></i>
            </button>
            <h2 class="text-xl md:text-2xl font-bold text-[#A72B2A] tracking-wider">BPA AKSES</h2>
            <a href="{{ route('profile.edit') }}" class="absolute right-4 md:right-8 w-8 h-8 md:w-10 md:h-10 bg-[#8b2322] hover:bg-[#A72B2A] rounded-full shadow-inner flex items-center justify-center text-white focus:outline-none ring-2 ring-offset-2 ring-red-300 overflow-hidden transition cursor-pointer">
                @if(Auth::check() && Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                @else
                    <i class="fa-solid fa-user text-xs md:text-sm"></i>
                @endif
            </a>
        </header>

        <div class="flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto w-full">
            <div class="max-w-6xl mx-auto">
                
                <div class="mb-6">
                    <h3 class="text-2xl md:text-3xl font-extrabold text-black tracking-wide">Event Kampus</h3>
                    <p class="text-xs md:text-sm text-gray-500 font-bold mt-1">Kegiatan yang ada di Telkom University</p>
                </div>

                @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                <div class="relative w-full h-44 sm:h-60 md:h-72 border border-theme rounded-2xl overflow-hidden mb-8 group bg-white shadow-sm">
                    <div id="ev-carousel-inner" class="flex w-full h-full transition-transform duration-500 ease-in-out">
                        
                        @foreach($upcomingEvents as $index => $upEvent)
                            <div class="w-full h-full shrink-0 relative flex items-center text-white overflow-hidden">
                                <img src="{{ $upEvent->image ? asset('storage/' . $upEvent->image) : 'https://placehold.co/1000x500/e2e8f0/475569?text=No+Image' }}" class="absolute inset-0 w-full h-full object-cover brightness-40" alt="{{ $upEvent->title }}">
                                
                                <div class="relative z-10 px-8 md:px-16 w-full max-w-2xl">
                                    <span class="bg-[#A72B2A] text-[10px] md:text-xs font-bold uppercase px-2.5 py-1 rounded tracking-widest shadow-sm">Segera Hadir</span>
                                    <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold mt-2.5 mb-1.5 leading-tight line-clamp-2 drop-shadow-md">{{ $upEvent->title }}</h3>
                                    
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs md:text-sm opacity-90 font-semibold drop-shadow-sm">
                                        <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-[#F5D7D7]"></i> {{ \Carbon\Carbon::parse($upEvent->start_date)->translatedFormat('d F Y') }}</span>
                                        <span class="flex items-center gap-1"><i class="fa-regular fa-clock text-[#F5D7D7]"></i> {{ $upEvent->start_time ? \Carbon\Carbon::parse($upEvent->start_time)->format('H:i') : '00:00' }} WIB</span>
                                        <span class="flex items-center gap-1"><i class="fa-solid fa-location-dot text-[#F5D7D7]"></i> {{ $upEvent->location }}</span>
                                    </div>
                                    
                                    <a href="{{ route('events.show', $upEvent->id) }}" class="inline-block mt-4 bg-white text-[#A72B2A] hover:bg-gray-100 px-4 py-2 rounded text-xs md:text-sm font-extrabold transition shadow-sm">Lihat Detail ></a>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    @if($upcomingEvents->count() > 1)
                        <button onclick="moveEvSlide(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/30 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 hover:bg-[#A72B2A] transition duration-300 cursor-pointer">
                            <i class="fa-solid fa-chevron-left text-xs sm:text-sm"></i>
                        </button>
                        <button onclick="moveEvSlide(1)" class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/30 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 hover:bg-[#A72B2A] transition duration-300 cursor-pointer">
                            <i class="fa-solid fa-chevron-right text-xs sm:text-sm"></i>
                        </button>

                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-20">
                            @foreach($upcomingEvents as $index => $upEvent)
                                <button onclick="currentEvSlide({{ $index }})" class="ev-carousel-dot w-2 h-2 rounded-full bg-white/50 transition-all duration-300"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
                @endif
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($events as $event)
                        <div class="border border-theme bg-white rounded-xl flex flex-col overflow-hidden shadow-sm hover:shadow-md transition">
                            <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://placehold.co/400x200/e2e8f0/475569?text=No+Image' }}" 
                                 alt="{{ $event->title }}" class="w-full h-40 object-cover border-b border-theme">
                            
                            <div class="p-5 flex flex-col flex-1">
                                @php
                                    $dateStr = \Carbon\Carbon::parse($event->start_date)->translatedFormat('F d, Y');
                                    $timeStr = $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') : '00:00 AM';
                                @endphp
                                <p class="text-[10px] md:text-xs text-[#A72B2A] font-extrabold tracking-wide uppercase mb-1.5">
                                    {{ $dateStr }} - {{ $timeStr }}
                                </p>
                                
                                <h4 class="font-extrabold text-black text-sm md:text-base leading-tight mb-3 line-clamp-2">
                                    {{ $event->title }}
                                </h4>
                                
                                <div class="flex items-start gap-2 text-[11px] md:text-xs text-gray-500 font-semibold mt-auto">
                                    <i class="fa-solid fa-location-dot mt-0.5 w-3 text-center text-[#A72B2A]"></i>
                                    <span class="line-clamp-2">{{ $event->location }}</span>
                                </div>
                                
                                <div class="mt-5 text-right border-t border-gray-100 pt-3">
                                    <a href="{{ route('events.show', $event->id) }}" class="text-[11px] md:text-xs text-[#A72B2A] font-extrabold block w-full text-center bg-[#F5D7D7] py-2 rounded-lg transition hover:bg-[#A72B2A] hover:text-white">
                                        Details >
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-16 text-gray-400 bg-white rounded-xl border border-gray-200 shadow-sm">
                            <i class="fa-regular fa-folder-open text-5xl mb-4 text-gray-300"></i>
                            <p class="text-base font-semibold">Belum ada Event Kampus saat ini.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }

        // LOGIKA SCRIPT CAROUSEL EVENT
        let evSlideIndex = 0;
        const evSlides = document.querySelectorAll('#ev-carousel-inner > div');
        const evDots = document.querySelectorAll('.ev-carousel-dot');
        let evSlideInterval;

        function showEvSlide(index) {
            if (evSlides.length === 0) return;
            if (index >= evSlides.length) evSlideIndex = 0;
            else if (index < 0) evSlideIndex = evSlides.length - 1;
            else evSlideIndex = index;
            
            document.getElementById('ev-carousel-inner').style.transform = `translateX(-${evSlideIndex * 100}%)`;
            
            evDots.forEach((dot, idx) => {
                if (idx === evSlideIndex) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white', 'w-4');
                } else {
                    dot.classList.remove('bg-white', 'w-4');
                    dot.classList.add('bg-white/50');
                }
            });
        }

        function moveEvSlide(step) {
            clearInterval(evSlideInterval);
            showEvSlide(evSlideIndex + step);
            if(evSlides.length > 1) {
                evSlideInterval = setInterval(() => moveEvSlide(1), 4000);
            }
        }

        function currentEvSlide(index) {
            clearInterval(evSlideInterval);
            showEvSlide(index);
            if(evSlides.length > 1) {
                evSlideInterval = setInterval(() => moveEvSlide(1), 4000);
            }
        }

        // Mulai jalankan auto-slide jika banner slide lebih dari 1 data
        if(evSlides.length > 1) {
            evSlideInterval = setInterval(() => moveEvSlide(1), 4000);
        }   
        showEvSlide(evSlideIndex);
    </script>
</body>
</html>