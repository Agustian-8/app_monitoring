<div class="px-5 pt-2 animate-fade-in">

    {{-- ============== KARTU PROFIL ============== --}}
    <div class="bg-white rounded-2xl p-5 shadow-soft border border-ink-100">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-white text-2xl font-bold shadow-brand flex-shrink-0">
                <span id="profilInitial">S</span>
            </div>
            <div class="flex-1 min-w-0">
                <h2 id="profilName" class="text-base font-bold text-ink-800 truncate">Memuat...</h2>
                <p id="profilDept" class="text-xs text-ink-500 mt-0.5">-</p>
                <div class="inline-flex items-center space-x-1 mt-1.5 bg-green-50 text-green-700 px-2 py-0.5 rounded-md">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse-soft"></span>
                    <span class="text-[10px] font-semibold">Aktif</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ============== INFO AKUN ============== --}}
    <div class="mt-5">
        <h3 class="text-sm font-bold text-ink-800 mb-3 px-1">Informasi Akun</h3>
        <div class="bg-white rounded-2xl shadow-soft border border-ink-100 overflow-hidden divide-y divide-ink-100">

            {{-- Email --}}
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Email</p>
                        <p id="profilEmail" class="text-sm font-medium text-ink-800 truncate">-</p>
                    </div>
                </div>
            </div>

            {{-- No HP --}}
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Nomor HP</p>
                        <p id="profilPhoneDetail" class="text-sm font-medium text-ink-800">-</p>
                    </div>
                </div>
            </div>

            {{-- Departemen --}}
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Departemen</p>
                        <p id="profilDeptDetail" class="text-sm font-medium text-ink-800">-</p>
                    </div>
                </div>
            </div>

            {{-- Tipe Karyawan (BARU) --}}
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Tipe Karyawan</p>
                        <p id="profilTipe" class="text-sm font-medium text-ink-800">-</p>
                    </div>
                </div>
            </div>

            {{-- Bergabung Sejak --}}
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-wider">Bergabung Sejak</p>
                        <p id="profilJoined" class="text-sm font-medium text-ink-800">-</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ============== PENGATURAN ============== --}}
    <div class="mt-5 mb-6">
        <h3 class="text-sm font-bold text-ink-800 mb-3 px-1">Pengaturan</h3>
        <div class="bg-white rounded-2xl shadow-soft border border-ink-100 overflow-hidden divide-y divide-ink-100">

            {{-- INFO PASSWORD (bukan tombol) --}}
            <div class="p-4 flex items-start space-x-3">
                <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-ink-700">Password Akun</p>
                    <p class="text-[11px] text-ink-500 mt-1 leading-relaxed">
                        Untuk mengubah password, silakan hubungi <strong class="text-ink-700">Admin / HRD</strong>. Demi keamanan, hanya admin yang berwenang mengelola password pegawai.
                    </p>
                </div>
            </div>

            {{-- Tentang Aplikasi --}}
            <button onclick="showAbout()" class="w-full p-4 flex items-center justify-between hover:bg-ink-50 active:bg-ink-100 smooth">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-ink-700">Tentang Aplikasi</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Hubungi Admin --}}
            <button onclick="showContactAdmin()" class="w-full p-4 flex items-center justify-between hover:bg-ink-50 active:bg-ink-100 smooth">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-ink-700">Hubungi Admin</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Logout --}}
            <button onclick="logout()" class="w-full p-4 flex items-center justify-between hover:bg-red-50 active:bg-red-100 smooth">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-red-600">Logout</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

        </div>
    </div>

    {{-- ============== FOOTER ============== --}}
    <p class="text-center text-[11px] text-ink-400 pb-4">
        &copy; 2026 PT. Pakita Jaya &middot; Versi 1.0.0
    </p>

</div>

{{-- ============== MODAL: HUBUNGI ADMIN ============== --}}
<div id="contactModal" class="hidden fixed inset-0 bg-ink-900/60 modal-backdrop z-[100] flex items-end justify-center">
    <div class="bg-white w-full max-w-md rounded-t-3xl p-6 animate-slide-up">

        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-ink-800">Hubungi Admin</h3>
            </div>
            <button onclick="closeContactAdmin()" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-ink-100 smooth">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <p class="text-xs text-ink-500 mb-4 leading-relaxed">
            Untuk bantuan terkait akun, password, atau kendala aplikasi, silakan hubungi Admin / HRD melalui kontak berikut:
        </p>

        <div class="space-y-3">
            {{-- WhatsApp --}}
            <a href="https://wa.me/6281200000000?text=Halo%20Admin%2C%20saya%20butuh%20bantuan%20terkait%20akun%20saya." target="_blank"
                class="flex items-center space-x-3 p-3.5 bg-green-50 border border-green-200 rounded-xl hover:bg-green-100 active:scale-[0.98] smooth">
                <div class="w-10 h-10 rounded-xl bg-green-500 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-green-800">WhatsApp Admin</p>
                    <p class="text-[11px] text-green-600">Respon cepat pada jam kerja</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Telepon --}}
            <a href="tel:+6281200000000"
                class="flex items-center space-x-3 p-3.5 bg-brand-50 border border-brand-200 rounded-xl hover:bg-brand-100 active:scale-[0.98] smooth">
                <div class="w-10 h-10 rounded-xl bg-brand-500 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-brand-800">Telepon Kantor</p>
                    <p class="text-[11px] text-brand-600">0812-0000-0000</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <button onclick="closeContactAdmin()" class="w-full mt-5 bg-ink-100 hover:bg-ink-200 text-ink-700 py-3 rounded-xl font-semibold text-sm smooth active:scale-[0.98]">
            Tutup
        </button>
    </div>
</div>

<script>
    // ==================================================
    // LOAD PROFIL
    // ==================================================
    async function loadProfil() {
        try {
            const user = await apiGet('/api/user');
            const name = user.name || 'Sales';

            document.getElementById('profilName').textContent = name;
            document.getElementById('profilInitial').textContent = name.charAt(0).toUpperCase();
            document.getElementById('profilDept').textContent = user.department || '-';
            document.getElementById('profilEmail').textContent = user.email || '-';
            document.getElementById('profilPhoneDetail').textContent = user.no_hp || '-';
            document.getElementById('profilDeptDetail').textContent = user.department || '-';

            // Tipe Karyawan (BARU)
            const tipe = user.tipe_karyawan || 'kantor';
            document.getElementById('profilTipe').textContent = tipe === 'lapangan'
                ? 'Sales / Lapangan'
                : 'Karyawan Kantor';

            if (user.created_at) {
                const d = new Date(user.created_at);
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                document.getElementById('profilJoined').textContent =
                    `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
            }
        } catch (e) {
            console.error('Gagal load profil', e);
        }
    }

    // ==================================================
    // MODAL HUBUNGI ADMIN
    // ==================================================
    function showContactAdmin() {
        document.getElementById('contactModal').classList.remove('hidden');
    }

    function closeContactAdmin() {
        document.getElementById('contactModal').classList.add('hidden');
    }

    // ==================================================
    // ABOUT
    // ==================================================
    function showAbout() {
        alert('Sales App PT. Pakita Jaya\nVersi 1.0.0\n\nAplikasi monitoring absensi & kunjungan sales.');
    }

    // ==================================================
    // HOOK SAAT TAB PROFIL DIBUKA
    // ==================================================
    window.onTabProfil = function() {
        loadProfil();
    };
</script>