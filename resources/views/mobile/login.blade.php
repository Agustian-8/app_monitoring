<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - Pakita Jaya</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            light: '#f0f4f8',
                            DEFAULT: '#2563eb',
                            dark: '#1d4ed8',
                            text: '#1a56db'
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'shake': 'shake 0.5s ease-in-out',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        shake: {
                            '0%, 100%': { transform: 'translateX(0)' },
                            '25%': { transform: 'translateX(-8px)' },
                            '75%': { transform: 'translateX(8px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f0f4f8;
            background-image: radial-gradient(circle at top right, rgba(37, 99, 235, 0.05), transparent 40%),
                              radial-gradient(circle at bottom left, rgba(37, 99, 235, 0.05), transparent 40%);
        }

        .glass-card {
            box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.1), 0 10px 20px -5px rgba(0, 0, 0, 0.04);
        }

        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #f9fafb inset !important;
            -webkit-text-fill-color: #1f2937 !important;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 selection:bg-brand selection:text-white">

    <div class="glass-card bg-white rounded-3xl w-full max-w-md p-8 sm:p-10 animate-fade-in-up transition-transform duration-300 hover:-translate-y-1">

        <!-- Logo dan Nama Perusahaan -->
        <div class="flex flex-col items-center mb-8">
            <div class="relative w-24 h-24 sm:w-28 sm:h-28 mb-4 p-2 bg-brand-light rounded-2xl flex items-center justify-center transform transition-transform hover:scale-105">
                <img src="/images/Logo_PJ.png" alt="Logo Pakita Jaya" class="w-full h-full object-contain" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMjU2M2ViIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBhdGggZD0iTTEyIDJMMiA3bDEwIDUgMTAtNS0xMC01ek0yIDE3bDEwIDUgMTAtNU0yIDEybDEwIDUgMTAtNSIvPjwvc3ZnPg=='">
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-brand-text tracking-tight text-center">PT. Pakita Jaya</h1>
            <p class="text-gray-500 text-sm mt-2 text-center">Silakan masuk ke akun Anda</p>
        </div>

        <form id="loginForm" class="space-y-5">
            <!-- Input Email / No HP -->
            <div class="space-y-1.5">
                <label for="login_id" class="block text-sm font-medium text-gray-700 ml-1">Email / Nomor HP</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-brand transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" id="login_id" placeholder="email@contoh.com / 0812xxxxxxxx"
                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-brand/20 focus:border-brand transition-all duration-300 outline-none" required>
                </div>
            </div>

            <!-- Input Password -->
            <div class="space-y-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700 ml-1">Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-brand transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" id="password" placeholder="Masukkan password"
                        class="block w-full pl-11 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-brand/20 focus:border-brand transition-all duration-300 outline-none" required>
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Error Message Alert -->
            <div id="errorMessage" class="hidden flex items-center space-x-2 p-3.5 bg-red-50/80 backdrop-blur-sm border border-red-200 text-red-600 text-sm rounded-xl animate-shake">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="errorText"></span>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="loginBtn" class="relative w-full flex items-center justify-center bg-brand hover:bg-brand-dark text-white py-3.5 rounded-xl font-semibold mt-6 transition-all duration-300 transform active:scale-[0.98] shadow-lg shadow-brand/30 hover:shadow-brand/50 overflow-hidden">
                <span id="btnText">Masuk</span>
                <svg id="btnSpinner" class="hidden animate-spin ml-2 h-5 w-5 text-white absolute right-1/4 sm:right-1/3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center mt-10">
            <p class="text-xs text-gray-400 font-medium tracking-wide">&copy; 2026 PT. Pakita Jaya.<br class="sm:hidden"> All rights reserved.</p>
        </div>
    </div>

    <script>
        // Redirect jika sudah login
        if(localStorage.getItem('access_token')) {
            window.location.href = '/app';
        }

        // Fitur Toggle Show/Hide Password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if(type === 'text') {
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        });

        // Handle Form Submit
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const loginId = document.getElementById('login_id').value;
            const password = passwordInput.value;
            const btn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const errorDiv = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');

            // Reset Error Message state
            errorDiv.classList.add('hidden');
            errorDiv.classList.remove('animate-shake');

            if (!loginId || !password) {
                showError('Email/Nomor HP dan password harus diisi!');
                return;
            }

            // Set state tombol ke loading
            btnText.innerHTML = 'Memproses...';
            btn.disabled = true;
            btn.classList.add('opacity-90', 'cursor-not-allowed');
            btnSpinner.classList.remove('hidden');

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ login_id: loginId, password: password })
                });

                const data = await response.json();

                if (response.ok) {
                    // ==================================================
                    // SIMPAN DATA LOGIN KE LOCALSTORAGE
                    // ==================================================
                    localStorage.setItem('access_token', data.access_token);
                    localStorage.setItem('user_name', data.user.name);
                    localStorage.setItem('user_role', data.user.role || 'sales');
                    localStorage.setItem('user_tipe', data.user.tipe_karyawan || 'kantor');

                    // Animasi sukses sebelum redirect
                    btnText.innerHTML = 'Berhasil!';
                    btnSpinner.classList.add('hidden');
                    btn.classList.replace('bg-brand', 'bg-green-500');
                    btn.classList.replace('hover:bg-brand-dark', 'hover:bg-green-600');

                    setTimeout(() => {
                        window.location.href = '/app';
                    }, 500);
                } else {
                    showError(data.message || 'Login gagal. Periksa Email/No. HP dan Password Anda.');
                }
            } catch (error) {
                showError('Terjadi kesalahan jaringan. Silakan coba lagi.');
            } finally {
                if(!localStorage.getItem('access_token')) {
                    btnText.innerHTML = 'Masuk';
                    btn.disabled = false;
                    btn.classList.remove('opacity-90', 'cursor-not-allowed');
                    btnSpinner.classList.add('hidden');
                }
            }
        });

        // Fungsi bantuan untuk menampilkan error dengan animasi
        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');

            errorText.innerHTML = message;
            errorDiv.classList.remove('hidden');

            errorDiv.classList.remove('animate-shake');
            void errorDiv.offsetWidth;
            errorDiv.classList.add('animate-shake');
        }
    </script>
</body>
</html>