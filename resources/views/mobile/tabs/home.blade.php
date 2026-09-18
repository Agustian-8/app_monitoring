<div class="px-5 pt-2 animate-fade-in">

    {{-- ============== HERO CARD: JAM & STATUS ============== --}}
    <div class="bg-gradient-to-br from-brand-600 via-brand-700 to-brand-800 rounded-2xl p-5 text-white shadow-brand relative overflow-hidden">
        <div class="absolute -top-8 -right-8 w-32 h-32 rounded-full bg-white/5"></div>
        <div class="absolute -bottom-12 -left-6 w-28 h-28 rounded-full bg-white/5"></div>

        <div class="relative flex justify-between items-start">
            <div>
                <p class="text-[10px] text-blue-200 font-semibold uppercase tracking-widest">Waktu Sekarang</p>
                <p id="homeClock" class="text-4xl font-bold tracking-tight mt-1 tabular-nums">--:--</p>
                <p id="homeDate" class="text-xs text-blue-100 mt-1 font-medium">Memuat tanggal...</p>
            </div>

            <div id="homeStatusBadge" class="flex items-center space-x-1.5 bg-white/15 backdrop-blur-sm border border-white/20 px-2.5 py-1.5 rounded-lg text-[11px] font-semibold">
                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse-soft"></span>
                <span id="homeStatusText">Memuat...</span>
            </div>
        </div>

        {{-- Progress absen hari ini --}}
        <div class="relative mt-4 pt-4 border-t border-white/15">
            <div class="flex justify-between items-center text-xs">
                <div class="flex items-center space-x-1.5 text-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Masuk:</span>
                    <span id="homeJamMasuk" class="font-semibold text-white">-</span>
                </div>
                <div class="flex items-center space-x-1.5 text-blue-100">
                    <span>Pulang:</span>
                    <span id="homeJamPulang" class="font-semibold text-white">-</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 8l4 4m0 0l-4 4m4-4H3m5-4v-1a3 3 0 013-3h7a3 3 0 013 3v12a3 3 0 01-3 3h-7a3 3 0 01-3-3v-1" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- ============== JADWAL HARI INI ============== --}}
    <div class="mt-4 bg-white rounded-2xl p-4 shadow-soft border border-ink-100">
        <div class="flex items-start space-x-3">
            <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-widest">Jadwal Hari Ini</p>
                <p id="homeSchedule" class="text-sm font-semibold text-ink-800 mt-0.5">Memuat jadwal...</p>
                <p id="homeScheduleNote" class="text-xs mt-1 hidden"></p>
            </div>
        </div>
    </div>

    {{-- ============== STATISTIK BULAN INI ============== --}}
    <div class="mt-5">
        <div class="flex items-center justify-between mb-3 px-1">
            <h2 class="text-sm font-bold text-ink-800">Statistik Bulan Ini</h2>
            <span id="homeMonthLabel" class="text-[11px] text-ink-500 font-medium"></span>
        </div>

        <div class="grid grid-cols-2 gap-3">
            {{-- Hadir --}}
            <div class="bg-white rounded-2xl p-4 shadow-soft border border-ink-100 relative overflow-hidden">
                <div class="absolute top-3 right-3 w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Hadir</p>
                <p id="statHadir" class="text-3xl font-bold text-ink-800 mt-1 tabular-nums">0</p>
                <p class="text-[10px] text-ink-400 mt-0.5">hari kerja</p>
            </div>

            {{-- Telat --}}
            <div class="bg-white rounded-2xl p-4 shadow-soft border border-ink-100 relative overflow-hidden">
                <div class="absolute top-3 right-3 w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Telat</p>
                <p id="statTelat" class="text-3xl font-bold text-ink-800 mt-1 tabular-nums">0</p>
                <p class="text-[10px] text-ink-400 mt-0.5">kali</p>
            </div>

            {{-- Kunjungan --}}
            <div class="bg-white rounded-2xl p-4 shadow-soft border border-ink-100 relative overflow-hidden">
                <div class="absolute top-3 right-3 w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Kunjungan</p>
                <p id="statKunjungan" class="text-3xl font-bold text-ink-800 mt-1 tabular-nums">0</p>
                <p class="text-[10px] text-ink-400 mt-0.5">outlet</p>
            </div>

            {{-- Denda --}}
            <div class="bg-white rounded-2xl p-4 shadow-soft border border-ink-100 relative overflow-hidden">
                <div class="absolute top-3 right-3 w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Denda</p>
                <p id="statDenda" class="text-3xl font-bold text-ink-800 mt-1 tabular-nums">0</p>
                <p class="text-[10px] text-ink-400 mt-0.5">rupiah</p>
            </div>
        </div>
    </div>

    {{-- ============== AKSI CEPAT ============== --}}
    <div class="mt-5">
        <h2 class="text-sm font-bold text-ink-800 mb-3 px-1">Aksi Cepat</h2>
        <div class="grid grid-cols-3 gap-3">

            <button onclick="switchTab('absen')" class="card-hover bg-white rounded-2xl p-4 shadow-soft border border-ink-100 flex flex-col items-center active:border-brand-200">
                <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <span class="text-[11px] font-semibold text-ink-700">Absen</span>
            </button>

            <button onclick="switchTab('kunjungan')" class="card-hover bg-white rounded-2xl p-4 shadow-soft border border-ink-100 flex flex-col items-center active:border-green-200">
                <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="text-[11px] font-semibold text-ink-700">Kunjungan</span>
            </button>

            <button onclick="switchTab('laporan')" class="card-hover bg-white rounded-2xl p-4 shadow-soft border border-ink-100 flex flex-col items-center active:border-amber-200">
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="text-[11px] font-semibold text-ink-700">Laporan</span>
            </button>

        </div>
    </div>

    {{-- ============== AKTIVITAS TERAKHIR ============== --}}
    <div class="mt-5">
        <div class="flex items-center justify-between mb-3 px-1">
            <h2 class="text-sm font-bold text-ink-800">Aktivitas Terakhir</h2>
            <button onclick="switchTab('profil')" class="text-[11px] text-brand-600 font-semibold flex items-center space-x-0.5">
                <span>Lihat Semua</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div id="homeRecentActivity" class="bg-white rounded-2xl shadow-soft border border-ink-100 overflow-hidden divide-y divide-ink-100">
            <div class="p-6 text-center">
                <div class="w-12 h-12 mx-auto rounded-full bg-ink-100 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-xs text-ink-500">Belum ada aktivitas</p>
            </div>
        </div>
    </div>

