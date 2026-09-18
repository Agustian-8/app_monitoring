<div class="px-5 pt-2 animate-fade-in">

    {{-- ============== HEADER INFO ============== --}}
    <div class="bg-gradient-to-br from-green-500 via-green-600 to-green-700 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -top-8 -right-8 w-32 h-32 rounded-full bg-white/5"></div>

        <div class="relative">
            <div class="flex items-center space-x-2 mb-1">
                <div class="w-8 h-8 rounded-lg bg-white/15 backdrop-blur-sm flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <p class="text-xs font-semibold text-green-100 uppercase tracking-widest">Kunjungan Hari Ini</p>
            </div>
            <p class="text-3xl font-bold tracking-tight mt-2">
                <span id="kunjunganCount">0</span>
                <span class="text-base font-medium text-green-100">kunjungan</span>
            </p>
            <p class="text-xs text-green-100 mt-1">Catat kunjungan ke outlet/toko</p>
        </div>
    </div>

    {{-- ============== FORM ============== --}}
    <form id="formVisit" class="space-y-4 mt-5">

        {{-- PILIH OUTLET --}}
        <div>
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">Pilih Outlet</label>
            <div class="relative">
                <select id="visitOutlet" required
                    class="w-full pl-4 pr-10 py-3.5 bg-white border border-ink-200 rounded-xl text-sm font-medium focus:border-green-500 smooth appearance-none cursor-pointer">
                    <option value="">Memuat daftar toko...</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- FOTO BUKTI --}}
        <div>
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">
                Foto Bukti <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input type="file" id="visitPhoto" accept="image/*" capture="environment" class="hidden" onchange="previewVisitPhoto(event)">
                <label for="visitPhoto" id="visitPhotoBox"
                    class="flex flex-col items-center justify-center w-full h-32 bg-white border-2 border-dashed border-ink-300 rounded-xl cursor-pointer hover:border-green-400 smooth">
                    <div id="visitPhotoPlaceholder" class="flex flex-col items-center">
                        <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-ink-700">Ambil Foto Bukti</p>
                        <p class="text-[10px] text-ink-400 mt-0.5">Kamera belakang</p>
                    </div>
                    <img id="visitPhotoPreview" src="" alt="Preview" class="hidden w-full h-full object-cover rounded-xl">
                </label>
            </div>
        </div>

        {{-- GPS --}}
        <div>
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">Lokasi GPS</label>
            <div class="bg-white border border-ink-200 rounded-xl p-4">
                <button type="button" onclick="getVisitLocation()" id="visitGpsBtn"
                    class="w-full flex items-center justify-center space-x-2 bg-green-50 hover:bg-green-100 text-green-700 text-sm font-semibold px-4 py-3 rounded-lg smooth active:scale-[0.98]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Kunci Lokasi Sekarang</span>
                </button>

                {{-- GPS Status --}}
                <div id="visitGpsStatusBox" class="hidden mt-3 p-3 rounded-lg border flex items-start space-x-2">
                    <div class="flex-1">
                        <p id="visitGpsStatusText" class="text-xs font-semibold"></p>
                        <p id="visitGpsStatusDetail" class="text-[10px] mt-0.5"></p>
                    </div>
                </div>

                {{-- Distance Info --}}
                <div id="visitDistanceBox" class="hidden mt-3 p-3 rounded-lg border">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-ink-700">Jarak ke Outlet</span>
                        <span id="visitDistanceText" class="text-sm font-bold">-</span>
                    </div>
                    <p id="visitDistanceStatus" class="text-[10px] mt-1"></p>
                </div>

                <input type="hidden" id="visitLat">
                <input type="hidden" id="visitLng">
            </div>
        </div>

        {{-- CATATAN --}}
        <div>
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">
                Catatan <span class="text-ink-400 font-normal normal-case">(opsional)</span>
            </label>
            <textarea id="visitNotes" rows="3" placeholder="Tulis hasil kunjungan..."
                class="w-full px-4 py-3.5 bg-white border border-ink-200 rounded-xl text-sm focus:border-green-500 smooth resize-none"></textarea>
        </div>

        {{-- SUBMIT --}}
        <button type="submit" id="submitVisitBtn"
            class="w-full bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-semibold text-sm shadow-lg shadow-green-600/25 smooth active:scale-[0.98] flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span>Kirim Laporan Kunjungan</span>
        </button>

    </form>

    <div class="h-4"></div>
</div>

