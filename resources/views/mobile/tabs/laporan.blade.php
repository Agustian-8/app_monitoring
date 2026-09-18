<div class="px-5 pt-2 animate-fade-in">

    {{-- ============== HEADER INFO ============== --}}
    <div class="bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -top-8 -right-8 w-32 h-32 rounded-full bg-white/5"></div>

        <div class="relative">
            <div class="flex items-center space-x-2 mb-1">
                <div class="w-8 h-8 rounded-lg bg-white/15 backdrop-blur-sm flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <p class="text-xs font-semibold text-amber-100 uppercase tracking-widest">Laporan Harian</p>
            </div>
            <p class="text-base font-bold mt-2">Laporkan Aktivitas Anda</p>
            <p class="text-xs text-amber-100 mt-1">Laporan penjualan, stok, & kendala</p>
        </div>
    </div>

    {{-- ============== PLACEHOLDER: COMING SOON ============== --}}
    <div class="mt-5 bg-white rounded-2xl p-8 shadow-soft border border-ink-100 text-center">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-amber-50 flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </div>
        <h3 class="text-sm font-bold text-ink-800 mb-1">Fitur Laporan Sedang Disiapkan</h3>
        <p class="text-xs text-ink-500 max-w-xs mx-auto leading-relaxed">
            Anda akan segera dapat mengirim laporan harian penjualan, stok, dan kendala langsung dari aplikasi.
        </p>

        <div class="mt-6 space-y-2 text-left max-w-xs mx-auto">
            <div class="flex items-start space-x-2">
                <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-xs text-ink-600">Laporan penjualan harian</p>
            </div>
            <div class="flex items-start space-x-2">
                <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-xs text-ink-600">Catatan stok menipis</p>
            </div>
            <div class="flex items-start space-x-2">
                <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-xs text-ink-600">Laporan kendala & hambatan</p>
            </div>
        </div>
    </div>

    {{-- ============== RIWAYAT LAPORAN ============== --}}
    <div class="mt-5 mb-6">
        <h3 class="text-sm font-bold text-ink-800 mb-3 px-1">Riwayat Laporan</h3>
        <div class="bg-white rounded-2xl shadow-soft border border-ink-100 overflow-hidden">
            <div class="p-6 text-center">
                <div class="w-12 h-12 mx-auto rounded-full bg-ink-100 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <p class="text-xs text-ink-500">Belum ada laporan</p>
            </div>
        </div>
    </div>

</div>

<script>
    // Placeholder — nanti diisi saat fitur backend siap
    window.onTabLaporan = function() {
        // Kosongkan dulu
    };
</script>