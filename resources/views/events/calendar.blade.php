<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Event - BPA Telkom</title>
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
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-gray-200 font-semibold transition text-base">
                    <i class="fa-solid fa-house text-lg w-6 text-center"></i>
                    <span>Home</span>
                </a>
                
                <a href="{{ route('events.index') }}" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-gray-200 font-semibold transition text-base">
                    <i class="fa-regular fa-calendar-check text-lg w-6 text-center"></i>
                    <span>Event</span>
                </a>
                
                <a href="{{ route('events.calendar') }}" class="flex items-center gap-4 px-6 py-3 bg-[#F5D7D7] border-l-4 border-[#A72B2A] text-[#A72B2A] font-bold text-base transition">
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
            <div class="max-w-7xl mx-auto">
                
                <div class="mb-6 flex justify-between items-end">
                    <div>
                        <h3 id="calendar-header-title" class="text-2xl md:text-4xl font-extrabold text-black uppercase tracking-wide">Bulan Tahun</h3>
                        <p class="text-xs md:text-sm text-gray-500 font-bold mt-1">Acara yang ada di Telkom University</p>
                    </div>
                    
                    <div class="flex gap-2">
                        <button onclick="prevMonth()" class="w-8 h-8 md:w-10 md:h-10 bg-white border border-[#D9A0A0] rounded text-[#A72B2A] hover:bg-[#F5D7D7] flex items-center justify-center transition shadow-2xs"><i class="fa-solid fa-chevron-left"></i></button>
                        <button onclick="nextMonth()" class="w-8 h-8 md:w-10 md:h-10 bg-white border border-[#D9A0A0] rounded text-[#A72B2A] hover:bg-[#F5D7D7] flex items-center justify-center transition shadow-2xs"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
                    
                    <div class="lg:col-span-3 border border-theme bg-[#F3F3F3] p-2 md:p-4 rounded-sm shadow-sm flex flex-col">
                        <div class="grid grid-cols-7 gap-1 md:gap-2 mb-2 text-center">
                            <div class="text-[#A72B2A] font-extrabold text-xs md:text-sm py-2 bg-[#F5D7D7] rounded border border-[#D9A0A0]">Min</div>
                            <div class="text-gray-600 font-extrabold text-xs md:text-sm py-2 bg-white rounded border border-gray-200">Sen</div>
                            <div class="text-gray-600 font-extrabold text-xs md:text-sm py-2 bg-white rounded border border-gray-200">Sel</div>
                            <div class="text-gray-600 font-extrabold text-xs md:text-sm py-2 bg-white rounded border border-gray-200">Rab</div>
                            <div class="text-gray-600 font-extrabold text-xs md:text-sm py-2 bg-white rounded border border-gray-200">Kam</div>
                            <div class="text-gray-600 font-extrabold text-xs md:text-sm py-2 bg-white rounded border border-gray-200">Jum</div>
                            <div class="text-gray-600 font-extrabold text-xs md:text-sm py-2 bg-white rounded border border-gray-200">Sab</div>
                        </div>
                        <div id="calendar-days-large" class="grid grid-cols-7 gap-1 md:gap-2"></div>
                    </div>

                    <div class="lg:col-span-1 border border-theme bg-white rounded-sm shadow-sm h-[400px] md:h-[550px] flex flex-col overflow-hidden">
                        <div class="bg-gray-50 border-b border-theme p-4 text-center">
                            <h4 id="selected-date-title" class="font-extrabold text-gray-800 text-xs md:text-sm tracking-wide">Pilih Tanggal</h4>
                        </div>
                        <div id="event-details-container" class="flex-1 p-4 overflow-y-auto berita-scroll flex flex-col gap-3 bg-[#F3F3F3]/30">
                            <div class="flex-1 flex flex-col items-center justify-center text-gray-400 py-8">
                                <i class="fa-regular fa-hand-pointer text-4xl mb-3 text-gray-300"></i>
                                <p class="text-xs text-center font-bold px-4 leading-relaxed">Klik salah satu tanggal pada kalender untuk melihat daftar acara.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }

        const eventsData = @json($events ?? []);
        let date = new Date();
        let currentMonth = date.getMonth(); 
        let currentYear = date.getFullYear();
        if (currentYear > 2026) { currentYear = 2026; currentMonth = 11; }
        
        let selectedDateStr = null; 

        const monthNamesIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        function renderCalendar() {
            document.getElementById('calendar-header-title').innerText = `${monthNamesIndo[currentMonth]} ${currentYear}`;
            const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();
            const totalDays = new Date(currentYear, currentMonth + 1, 0).getDate();
            const daysContainer = document.getElementById('calendar-days-large');
            
            let daysHtml = '';
            for (let x = 0; x < firstDayIndex; x++) { 
                daysHtml += `<div class="bg-gray-50/50 rounded border border-gray-100 h-16 md:h-24 opacity-40"></div>`; 
            }

            const today = new Date();
            for (let i = 1; i <= totalDays; i++) {
                let monthStr = String(currentMonth + 1).padStart(2, '0');
                let dayStr = String(i).padStart(2, '0');
                let currentDateStr = `${currentYear}-${monthStr}-${dayStr}`;
                
                let isToday = (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear());
                let isSelected = (currentDateStr === selectedDateStr);
                let dayEvents = eventsData.filter(ev => ev.start_date === currentDateStr);

                let bgClass = 'bg-white hover:bg-gray-50 border border-gray-200 text-gray-700';
                let textClass = 'text-gray-700 font-bold';
                
                if (isSelected) {
                    bgClass = 'bg-gray-100 border-[#A72B2A] ring-2 ring-[#A72B2A] z-10';
                    textClass = 'text-[#A72B2A] font-extrabold';
                } else if (isToday) {
                    bgClass = 'bg-[#F5D7D7] border-[#A72B2A]';
                    textClass = 'text-[#A72B2A] font-extrabold';
                }

                let dotsHtml = '';
                if (dayEvents.length > 0) {
                    dotsHtml = `<div class="flex gap-1 mt-auto w-full px-1 md:px-2 pb-1 md:pb-2 justify-start overflow-hidden">`;
                    dayEvents.slice(0, 3).forEach(e => {
                        dotsHtml += `<div class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-[#A72B2A]"></div>`;
                    });
                    if(dayEvents.length > 3) dotsHtml += `<span class="text-[8px] md:text-[9px] text-[#A72B2A] font-extrabold">+${dayEvents.length - 3}</span>`;
                    dotsHtml += `</div>`;
                }

                daysHtml += `
                    <div onclick="selectDate('${currentDateStr}')" class="${bgClass} rounded h-16 md:h-24 flex flex-col justify-between cursor-pointer transition shadow-2xs relative overflow-hidden active:scale-98 transform">
                        <span class="absolute top-1.5 right-2 text-xs md:text-sm ${textClass}">${i}</span>
                        <div class="mt-auto">${dotsHtml}</div>
                    </div>
                `;
            }
            daysContainer.innerHTML = daysHtml;
        }

        function selectDate(dateStr) {
            selectedDateStr = dateStr;
            renderCalendar(); 

            const dayEvents = eventsData.filter(ev => ev.start_date === dateStr);
            const container = document.getElementById('event-details-container');
            const title = document.getElementById('selected-date-title');

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            title.innerText = new Date(dateStr).toLocaleDateString('id-ID', options);

            if (dayEvents.length > 0) {
                let html = '';
                dayEvents.forEach(ev => {
                    let startT = ev.start_time ? ev.start_time.substring(0, 5) : '00:00';
                    
                    // Logika untuk mengambil gambar (Jika tidak ada gambar, gunakan gambar default)
                    let imageUrl = ev.image ? '/storage/' + ev.image : 'https://placehold.co/400x200/e2e8f0/475569?text=No+Image';

                    html += `
                        <div class="bg-white border-l-4 border-[#A72B2A] p-3 shadow-sm rounded-r border border-gray-100 mb-3 flex flex-col gap-2 shrink-0">
                            
                            <img src="${imageUrl}" alt="${ev.title}" class="w-full h-24 md:h-32 object-cover rounded shadow-sm border border-gray-200">
                            
                            <div>
                                <p class="text-[10px] text-[#A72B2A] font-extrabold mb-0.5"><i class="fa-regular fa-clock"></i> ${startT} WIB</p>
                                <h5 class="font-bold text-gray-800 text-xs md:text-sm leading-tight">${ev.title}</h5>
                                <p class="text-[10px] text-gray-500 font-semibold mt-1"><i class="fa-solid fa-location-dot text-[#A72B2A] mr-1"></i> ${ev.location}</p>
                                <a href="/events/${ev.id}" class="inline-block mt-2 text-[10px] text-blue-600 hover:underline font-extrabold">Lihat Detail ></a>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            } else {
                container.innerHTML = `
                    <div class="flex-1 flex flex-col items-center justify-center text-gray-400 py-8">
                        <i class="fa-regular fa-calendar-xmark text-4xl mb-3 text-gray-300"></i>
                        <p class="text-xs text-center font-bold px-4 leading-relaxed">Tidak ada acara di tanggal ini.</p>
                    </div>
                `;
            }
        }

        function prevMonth() { currentMonth--; if (currentMonth < 0) { currentMonth = 11; currentYear--; } renderCalendar(); }
        function nextMonth() { currentMonth++; if (currentMonth > 11) { currentMonth = 0; currentYear++; } renderCalendar(); }

        renderCalendar();
        
        // Pilih otomatis tanggal hari ini saat pertama kali dimuat
        const todayStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(new Date().getDate()).padStart(2, '0')}`;
        selectDate(todayStr);
    </script>
</body>
</html>