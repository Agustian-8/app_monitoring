<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sales App - Pakita Jaya')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        ink: {
                            50:  '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    boxShadow: {
                        'soft': '0 2px 12px rgba(15, 23, 42, 0.06)',
                        'card': '0 4px 20px rgba(15, 23, 42, 0.08)',
                        'brand': '0 8px 24px rgba(37, 99, 235, 0.25)',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.35s cubic-bezier(0.4, 0, 0.2, 1)',
                        'slide-up': 'slideUp 0.35s cubic-bezier(0.4, 0, 0.2, 1)',
                        'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(8px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100%)' },
                            '100%': { transform: 'translateY(0)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.6' }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        * { -webkit-tap-highlight-color: transparent; }

        body {
            background-color: #f1f5f9;
            font-feature-settings: 'cv11', 'ss01';
        }

        .header-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 55%, #1e40af 100%);
        }

        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .tab-content { padding-bottom: 96px; }

        .tab-panel { display: none; }
        .tab-panel.active {
            display: block;
            animation: fadeIn 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Bottom nav aktif */
        .nav-item.active {
            color: #2563eb;
        }
        .nav-item.active .nav-icon-wrapper {
            background-color: #eff6ff;
            transform: translateY(-2px);
        }
        .nav-item.active .nav-label {
            font-weight: 600;
        }

        /* Smooth transitions */
        .smooth { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }

        /* Focus ring custom */
        input:focus, select:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* Card hover effect */
        .card-hover {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:active {
            transform: scale(0.98);
        }

        /* Backdrop blur for modal */
        .modal-backdrop {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Bottom nav grid dinamis */
        #bottomNavGrid.grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        #bottomNavGrid.grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)) !important; }
    </style>

    @yield('head')
</head>
<body class="font-sans antialiased text-ink-800 min-h-screen">

    <div class="max-w-md mx-auto bg-ink-50 min-h-screen relative shadow-2xl overflow-x-hidden">

        {{-- ============== HEADER ============== --}}
        <header class="header-gradient text-white px-5 pt-7 pb-6 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-16 -left-8 w-32 h-32 rounded-full bg-white/5"></div>

            <div class="relative flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-11 h-11 bg-white/15 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/20 shadow-soft">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] text-blue-100 font-medium tracking-wide uppercase">Selamat Bekerja</p>
                        <h1 class="text-lg font-bold tracking-tight truncate max-w-[180px]" id="userName">Memuat...</h1>
                    </div>
                </div>

                <button onclick="logout()" aria-label="Logout"
                    class="w-10 h-10 flex items-center justify-center bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 rounded-xl smooth active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </div>
        </header>

        {{-- ============== KONTEN ============== --}}
        <main class="tab-content -mt-3 relative">
            @yield('content')
        </main>

        {{-- ============== BOTTOM NAV ============== --}}
        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white/95 backdrop-blur-lg border-t border-ink-200/60 z-50 shadow-[0_-4px_20px_rgba(15,23,42,0.06)]">
            <div id="bottomNavGrid" class="grid grid-cols-5 gap-0.5 px-2 py-2">

                {{-- HOME --}}
                <button onclick="switchTab('home')" data-nav="home" aria-label="Home"
                    class="nav-item flex flex-col items-center justify-center py-2 rounded-xl smooth text-ink-400 hover:text-brand-600">
                    <div class="nav-icon-wrapper w-10 h-8 flex items-center justify-center rounded-lg smooth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span class="nav-label text-[10px] font-medium mt-0.5">Home</span>
                </button>

                {{-- ABSEN --}}
                <button onclick="switchTab('absen')" data-nav="absen" aria-label="Absen"
                    class="nav-item flex flex-col items-center justify-center py-2 rounded-xl smooth text-ink-400 hover:text-brand-600">
                    <div class="nav-icon-wrapper w-10 h-8 flex items-center justify-center rounded-lg smooth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <span class="nav-label text-[10px] font-medium mt-0.5">Absen</span>
                </button>

                {{-- KUNJUNGAN (hanya untuk sales lapangan) --}}
                <button onclick="switchTab('kunjungan')" data-nav="kunjungan" id="navKunjungan" aria-label="Kunjungan"
                    class="nav-item flex flex-col items-center justify-center py-2 rounded-xl smooth text-ink-400 hover:text-brand-600 hidden">
                    <div class="nav-icon-wrapper w-10 h-8 flex items-center justify-center rounded-lg smooth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="nav-label text-[10px] font-medium mt-0.5">Kunjungan</span>
                </button>

                {{-- LAPORAN --}}
                <button onclick="switchTab('laporan')" data-nav="laporan" aria-label="Laporan"
                    class="nav-item flex flex-col items-center justify-center py-2 rounded-xl smooth text-ink-400 hover:text-brand-600">
                    <div class="nav-icon-wrapper w-10 h-8 flex items-center justify-center rounded-lg smooth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="nav-label text-[10px] font-medium mt-0.5">Laporan</span>
                </button>

                {{-- PROFIL --}}
                <button onclick="switchTab('profil')" data-nav="profil" aria-label="Profil"
                    class="nav-item flex flex-col items-center justify-center py-2 rounded-xl smooth text-ink-400 hover:text-brand-600">
                    <div class="nav-icon-wrapper w-10 h-8 flex items-center justify-center rounded-lg smooth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span class="nav-label text-[10px] font-medium mt-0.5">Profil</span>
                </button>

            </div>
        </nav>

    </div>

    {{-- ============== SCRIPT GLOBAL ============== --}}
    <script>
        const token = localStorage.getItem('access_token');
        if (!token) window.location.href = '/';

        window.AppState = {
            token: token,
            userName: localStorage.getItem('user_name') || 'Sales',
            userRole: localStorage.getItem('user_role') || 'sales',
            userTipe: localStorage.getItem('user_tipe') || 'kantor',
            workSchedule: null,
            outletsData: [],
            kodeListData: [],
            currentTab: 'home',
        };

        const userNameEl = document.getElementById('userName');
        if (userNameEl) userNameEl.innerText = AppState.userName;

        // ==================================================
        // SETUP BOTTOM NAV BERDASARKAN TIPE KARYAWAN
        // ==================================================
        function setupBottomNav() {
            const navKunjungan = document.getElementById('navKunjungan');
            const grid = document.getElementById('bottomNavGrid');

            if (AppState.userTipe === 'lapangan') {
                // Sales lapangan → tampilkan tab Kunjungan
                navKunjungan.classList.remove('hidden');
                grid.className = 'grid grid-cols-5 gap-0.5 px-2 py-2';
            } else {
                // Karyawan kantor → sembunyikan tab Kunjungan
                navKunjungan.classList.add('hidden');
                grid.className = 'grid grid-cols-4 gap-0.5 px-2 py-2';
            }
        }

        // ==================================================
        // TAB SWITCHING
        // ==================================================
        function switchTab(tabName) {
            // Cegah akses tab Kunjungan untuk karyawan kantor
            if (tabName === 'kunjungan' && AppState.userTipe === 'kantor') {
                tabName = 'home';
            }

            document.querySelectorAll('.tab-panel').forEach(el => el.classList.remove('active'));

            const target = document.getElementById('tab-' + tabName);
            if (target) target.classList.add('active');

            AppState.currentTab = tabName;
            updateBottomNav(tabName);

            const hookName = 'onTab' + tabName.charAt(0).toUpperCase() + tabName.slice(1);
            if (typeof window[hookName] === 'function') window[hookName]();

            if (window.location.hash !== '#' + tabName) {
                history.replaceState(null, '', '#' + tabName);
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateBottomNav(activeTab) {
            document.querySelectorAll('.nav-item').forEach(el => {
                const navName = el.getAttribute('data-nav');
                if (navName === activeTab) {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });
        }

        // ==================================================
        // LOGOUT
        // ==================================================
        async function logout() {
            if (confirm('Yakin ingin logout?')) {
                try {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
                    });
                } catch (e) {}
                localStorage.clear();
                window.location.href = '/';
            }
        }

        // ==================================================
        // API HELPER
        // ==================================================
        async function apiGet(url) {
            const response = await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });
            return response.json();
        }

        async function apiPost(url, formData) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                },
                body: formData
            });
            return response.json();
        }

        // ==================================================
        // INIT
        // ==================================================
        document.addEventListener('DOMContentLoaded', () => {
            setupBottomNav();

            let hash = window.location.hash.replace('#', '') || 'home';

            // Cegah akses langsung via URL ke kunjungan (kalau kantor)
            if (hash === 'kunjungan' && AppState.userTipe === 'kantor') {
                hash = 'home';
            }

            switchTab(hash);
        });

        window.addEventListener('hashchange', () => {
            let hash = window.location.hash.replace('#', '') || 'home';
            if (hash === 'kunjungan' && AppState.userTipe === 'kantor') {
                hash = 'home';
            }
            switchTab(hash);
        });
    </script>

    @yield('scripts')
</body>
</html>