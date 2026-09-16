<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Aplikasi Sales - Pakita Jaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { brand: { DEFAULT: '#2563eb', dark: '#1d4ed8', light: '#eff6ff' } },
                    animation: { 'fade-in': 'fadeIn 0.4s ease-out' },
                    keyframes: { fadeIn: { '0%': { opacity: '0', transform: 'translateY(10px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } } }
                }
            }
        }
    </script>
    <style>
        body { background-color: #f3f4f6; }
        .glass-header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">
    <div class="max-w-md mx-auto bg-white min-h-screen relative shadow-2xl sm:border-x sm:border-gray-200 overflow-x-hidden pb-10">

        <!-- Header -->
        <div class="glass-header text-white px-6 pt-10 pb-14 rounded-b-[2.5rem] relative">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-blue-100 font-medium tracking-wide uppercase">Selamat bekerja,</p>
                        <h2 class="text-xl font-bold tracking-tight truncate w-40" id="userName">Memuat...</h2>
                    </div>
                </div>
                <button onclick="logout()" class="flex items-center space-x-1.5 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 px-3 py-2 rounded-xl transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="text-sm font-medium">Keluar</span>
                </button>
            </div>
        </div>

        <!-- Pilihan Menu (Floating Tabs) -->
        <div class="bg-white p-1.5 rounded-2xl flex mx-6 -mt-8 relative z-10 shadow-lg border border-gray-100">
            <button onclick="showTab('absenTab')" id="btnAbsen" class="flex-1 bg-brand text-white py-3 rounded-xl font-semibold shadow-md transition-all duration-300 text-sm">
                Absensi
            </button>
            <button onclick="showTab('visitTab')" id="btnVisit" class="flex-1 bg-transparent text-gray-500 hover:text-brand py-3 rounded-xl font-semibold transition-all duration-300 text-sm">
                Kunjungan
            </button>
        </div>

        <!-- ================= KONTEN ABSENSI ================= -->
        <div id="absenTab" class="px-6 pt-8 animate-fade-in">

            <!-- INFO JAM KERJA -->
            <div id="workInfoBox" class="mb-5 p-4 rounded-2xl border bg-brand-light/50 border-blue-100">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Jadwal Hari Ini</p>
                        <p id="workInfoText" class="text-sm font-semibold text-gray-800 mt-0.5">Memuat jadwal...</p>
                        <p id="workLateInfo" class="text-xs mt-1 hidden"></p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-bold text-xl text-gray-800">Form Absensi</h3>
                <p class="text-xs text-gray-500 mt-1">Catat kehadiran Anda hari ini.</p>
            </div>

            <form id="formAbsen" class="space-y-5">
                <!-- Tipe Absen -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Absen</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="tipe_absen" value="Masuk" class="peer sr-only" required checked>
                            <div class="px-4 py-3 rounded-xl text-center bg-gray-50 border border-gray-200 text-gray-600 peer-checked:bg-brand peer-checked:text-white peer-checked:border-brand peer-checked:shadow-md transition-all font-medium">Masuk</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="tipe_absen" value="Pulang" class="peer sr-only" required>
                            <div class="px-4 py-3 rounded-xl text-center bg-gray-50 border border-gray-200 text-gray-600 peer-checked:bg-gray-800 peer-checked:text-white peer-checked:border-gray-800 peer-checked:shadow-md transition-all font-medium">Pulang</div>
                        </label>
                    </div>
                </div>

                <!-- KODE ABSENSI (DROPDOWN DINAMIS) -->
                <div id="kodeContainer">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Absensi</label>
                    <select id="kodeAbsen" class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand/20 focus:border-brand outline-none transition-all" required onchange="onKodeChange()">
                        <option value="">Memuat kode absensi...</option>
                    </select>
                    <p id="kodeHelper" class="text-xs text-gray-500 mt-1.5"></p>
                </div>

                <!-- FOTO (DINAMIS - SYARAT TERGANTUNG KODE) -->
                <div id="photo-container" class="block">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <span id="photoLabelText">Foto Selfie</span>
                        <span id="photoRequired" class="text-red-500">*</span>
                    </label>
                    <input type="file" id="absenPhoto" accept="image/*" capture="user" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-light file:text-brand hover:file:bg-blue-100 bg-gray-50 border border-gray-200 rounded-xl p-1.5 cursor-pointer transition-all">
                    <p id="photoHelper" class="text-xs text-gray-500 mt-1.5 hidden"></p>
                </div>

                <!-- GPS LOCATION (DINAMIS - HANYA UNTUK KODE HADIR) -->
                <div id="absen-gps-container" class="bg-brand-light/50 p-4 rounded-2xl border border-blue-100 block">
                    <label class="block text-sm font-semibold text-brand-dark mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Lokasi GPS Kantor
                    </label>
                    <button type="button" onclick="getAbsenLocation()" class="w-full bg-brand text-white text-sm font-medium px-4 py-2.5 rounded-xl mb-2 hover:bg-brand-dark active:scale-[0.98] transition-all shadow-sm">Kunci Lokasi Saat Ini</button>
                    <div class="flex items-center justify-center space-x-1.5 mt-2">
                        <span id="absenLocationStatus" class="text-xs text-gray-500 font-medium">Lokasi belum didapatkan</span>
                    </div>
                    <input type="hidden" id="absenLat">
                    <input type="hidden" id="absenLng">
                </div>

                <!-- KETERANGAN -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="text" id="absenNotes" placeholder="Tambahkan catatan jika perlu..." class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand/20 focus:border-brand outline-none transition-all">
                </div>

                <button type="submit" id="submitAbsenBtn" class="w-full bg-brand hover:bg-brand-dark text-white py-3.5 rounded-xl font-semibold mt-2 shadow-lg transition-all duration-300 transform active:scale-[0.98]">
                    Kirim Absen Masuk
                </button>
            </form>
        </div>

        <!-- ================= KONTEN KUNJUNGAN ================= -->
        <div id="visitTab" class="px-6 pt-8 hidden animate-fade-in">
            <div class="mb-6">
                <h3 class="font-bold text-xl text-gray-800">Laporan Kunjungan</h3>
                <p class="text-xs text-gray-500 mt-1">Check-in pada outlet/toko tujuan.</p>
            </div>

            <form id="formVisit" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Toko/Outlet</label>
                    <select id="visitOutlet" class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none transition-all" required>
                        <option value="">Memuat daftar toko...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti <span class="text-gray-400 font-normal">(Kamera Belakang)</span></label>
                    <input type="file" id="visitPhoto" accept="image/*" capture="environment" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 bg-gray-50 border border-gray-200 rounded-xl p-1.5 cursor-pointer transition-all" required>
                </div>

                <div class="bg-green-50/50 p-4 rounded-2xl border border-green-100">
                    <label class="block text-sm font-semibold text-green-700 mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Lokasi GPS Anda
                    </label>
                    <button type="button" onclick="getVisitLocation()" class="w-full bg-green-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl mb-2 hover:bg-green-700 active:scale-[0.98] transition-all shadow-sm">Kunci Lokasi Saat Ini</button>
                    <div class="flex items-center justify-center mt-2">
                        <span id="visitLocationStatus" class="text-xs text-gray-500 font-medium">Lokasi belum didapatkan</span>
                    </div>
                    <input type="hidden" id="visitLat">
                    <input type="hidden" id="visitLng">

                    <div id="visitDistanceBox" class="hidden mt-3 p-3 rounded-xl text-sm font-medium border transition-all">
                        <div class="flex items-center justify-between">
                            <span>Jarak ke outlet:</span>
                            <span id="visitDistanceText" class="font-bold">-</span>
                        </div>
                        <div id="visitDistanceStatus" class="text-xs mt-1"></div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Sales <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <textarea id="visitNotes" rows="3" placeholder="Tulis hasil kunjungan..." class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none transition-all resize-none"></textarea>
                </div>

                <button type="submit" id="submitVisitBtn" class="w-full bg-green-600 hover:bg-green-700 text-white py-3.5 rounded-xl font-semibold mt-2 shadow-lg shadow-green-600/30 transition-all duration-300 transform active:scale-[0.98]">
                    Kirim Laporan Kunjungan
                </button>
            </form>
        </div>
    </div>

    <script>
        const token = localStorage.getItem('access_token');
        if (!token) window.location.href = '/';
        document.getElementById('userName').innerText = localStorage.getItem('user_name') || 'Sales';

        // ==============================
        // VARIABEL GLOBAL
        // ==============================
        let outletsData = [];       // untuk kunjungan
        let kodeListData = [];      // untuk dropdown kode absen
        let workScheduleData = null; // jadwal hari ini

        // ==============================
        // LOAD KODE ABSENSI (DARI API)
        // ==============================
        async function loadKodeAbsen() {
            try {
                const response = await fetch('/api/attendance-codes', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                const result = await response.json();
                kodeListData = result.data || [];

                // Kelompokkan kode per kategori
                const kategori = {
                    hadir:     { label: 'Kehadiran', options: [] },
                    izin:      { label: 'Izin', options: [] },
                    cuti:      { label: 'Cuti', options: [] },
                    absen:     { label: 'Sakit / Absen', options: [] },
                    khusus:    { label: 'Khusus', options: [] },
                    terlambat: { label: 'Terlambat (Otomatis)', options: [] }, // info
                };

                kodeListData.forEach(item => {
                    // Skip yang auto (TL1/TL2/TL3) karena auto-generate
                    if (item.auto) return;
                    const kat = kategori[item.kategori] ? item.kategori : 'khusus';
                    kategori[kat].options.push(item);
                });

                // Build dropdown dengan optgroup
                let optionsHtml = '<option value="">-- Pilih Kode --</option>';
                const urutan = ['hadir', 'izin', 'cuti', 'absen', 'khusus'];

                urutan.forEach(katKey => {
                    const kat = kategori[katKey];
                    if (!kat || kat.options.length === 0) return;

                    optionsHtml += `<optgroup label="${kat.label}">`;
                    kat.options.forEach(opt => {
                        optionsHtml += `<option value="${opt.kode}">${opt.kode} — ${opt.label}</option>`;
                    });
                    optionsHtml += `</optgroup>`;
                });

                document.getElementById('kodeAbsen').innerHTML = optionsHtml;
            } catch (error) {
                document.getElementById('kodeAbsen').innerHTML = '<option value="">Gagal memuat kode absen</option>';
            }
        }

        // ==============================
        // HANDLE PERUBAHAN KODE
        // ==============================
        function onKodeChange() {
            const kode = document.getElementById('kodeAbsen').value;
            const kodeInfo = kodeListData.find(k => k.kode === kode);

            const photoContainer = document.getElementById('photo-container');
            const gpsContainer = document.getElementById('absen-gps-container');
            const photoInput = document.getElementById('absenPhoto');
            const latInput = document.getElementById('absenLat');
            const lngInput = document.getElementById('absenLng');
            const photoLabelText = document.getElementById('photoLabelText');
            const photoRequired = document.getElementById('photoRequired');
            const photoHelper = document.getElementById('photoHelper');
            const kodeHelper = document.getElementById('kodeHelper');

            // Reset
            kodeHelper.textContent = '';
            photoHelper.classList.add('hidden');

            if (!kodeInfo) {
                photoContainer.style.display = 'block';
                gpsContainer.style.display = 'block';
                photoInput.removeAttribute('required');
                latInput.removeAttribute('required');
                lngInput.removeAttribute('required');
                photoLabelText.textContent = 'Foto Selfie';
                photoRequired.classList.remove('hidden');
                return;
            }

            // Label & helper dari kode
            if (kodeInfo.butuh_surat) {
                photoLabelText.textContent = 'Upload Bukti / Surat';
                photoInput.setAttribute('capture', ''); // boleh dari galeri
                photoRequired.classList.remove('hidden');
                photoHelper.textContent = 'Wajib upload surat/bukti pendukung.';
                photoHelper.classList.remove('hidden');
            } else if (kodeInfo.butuh_foto) {
                photoLabelText.textContent = 'Foto Selfie';
                photoInput.setAttribute('capture', 'user');
                photoRequired.classList.remove('hidden');
                photoHelper.classList.add('hidden');
            } else {
                photoLabelText.textContent = 'Upload Bukti (Opsional)';
                photoRequired.classList.add('hidden');
                photoHelper.classList.add('hidden');
            }

            // Sembunyikan GPS kalau tidak butuh lokasi
            if (kodeInfo.butuh_lokasi) {
                gpsContainer.style.display = 'block';
                latInput.setAttribute('required', 'required');
                lngInput.setAttribute('required', 'required');
            } else {
                gpsContainer.style.display = 'none';
                latInput.removeAttribute('required');
                lngInput.removeAttribute('required');
                latInput.value = '';
                lngInput.value = '';
            }

            // Foto required kalau butuh foto/surat
            if (kodeInfo.butuh_foto || kodeInfo.butuh_surat) {
                photoInput.setAttribute('required', 'required');
                photoContainer.style.display = 'block';
            } else {
                photoInput.removeAttribute('required');
                photoContainer.style.display = 'block';
            }

            // Helper text di bawah dropdown
            if (kodeInfo.butuh_lokasi) {
                kodeHelper.textContent = '📍 Absen ini memerlukan lokasi GPS kantor.';
            } else if (kodeInfo.butuh_surat) {
                kodeHelper.textContent = 'Absen ini memerlukan bukti/surat pendukung.';
            } else {
                kodeHelper.textContent = '';
            }
        }

        // ==============================
        // TOGGLE FORM BERDASARKAN TIPE ABSEN
        // ==============================
        document.addEventListener('DOMContentLoaded', () => {

            // Logika tombol MASUK / PULANG
            const tipeAbsenRadios = document.querySelectorAll('input[name="tipe_absen"]');
            const kodeContainer = document.getElementById('kodeContainer');
            const submitAbsenBtn = document.getElementById('submitAbsenBtn');

            tipeAbsenRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'Pulang') {
                        // Sembunyikan dropdown kode & form foto/GPS
                        kodeContainer.style.display = 'none';
                        document.getElementById('kodeAbsen').removeAttribute('required');
                        document.getElementById('absen-gps-container').style.display = 'none';
                        document.getElementById('photo-container').style.display = 'none';
                        document.getElementById('absenPhoto').removeAttribute('required');
                        document.getElementById('absenLat').removeAttribute('required');
                        document.getElementById('absenLng').removeAttribute('required');

                        submitAbsenBtn.innerText = 'Kirim Absen Pulang';
                        submitAbsenBtn.classList.remove('bg-brand', 'hover:bg-brand-dark');
                        submitAbsenBtn.classList.add('bg-gray-800', 'hover:bg-gray-900');
                    } else {
                        kodeContainer.style.display = 'block';
                        document.getElementById('kodeAbsen').setAttribute('required', 'required');
                        submitAbsenBtn.innerText = 'Kirim Absen Masuk';
                        submitAbsenBtn.classList.remove('bg-gray-800', 'hover:bg-gray-900');
                        submitAbsenBtn.classList.add('bg-brand', 'hover:bg-brand-dark');

                        // Trigger onKodeChange untuk set kondisi sesuai kode
                        onKodeChange();
                    }
                });
            });

            // Load data awal
            loadKodeAbsen();
            loadTodaySchedule();
        });

        // ==============================
        // LOAD JADWAL HARI INI
        // ==============================
        async function loadTodaySchedule() {
            const el = document.getElementById('workInfoText');
            const lateEl = document.getElementById('workLateInfo');
            try {
                const response = await fetch('/api/work-today', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                const result = await response.json();

                if (!result.success) throw new Error();

                workScheduleData = result.data;
                const d = result.data;

                if (!d.is_workday) {
                    el.innerHTML = `<span class="text-red-600">🔴 Hari ${d.hari} — Libur</span>`;
                    return;
                }

                el.innerHTML = `<span class="text-green-700">🟢 ${d.hari}</span> 
                    <span class="text-gray-500 font-normal"> · </span>
                    <span class="font-bold">${d.jam_masuk} – ${d.jam_pulang}</span>
                    <span class="text-xs text-gray-500 font-normal"> (toleransi ${d.toleransi} menit)</span>`;

                // Info telat real-time (kalau sekarang sudah lewat jam masuk + toleransi)
                const now = new Date();
                const [hM, mM] = d.jam_masuk.split(':').map(Number);
                const jadwalMasuk = new Date();
                jadwalMasuk.setHours(hM, mM + d.toleransi, 0, 0);

                if (now > jadwalMasuk) {
                    const menitTelat = Math.floor((now - jadwalMasuk) / 60000);
                    let tlKode = 'TL1';
                    if (menitTelat > 20) tlKode = 'TL3';
                    else if (menitTelat > 10) tlKode = 'TL2';

                    lateEl.className = 'text-xs mt-1 text-red-600 font-medium';
                    lateEl.innerHTML = `⚠️ Sekarang sudah lewat jam masuk. Telat ± ${menitTelat} menit — akan tercatat sebagai ${tlKode}.`;
                    lateEl.classList.remove('hidden');
                } else {
                    lateEl.classList.add('hidden');
                }

            } catch (e) {
                el.textContent = 'Gagal memuat jadwal.';
            }
        }

        // ==============================
        // NAVIGASI TAB
        // ==============================
        function showTab(tabName) {
            document.getElementById('absenTab').classList.add('hidden');
            document.getElementById('visitTab').classList.add('hidden');
            document.getElementById(tabName).classList.remove('hidden');

            const btnAbsen = document.getElementById('btnAbsen');
            const btnVisit = document.getElementById('btnVisit');

            const activeClass = "flex-1 bg-brand text-white py-3 rounded-xl font-semibold shadow-md transition-all duration-300 text-sm";
            const inactiveClass = "flex-1 bg-transparent text-gray-500 hover:text-brand py-3 rounded-xl font-semibold transition-all duration-300 text-sm";

            if (tabName === 'absenTab') {
                btnAbsen.className = activeClass;
                btnVisit.className = inactiveClass;
            } else {
                btnVisit.className = activeClass;
                btnAbsen.className = inactiveClass;
                loadOutlets();
            }
        }

        // ==============================
        // LOGOUT
        // ==============================
        async function logout() {
            if (confirm('Yakin ingin logout?')) {
                await fetch('/api/logout', { method: 'POST', headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' } });
                localStorage.clear();
                window.location.href = '/';
            }
        }

        // ==============================
        // GPS UI HELPER
        // ==============================
        function setGpsStatus(elementId, lat, lng) {
            const el = document.getElementById(elementId);
            el.innerHTML = `<span class="text-green-600">✓ Terkunci (Lat: ${lat.toFixed(4)})</span>`;
        }

        // ==============================
        // GET LOCATION — ABSENSI
        // ==============================
        function getAbsenLocation() {
            const status = document.getElementById('absenLocationStatus');
            status.innerText = "Mencari kordinat...";
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        if (position.coords.accuracy > 500) {
                            alert('Terdeteksi lokasi tidak valid (akurasi > 500m). Matikan Fake GPS dan coba lagi.');
                            status.innerText = "Lokasi tidak valid";
                            return;
                        }

                        document.getElementById('absenLat').value = position.coords.latitude;
                        document.getElementById('absenLng').value = position.coords.longitude;
                        setGpsStatus('absenLocationStatus', position.coords.latitude, position.coords.longitude);
                    },
                    function(error) { alert("Izinkan akses GPS!"); status.innerText = "Gagal mengakses GPS"; },
                    { enableHighAccuracy: true, timeout: 10000 }
                );
            }
        }

        // ==============================
        // GET LOCATION — KUNJUNGAN
        // ==============================
        function getVisitLocation() {
            const status = document.getElementById('visitLocationStatus');
            status.innerText = "Mencari kordinat...";
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        if (position.coords.accuracy > 500) {
                            alert('Terdeteksi lokasi tidak valid (akurasi > 500m). Matikan Fake GPS dan coba lagi.');
                            status.innerText = "Lokasi tidak valid";
                            return;
                        }

                        document.getElementById('visitLat').value = position.coords.latitude;
                        document.getElementById('visitLng').value = position.coords.longitude;
                        setGpsStatus('visitLocationStatus', position.coords.latitude, position.coords.longitude);

                        checkVisitDistance();
                    },
                    function(error) { alert("Izinkan akses GPS!"); status.innerText = "Gagal mengakses GPS"; },
                    { enableHighAccuracy: true, timeout: 10000 }
                );
            }
        }

        // ==============================
        // HITUNG JARAK
        // ==============================
        function calculateDistanceJS(lat1, lng1, lat2, lng2) {
            const R = 6371000;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLng = (lng2 - lng1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 +
                      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLng / 2) ** 2;
            return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        }

        function checkVisitDistance() {
            const outletId = document.getElementById('visitOutlet').value;
            const lat = parseFloat(document.getElementById('visitLat').value);
            const lng = parseFloat(document.getElementById('visitLng').value);
            const box = document.getElementById('visitDistanceBox');
            const text = document.getElementById('visitDistanceText');
            const statusEl = document.getElementById('visitDistanceStatus');

            if (!outletId || !lat || !lng) {
                box.classList.add('hidden');
                return;
            }

            const outlet = outletsData.find(o => o.id == outletId);
            if (!outlet || !outlet.latitude || !outlet.longitude) {
                box.classList.remove('hidden');
                box.className = 'mt-3 p-3 rounded-xl text-sm font-medium border bg-yellow-50 border-yellow-200 text-yellow-700';
                text.textContent = '-';
                statusEl.innerHTML = '⚠ Koordinat outlet belum diatur Admin.';
                return;
            }

            const distance = calculateDistanceJS(lat, lng, outlet.latitude, outlet.longitude);
            const radius = outlet.radius_meters || 50;

            box.classList.remove('hidden');
            text.textContent = Math.round(distance) + ' meter';

            if (distance <= radius) {
                box.className = 'mt-3 p-3 rounded-xl text-sm font-medium border bg-green-50 border-green-200 text-green-700';
                statusEl.innerHTML = `✓ Dalam radius (maks ${radius}m). Siap submit!`;
            } else {
                box.className = 'mt-3 p-3 rounded-xl text-sm font-medium border bg-red-50 border-red-200 text-red-700';
                statusEl.innerHTML = `✗ Terlalu jauh! Maksimal ${radius}m. Silakan mendekat ke outlet.`;
            }
        }

        document.getElementById('visitOutlet').addEventListener('change', checkVisitDistance);

        // ==============================
        // SUBMIT ABSENSI
        // ==============================
        document.getElementById('formAbsen').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitAbsenBtn');
            const originalText = btn.innerText;
            btn.innerText = 'Mengirim...'; btn.disabled = true; btn.classList.add('opacity-80');

            const tipeAbsen = document.querySelector('input[name="tipe_absen"]:checked').value;
            const formData = new FormData();
            formData.append('tipe_absen', tipeAbsen);

            if (tipeAbsen === 'Masuk') {
                const kode = document.getElementById('kodeAbsen').value;
                if (!kode) {
                    alert('Silakan pilih kode absensi terlebih dahulu.');
                    btn.innerText = originalText; btn.disabled = false; btn.classList.remove('opacity-80');
                    return;
                }
                formData.append('kode_absen', kode);

                // GPS (kalau ada)
                const lat = document.getElementById('absenLat').value;
                const lng = document.getElementById('absenLng').value;
                if (lat && lng) {
                    formData.append('latitude', lat);
                    formData.append('longitude', lng);
                }

                // Foto (kalau ada)
                const photoInput = document.getElementById('absenPhoto');
                if (photoInput.files.length > 0) {
                    formData.append('photo', photoInput.files[0]);
                }
            } else {
                // Absen pulang: default kode H
                formData.append('kode_absen', 'H');
            }

            formData.append('notes', document.getElementById('absenNotes').value);

            try {
                const response = await fetch('/api/attendances', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + token },
                    body: formData
                });
                const data = await response.json();
                if (response.ok) {
                    let msg = '✅ ' + data.message;
                    if (data.kode_absen && data.kode_label) {
                        msg += `\n\n📋 Kode: ${data.kode_absen} — ${data.kode_label}`;
                    }
                    if (data.menit_telat > 0) {
                        msg += `\n\n⚠ Anda telat ${data.menit_telat} menit.`;
                    }
                    if (data.menit_lembur > 0) {
                        msg += `\n\n💪 Terima kasih! Anda lembur ${data.menit_lembur} menit.`;
                    }
                    alert(msg);

                    document.getElementById('formAbsen').reset();
                    document.getElementById('absenLocationStatus').innerText = 'Lokasi belum didapatkan';
                    document.getElementById('kodeAbsen').value = '';

                    // Reset ke state awal (Masuk, kondisi default)
                    document.querySelector('input[name="tipe_absen"][value="Masuk"]').click();
                    onKodeChange();
                } else {
                    alert(data.message || 'Harap periksa isian Anda');
                }
            } catch (error) {
                alert('Terjadi kesalahan jaringan.');
            } finally {
                btn.innerText = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-80');
            }
        });

        // ==============================
        // LOAD OUTLETS
        // ==============================
        async function loadOutlets() {
            try {
                const response = await fetch('/api/outlets', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                const result = await response.json();
                outletsData = result.data || [];

                let options = '<option value="">-- Pilih Toko --</option>';
                outletsData.forEach(outlet => {
                    options += `<option value="${outlet.id}">${outlet.name}</option>`;
                });
                document.getElementById('visitOutlet').innerHTML = options;
            } catch (error) {
                document.getElementById('visitOutlet').innerHTML = '<option value="">Gagal memuat toko</option>';
            }
        }

        // ==============================
        // SUBMIT KUNJUNGAN
        // ==============================
        document.getElementById('formVisit').addEventListener('submit', async function(e) {
            e.preventDefault();
            const lat = document.getElementById('visitLat').value;
            const lng = document.getElementById('visitLng').value;
            const outletId = document.getElementById('visitOutlet').value;

            if (!lat || !lng) return alert("Silakan klik 'Kunci Lokasi Saat Ini'!");
            if (!outletId) return alert("Silakan pilih toko terlebih dahulu!");

            const outlet = outletsData.find(o => o.id == outletId);
            if (outlet && outlet.latitude && outlet.longitude) {
                const distance = calculateDistanceJS(parseFloat(lat), parseFloat(lng), outlet.latitude, outlet.longitude);
                const radius = outlet.radius_meters || 50;
                if (distance > radius) {
                    return alert(`Anda berada ${Math.round(distance)}m dari outlet. Maksimal ${radius}m. Silakan mendekat.`);
                }
            }

            const btn = document.getElementById('submitVisitBtn');
            btn.innerText = 'Mengupload Laporan...'; btn.disabled = true; btn.classList.add('opacity-80');

            const formData = new FormData();
            formData.append('outlet_id', outletId);
            formData.append('photo', document.getElementById('visitPhoto').files[0]);
            formData.append('latitude', lat);
            formData.append('longitude', lng);
            formData.append('notes', document.getElementById('visitNotes').value);

            try {
                const response = await fetch('/api/visits', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' },
                    body: formData
                });
                const data = await response.json();
                if (response.ok) {
                    alert('Sukses: ' + data.message);
                    document.getElementById('formVisit').reset();
                    document.getElementById('visitLocationStatus').innerText = 'Lokasi belum didapatkan';
                    document.getElementById('visitDistanceBox').classList.add('hidden');
                } else {
                    alert(data.message || 'Gagal mengirim laporan');
                }
            } catch (error) {
                alert('Terjadi kesalahan jaringan/upload.');
            } finally {
                btn.innerText = 'Kirim Laporan Kunjungan';
                btn.disabled = false;
                btn.classList.remove('opacity-80');
            }
        });
    </script>
</body>
</html>