</div>

<script>
    // ==================================================
    // LIVE CLOCK
    // ==================================================
    function updateHomeClock() {
        const now = new Date();
        const hh = String(now.getHours()).padStart(2, '0');
        const mm = String(now.getMinutes()).padStart(2, '0');

        document.getElementById('homeClock').textContent = `${hh}:${mm}`;

        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        document.getElementById('homeDate').textContent =
            `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

        document.getElementById('homeMonthLabel').textContent =
            `${months[now.getMonth()]} ${now.getFullYear()}`;
    }

    setInterval(updateHomeClock, 1000);

    // ==================================================
    // LOAD JADWAL HARI INI
    // ==================================================
    async function loadHomeSchedule() {
        const el = document.getElementById('homeSchedule');
        const noteEl = document.getElementById('homeScheduleNote');
        const badgeText = document.getElementById('homeStatusText');

        try {
            const result = await apiGet('/api/work-today');
            if (!result.success) throw new Error();

            const d = result.data;
            AppState.workSchedule = d;

            if (!d.is_workday) {
                el.innerHTML = `<span class="text-red-600 font-semibold">Hari Libur</span>`;
                badgeText.textContent = 'Libur';
                return;
            }

            el.innerHTML = `<span class="text-green-700 font-semibold">${d.hari}</span>
                <span class="text-ink-400"> · </span>
                <span class="font-bold">${d.jam_masuk} – ${d.jam_pulang}</span>`;

            // Status telat real-time
            const now = new Date();
            const [hM, mM] = d.jam_masuk.split(':').map(Number);
            const jadwalMasuk = new Date();
            jadwalMasuk.setHours(hM, mM, 0, 0);

            if (now > jadwalMasuk) {
                const menitTelat = Math.floor((now - jadwalMasuk) / 60000);
                let tlKode = 'TL1';
                if (menitTelat > 20) tlKode = 'TL3';
                else if (menitTelat > 10) tlKode = 'TL2';

                noteEl.className = 'text-xs mt-1 text-red-600 font-semibold flex items-center space-x-1';
                noteEl.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>Telat ± ${menitTelat} menit (${tlKode})</span>`;
                noteEl.classList.remove('hidden');

                badgeText.textContent = tlKode;
            } else {
                noteEl.classList.add('hidden');
                badgeText.textContent = 'Siap Absen';
            }
        } catch (e) {
            el.textContent = 'Gagal memuat jadwal';
        }
    }

    // ==================================================
    // LOAD STATISTIK
    // ==================================================
    async function loadHomeStats() {
        try {
            const result = await apiGet('/api/my-stats');

            if (result.success && result.data) {
                const d = result.data;

                document.getElementById('statHadir').textContent = d.hadir || 0;
                document.getElementById('statTelat').textContent = d.telat || 0;
                document.getElementById('statKunjungan').textContent = d.kunjungan || 0;

                // Format denda jadi ringkas: "20rb", "150rb", "1jt"
                const denda = d.denda || 0;
                let dendaLabel = '0';

                if (denda >= 1000000) {
                    dendaLabel = (denda / 1000000).toFixed(1).replace('.0', '') + 'jt';
                } else if (denda >= 1000) {
                    dendaLabel = (denda / 1000).toFixed(0) + 'rb';
                } else {
                    dendaLabel = denda.toString();
                }

                document.getElementById('statDenda').textContent = dendaLabel;
            }
        } catch (e) {
            console.error('Gagal load stats', e);
        }
    }

    // ==================================================
    // LOAD ABSEN HARI INI (untuk hero card)
    // ==================================================
    async function loadTodayAttendance() {
        try {
            const result = await apiGet('/api/today-attendance');

            if (result.success && result.data) {
                document.getElementById('homeJamMasuk').textContent = result.data.jam_masuk || '-';
                document.getElementById('homeJamPulang').textContent = result.data.jam_pulang || '-';
            }
        } catch (e) {}
    }

    // ==================================================
    // HOOK SAAT TAB HOME DIBUKA
    // ==================================================
    window.onTabHome = function() {
        updateHomeClock();
        loadHomeSchedule();
        loadHomeStats();
        loadTodayAttendance();
    };

    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            if (AppState.currentTab === 'home') {
                window.onTabHome();
            }
        }, 100);
    });
</script>