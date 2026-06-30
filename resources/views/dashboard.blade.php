<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BPA Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #F3F3F3; font-family: sans-serif; }
        .border-theme { border-color: #D9A0A0; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .berita-scroll::-webkit-scrollbar { width: 6px; }
        .berita-scroll::-webkit-scrollbar-track { background: transparent; }
        .berita-scroll::-webkit-scrollbar-thumb { background: #D9A0A0; border-radius: 10px; }
        .berita-scroll::-webkit-scrollbar-thumb:hover { background: #A72B2A; }
        select { -webkit-appearance: none; -moz-appearance: none; appearance: none; }
        select option { color: #374151; font-size: 14px; background: white; }
    </style>
</head>
<body class="bg-[#F3F3F3] text-gray-800 flex h-screen overflow-hidden">

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
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-6 py-3 bg-[#F5D7D7] border-l-4 border-[#A72B2A] text-[#A72B2A] font-bold text-base transition">
                    <i class="fa-solid fa-house text-lg w-6 text-center"></i>
                    <span>Home</span>
                </a>
                
                <a href="{{ route('events.index') }}" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-gray-200 font-semibold transition text-base">
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
            @if(session('success'))
                <div class="max-w-5xl mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm text-sm md:text-base">
                    <span class="block sm:inline font-semibold"><i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}</span>
                </div>
            @endif

            <div class="relative w-full h-44 sm:h-60 md:h-72 max-w-5xl mx-auto border border-theme rounded-sm overflow-hidden mb-6 group bg-white shadow-xs">
                <div id="carousel-inner" class="flex w-full h-full transition-transform duration-500 ease-in-out">
                    
                    <div class="w-full h-full shrink-0 relative bg-gradient-to-r from-[#8b2322] to-[#A72B2A] flex items-center px-8 md:px-16 text-white">
                        <div class="max-w-xl z-10">
                            <span class="bg-white/20 text-xs font-bold uppercase px-2 py-1 rounded tracking-widest">Informasi Utama</span>
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold mt-2 leading-tight">Selamat Datang di BPA Event System</h3>
                            <p class="text-xs sm:text-sm opacity-80 mt-1 sm:mt-2 font-medium">Kelola, pantau, dan publikasikan seluruh kegiatan acara mahasiswa di lingkungan Telkom University dengan mudah dalam satu platform akses.</p>
                        </div>
                        <i class="fa-solid fa-铺 text-white/5 absolute right-12 text-8xl md:text-9xl pointer-events-none"></i>
                    </div>

                    <div class="w-full h-full shrink-0 relative flex items-center justify-between text-white overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover brightness-40" alt="Banner Event">
                        <div class="max-w-xl z-10 px-8 md:px-16">
                            <span class="bg-[#A72B2A] text-xs font-bold uppercase px-2 py-1 rounded tracking-widest">Agenda Kampus</span>
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold mt-2 leading-tight">Jangan Lewatkan Pameran Market Day 2026</h3>
                            <p class="text-xs sm:text-sm opacity-90 mt-1 sm:mt-2 font-medium">Implementasi Project-Based Learning Mata Kuliah Wajib Kewirausahaan mahasiswa Fakultas Ilmu Terapan. Mari dukung karya bisnis lokal!</p>
                        </div>
                    </div>

                    <div class="w-full h-full shrink-0 relative bg-gradient-to-r from-gray-800 to-slate-900 flex items-center px-8 md:px-16 text-white">
                        <div class="max-w-xl z-10">
                            <span class="bg-blue-600 text-xs font-bold uppercase px-2 py-1 rounded tracking-widest">Tips Manajemen</span>
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold mt-2 leading-tight">Gunakan Fitur Kalender Interaktif</h3>
                            <p class="text-xs sm:text-sm opacity-80 mt-1 sm:mt-2 font-medium">Klik pada tanggal tertentu di kalender untuk melihat daftar detail agenda kegiatan hari itu secara ringkas dan praktis tanpa membuka pop-up.</p>
                        </div>
                        <i class="fa-regular fa-calendar-days text-white/5 absolute right-12 text-8xl md:text-9xl pointer-events-none"></i>
                    </div>

                </div>

                <button onclick="moveSlide(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/30 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 hover:bg-[#A72B2A] transition duration-300 cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-xs sm:text-sm"></i>
                </button>
                <button onclick="moveSlide(1)" class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/30 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 hover:bg-[#A72B2A] transition duration-300 cursor-pointer">
                    <i class="fa-solid fa-chevron-right text-xs sm:text-sm"></i>
                </button>

                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-20">
                    <button onclick="currentSlide(0)" class="carousel-dot w-2 h-2 rounded-full bg-white transition-all duration-300"></button>
                    <button onclick="currentSlide(1)" class="carousel-dot w-2 h-2 rounded-full bg-white/50 transition-all duration-300"></button>
                    <button onclick="currentSlide(2)" class="carousel-dot w-2 h-2 rounded-full bg-white/50 transition-all duration-300"></button>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-5xl mx-auto items-start">
                
                <div class="order-1 lg:col-span-2 border border-theme bg-[#F3F3F3] p-4 md:p-6 lg:p-8 relative rounded-sm flex flex-col w-full">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg md:text-xl font-bold">ACARA</h3>
                        <a href="{{ route('events.create') }}" class="bg-[#A72B2A] text-white px-5 md:px-8 py-1.5 md:py-2 rounded-md text-sm font-semibold shadow-sm hover:bg-[#8b2322] transition">Buat</a>
                    </div>
                    
                    <div class="border border-theme p-3 md:p-6 mt-2 bg-white/50 w-full rounded-lg shadow-sm flex-1">
                        <div class="bg-white p-3 md:p-6 rounded-xl shadow text-center border border-gray-100 h-full flex flex-col justify-center w-full">
                            <div class="flex justify-between items-center mb-4 md:mb-6 font-bold text-gray-700 text-sm md:text-lg">
                                <button onclick="prevMonth()" class="hover:text-[#A72B2A] transition px-2 md:px-4 cursor-pointer"><i class="fa-solid fa-chevron-left"></i></button>
                                
                                <div class="flex items-center gap-1 md:gap-3">
                                    <div class="relative flex items-center group cursor-pointer">
                                        <select id="month-select" onchange="jumpToDate()" class="bg-transparent cursor-pointer hover:text-[#A72B2A] transition text-sm md:text-xl outline-none pr-3 z-10 font-bold"></select>
                                        <i class="fa-solid fa-chevron-down text-[10px] md:text-xs absolute right-0 group-hover:text-[#A72B2A] transition"></i>
                                    </div>
                                    <div class="relative flex items-center group cursor-pointer">
                                        <select id="year-select" onchange="jumpToDate()" class="bg-transparent cursor-pointer hover:text-[#A72B2A] transition text-sm md:text-xl outline-none pr-3 z-10 font-bold"></select>
                                        <i class="fa-solid fa-chevron-down text-[10px] md:text-xs absolute right-0 group-hover:text-[#A72B2A] transition"></i>
                                    </div>
                                </div>

                                <button onclick="nextMonth()" class="hover:text-[#A72B2A] transition px-2 md:px-4 cursor-pointer"><i class="fa-solid fa-chevron-right"></i></button>
                            </div>
                            <div id="calendar-days" class="grid grid-cols-7 gap-y-2 md:gap-y-3 gap-x-1 md:gap-x-2 text-[10px] md:text-base w-full"></div>
                        </div>
                    </div>
                </div>

                <div class="order-2 lg:col-span-1 border border-theme bg-[#F3F3F3] flex flex-col relative rounded-sm w-full">
                    <div class="border-b border-theme p-3 md:p-4 text-center bg-[#F3F3F3]">
                        <h3 class="text-base md:text-lg font-bold">BERITA ACARA</h3>
                    </div>
                    
                    <div class="p-3 md:p-4 flex flex-col gap-4 md:gap-5 overflow-y-scroll bg-[#F3F3F3] berita-scroll h-[350px] md:h-[550px]">
                        @forelse ($events ?? [] as $event)
                            <div class="mb-2 shrink-0">
                                <h4 class="font-bold text-sm md:text-sm text-gray-800">{{ $event->title }}</h4>
                                <p class="text-[10px] md:text-xs text-gray-500 mb-2 font-semibold">
                                    <i class="fa-solid fa-envelope mr-1"></i> {{ $event->user->email ?? 'admin@bpa.com' }}
                                </p>
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://placehold.co/400x200/e2e8f0/475569?text=No+Image' }}" 
                                     alt="{{ $event->title }}" class="w-full h-32 md:h-36 object-cover rounded shadow-sm border border-gray-200">
                            </div>
                        @empty
                            <div class="text-center text-gray-400 text-xs md:text-sm py-8 md:mt-12 flex flex-col items-center">
                                <i class="fa-regular fa-folder-open text-3xl md:text-4xl mb-3"></i>
                                <p class="font-medium">Belum ada berita acara.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="p-3 md:p-4 border-t border-theme bg-[#F3F3F3]">
                        <a href="{{ route('events.index') }}" class="block w-full bg-[#A72B2A] text-center text-white py-2 md:py-2.5 rounded text-sm font-bold hover:bg-[#8b2322] transition shadow-sm">Semua Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="event-modal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-[100] p-4 backdrop-blur-xs transition-all">
        <div class="bg-white rounded-xl max-w-md w-full p-5 md:p-6 shadow-2xl relative border border-theme transform scale-100 transition-transform">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-[#A72B2A] text-xl cursor-pointer transition"><i class="fa-solid fa-xmark"></i></button>
            <h4 id="modal-date" class="text-base md:text-lg font-extrabold text-[#A72B2A] mb-4 flex items-center gap-2"><i class="fa-regular fa-calendar-days"></i> Detail Acara</h4>
            <div id="modal-content" class="space-y-4 max-h-[60vh] overflow-y-auto berita-scroll pr-1"></div>
        </div>
    </div>

    <script>
        // 1. SCRIPT UNTUK MENU HAMBURGER SIDEBAR MOBILE
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }

        // ======================= 2. SCRIPT FITUR CAROUSEL BANNER =======================
        let slideIndex = 0;
        const slides = document.querySelectorAll('#carousel-inner > div');
        const dots = document.querySelectorAll('.carousel-dot');
        let slideInterval = setInterval(() => moveSlide(1), 4000); // Otomatis bergeser tiap 4 detik

        function showSlide(index) {
            if (index >= slides.length) slideIndex = 0;
            else if (index < 0) slideIndex = slides.length - 1;
            else slideIndex = index;

            // Menggeser inner wrapper berdasarkan persentase indeks
            document.getElementById('carousel-inner').style.transform = `translateX(-${slideIndex * 100}%)`;
            
            // Perbarui warna indikator titik (dots)
            dots.forEach((dot, idx) => {
                if (idx === slideIndex) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white', 'w-4'); // Titik aktif dibuat lebih lonjong
                } else {
                    dot.classList.remove('bg-white', 'w-4');
                    dot.classList.add('bg-white/50');
                }
            });
        }
        function moveSlide(step) {
            clearInterval(slideInterval); // Reset timer otomatis saat tombol ditekan manual
            showSlide(slideIndex + step);
            slideInterval = setInterval(() => moveSlide(1), 4000); // Mulai timer kembali
        }
        function currentSlide(index) {
            clearInterval(slideInterval);
            showSlide(index);
            slideInterval = setInterval(() => moveSlide(1), 4000);
        }
        showSlide(slideIndex); // Jalankan inisialisasi awal carousel
        // ==============================================================================

        // 3. SCRIPT FITUR LOGIKA KALENDER
        const eventsData = @json($events ?? []);
        let date = new Date();
        let currentMonth = date.getMonth(); 
        let currentYear = date.getFullYear();
        if (currentYear > 2026) { currentYear = 2026; currentMonth = 11; }
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
        const monthSelect = document.getElementById('month-select');
        const yearSelect = document.getElementById('year-select');

        function initDropdowns() {
            monthNames.forEach((month, index) => {
                let option = document.createElement('option');
                option.value = index; option.text = month;
                monthSelect.appendChild(option);
            });
            const startYear = new Date().getFullYear() - 10;
            const maxYear = 2026; 
            for (let y = startYear; y <= maxYear; y++) {
                let option = document.createElement('option');
                option.value = y; option.text = y;
                yearSelect.appendChild(option);
            }
        }
        function jumpToDate() {
            currentMonth = parseInt(monthSelect.value);
            currentYear = parseInt(yearSelect.value);
            renderCalendar();
        }
        function renderCalendar() {
            monthSelect.value = currentMonth; yearSelect.value = currentYear;
            const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();
            const totalDays = new Date(currentYear, currentMonth + 1, 0).getDate();
            const daysContainer = document.getElementById('calendar-days');
            let daysHtml = `<div class="text-gray-400 font-bold mb-1 md:mb-2 text-center">Su</div><div class="text-gray-400 font-bold mb-1 md:mb-2 text-center">Mo</div><div class="text-gray-400 font-bold mb-1 md:mb-2 text-center">Tu</div><div class="text-gray-400 font-bold mb-1 md:mb-2 text-center">We</div><div class="text-gray-400 font-bold mb-1 md:mb-2 text-center">Th</div><div class="text-gray-400 font-bold mb-1 md:mb-2 text-center">Fr</div><div class="text-gray-400 font-bold mb-1 md:mb-2 text-center">Sa</div>`;
            for (let x = 0; x < firstDayIndex; x++) { daysHtml += `<div></div>`; }
            const today = new Date();
            for (let i = 1; i <= totalDays; i++) {
                let isToday = (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear());
                let monthStr = String(currentMonth + 1).padStart(2, '0');
                let dayStr = String(i).padStart(2, '0');
                let currentDateStr = `${currentYear}-${monthStr}-${dayStr}`;
                let dayEvents = eventsData.filter(ev => ev.start_date === currentDateStr);
                let styleClass = '';
                if (isToday) { styleClass = 'bg-[#A72B2A] text-white font-bold shadow-sm ring-2 ring-offset-1 ring-[#A72B2A]'; }
                else if (dayEvents.length > 0) { styleClass = 'bg-[#F5D7D7] text-[#A72B2A] font-extrabold ring-1 ring-[#D9A0A0]'; }
                else { styleClass = 'bg-gray-50 hover:bg-gray-200 text-gray-700'; }
                daysHtml += `<button onclick="openEventModal('${currentDateStr}')" class="${styleClass} aspect-square rounded-lg flex items-center justify-center font-bold text-[10px] md:text-base transition transform active:scale-95 cursor-pointer w-full shadow-2xs">${i}</button>`;
            }
            daysContainer.innerHTML = daysHtml;
        }
        function openEventModal(dateStr) {
            const dayEvents = eventsData.filter(ev => ev.start_date === dateStr);
            const modal = document.getElementById('event-modal');
            const modalDate = document.getElementById('modal-date');
            const modalContent = document.getElementById('modal-content');
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            modalDate.innerHTML = `<i class="fa-regular fa-calendar-days"></i> ${new Date(dateStr).toLocaleDateString('id-ID', options)}`;
            if (dayEvents.length > 0) {
                let html = '';
                dayEvents.forEach(ev => {
                    let email = ev.user ? ev.user.email : 'admin@bpa.com';
                    let startT = ev.start_time ? ev.start_time.substring(0, 5) : '00:00';
                    let endT = ev.end_time ? ev.end_time.substring(0, 5) : '00:00';
                    html += `<div class="bg-[#F3F3F3] p-3 md:p-4 border-l-4 border-[#A72B2A] rounded-r-lg shadow-2xs mb-3">
                                <h5 class="font-extrabold text-gray-900 text-sm md:text-base tracking-wide text-left">${ev.title}</h5>
                                <div class="text-gray-500 text-[10px] md:text-xs mt-2 space-y-1 font-medium text-left">
                                    <p><i class="fa-regular fa-clock w-4 text-[#A72B2A]"></i> ${startT} - ${endT} WIB</p>
                                    <p><i class="fa-solid fa-location-dot w-4 text-[#A72B2A]"></i> ${ev.location}</p>
                                    <p class="text-gray-400 italic pt-1 border-t border-dashed border-gray-200 mt-2"><i class="fa-solid fa-envelope w-4"></i> Pembuat: ${email}</p>
                                </div>
                                <div class="mt-3 text-right">
                                    <a href="/events/${ev.id}" class="text-[10px] md:text-xs text-[#A72B2A] font-extrabold hover:underline">Lihat Detail ></a>
                                </div>
                            </div>`;
                });
                modalContent.innerHTML = html;
            } else {
                modalContent.innerHTML = `<div class="text-center py-8 text-gray-400"><i class="fa-regular fa-calendar-times text-4xl mb-2 text-gray-300"></i><p class="text-sm font-semibold">Tidak ada agenda acara pada tanggal ini.</p></div>`;
            }
            modal.classList.remove('hidden');
        }
        function closeModal() { document.getElementById('event-modal').classList.add('hidden'); }
        window.addEventListener('click', function(e) { if (e.target === document.getElementById('event-modal')) { closeModal(); } });
        function prevMonth() { currentMonth--; if (currentMonth < 0) { currentMonth = 11; currentYear--; } renderCalendar(); }
        function nextMonth() { if (currentYear >= 2026 && currentMonth === 11) return; currentMonth++; if (currentMonth > 11) { currentMonth = 0; currentYear++; } renderCalendar(); }
        initDropdowns(); renderCalendar();
    </script>
</body>
</html>