<script>
    // ==================================================
    // LOAD OUTLETS
    // ==================================================
    async function loadOutlets() {
        try {
            const result = await apiGet('/api/outlets');
            AppState.outletsData = result.data || [];

            let options = '<option value="">-- Pilih Toko --</option>';
            AppState.outletsData.forEach(outlet => {
                options += `<option value="${outlet.id}">${outlet.name}</option>`;
            });
            document.getElementById('visitOutlet').innerHTML = options;
        } catch (e) {
            document.getElementById('visitOutlet').innerHTML = '<option value="">Gagal memuat toko</option>';
        }
    }

    // ==================================================
    // PREVIEW FOTO
    // ==================================================
    function previewVisitPhoto(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('visitPhotoPreview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            document.getElementById('visitPhotoPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    // ==================================================
    // GET LOCATION
    // ==================================================
    function getVisitLocation() {
        const btn = document.getElementById('visitGpsBtn');
        const statusBox = document.getElementById('visitGpsStatusBox');
        const statusText = document.getElementById('visitGpsStatusText');
        const statusDetail = document.getElementById('visitGpsStatusDetail');

        btn.disabled = true;
        btn.innerHTML = '<span class="animate-pulse">Mencari lokasi...</span>';

        if (!navigator.geolocation) {
            alert('Browser tidak mendukung GPS.');
            btn.disabled = false;
            btn.innerHTML = 'Kunci Lokasi Sekarang';
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function(position) {
                if (position.coords.accuracy > 500) {
                    statusBox.className = 'mt-3 p-3 rounded-lg border border-red-200 bg-red-50 flex items-start space-x-2';
                    statusText.className = 'text-xs font-semibold text-red-700';
                    statusText.textContent = 'Lokasi tidak valid';
                    statusDetail.className = 'text-[10px] mt-0.5 text-red-600';
                    statusDetail.textContent = `Akurasi terlalu rendah. Matikan fake GPS.`;
                    statusBox.classList.remove('hidden');
                } else {
                    document.getElementById('visitLat').value = position.coords.latitude;
                    document.getElementById('visitLng').value = position.coords.longitude;

                    statusBox.className = 'mt-3 p-3 rounded-lg border border-green-200 bg-green-50 flex items-start space-x-2';
                    statusText.className = 'text-xs font-semibold text-green-700';
                    statusText.textContent = 'Lokasi terkunci';
                    statusDetail.className = 'text-[10px] mt-0.5 text-green-600';
                    statusDetail.textContent = `Lat: ${position.coords.latitude.toFixed(6)}, Lng: ${position.coords.longitude.toFixed(6)}`;
                    statusBox.classList.remove('hidden');

                    checkVisitDistance();
                }

                btn.disabled = false;
                btn.innerHTML = '<span>Perbarui Lokasi</span>';
            },
            function(error) {
                alert('Gagal mengakses GPS. Pastikan izin lokasi diberikan.');
                btn.disabled = false;
                btn.innerHTML = 'Kunci Lokasi Sekarang';
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    }

    // ==================================================
    // HITUNG JARAK
    // ==================================================
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

        const outlet = AppState.outletsData.find(o => o.id == outletId);
        if (!outlet || !outlet.latitude || !outlet.longitude) {
            box.className = 'hidden mt-3 p-3 rounded-lg border border-amber-200 bg-amber-50';
            box.classList.remove('hidden');
            text.textContent = '-';
            statusEl.textContent = 'Koordinat outlet belum diatur admin.';
            return;
        }

        const distance = calculateDistanceJS(lat, lng, outlet.latitude, outlet.longitude);
        const radius = outlet.radius_meters || 50;

        box.classList.remove('hidden');
        text.textContent = Math.round(distance) + ' m';

        if (distance <= radius) {
            box.className = 'mt-3 p-3 rounded-lg border border-green-200 bg-green-50';
            text.className = 'text-sm font-bold text-green-700';
            statusEl.className = 'text-[10px] mt-1 text-green-600';
            statusEl.textContent = `Dalam radius (maks ${radius}m). Siap submit.`;
        } else {
            box.className = 'mt-3 p-3 rounded-lg border border-red-200 bg-red-50';
            text.className = 'text-sm font-bold text-red-700';
            statusEl.className = 'text-[10px] mt-1 text-red-600';
            statusEl.textContent = `Terlalu jauh! Maksimal ${radius}m. Silakan mendekat.`;
        }
    }

    document.getElementById('visitOutlet').addEventListener('change', checkVisitDistance);

    // ==================================================
    // SUBMIT
    // ==================================================
    document.getElementById('formVisit').addEventListener('submit', async function(e) {
        e.preventDefault();

        const lat = document.getElementById('visitLat').value;
        const lng = document.getElementById('visitLng').value;
        const outletId = document.getElementById('visitOutlet').value;

        if (!outletId) return alert("Silakan pilih toko terlebih dahulu.");
        if (!lat || !lng) return alert("Silakan klik Kunci Lokasi Sekarang.");

        const outlet = AppState.outletsData.find(o => o.id == outletId);
        if (outlet && outlet.latitude && outlet.longitude) {
            const distance = calculateDistanceJS(parseFloat(lat), parseFloat(lng), outlet.latitude, outlet.longitude);
            const radius = outlet.radius_meters || 50;
            if (distance > radius) {
                return alert(`Anda ${Math.round(distance)}m dari outlet. Maksimal ${radius}m.`);
            }
        }

        const btn = document.getElementById('submitVisitBtn');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="animate-pulse">Mengirim...</span>';
        btn.disabled = true;

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
                alert(data.message || 'Laporan berhasil dikirim!');
                document.getElementById('formVisit').reset();
                document.getElementById('visitPhotoPreview').classList.add('hidden');
                document.getElementById('visitPhotoPlaceholder').classList.remove('hidden');
                document.getElementById('visitGpsStatusBox').classList.add('hidden');
                document.getElementById('visitDistanceBox').classList.add('hidden');
                document.getElementById('visitGpsBtn').innerHTML = '<span>Kunci Lokasi Sekarang</span>';

                // Update counter
                const count = parseInt(document.getElementById('kunjunganCount').textContent) || 0;
                document.getElementById('kunjunganCount').textContent = count + 1;
            } else {
                alert(data.message || 'Gagal mengirim laporan');
            }
        } catch (error) {
            alert('Terjadi kesalahan jaringan/upload.');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    });

    // ==================================================
    // HOOK
    // ==================================================
    window.onTabKunjungan = function() {
        if (AppState.outletsData.length === 0) {
            loadOutlets();
        }
    };
</script>