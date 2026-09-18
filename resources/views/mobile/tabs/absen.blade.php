<div class="px-5 pt-2 animate-fade-in">

    {{-- ============== INFO JADWAL ============== --}}
    <div id="absenWorkInfo" class="bg-white rounded-2xl p-4 shadow-soft border border-ink-100">
        <div class="flex items-start space-x-3">
            <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[10px] text-ink-500 font-semibold uppercase tracking-widest">Jadwal Hari Ini</p>
                <p id="absenScheduleText" class="text-sm font-semibold text-ink-800 mt-0.5">Memuat jadwal...</p>
                <p id="absenScheduleNote" class="text-xs mt-1 hidden"></p>
            </div>
        </div>
    </div>

    {{-- ============== FORM ============== --}}
    <form id="formAbsen" class="space-y-4 mt-5">

        {{-- TIPE ABSEN --}}
        <div>
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">Tipe Absen</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer">
                    <input type="radio" name="tipe_absen" value="Masuk" class="peer sr-only" required checked>
                    <div class="px-4 py-3.5 rounded-xl text-center bg-white border border-ink-200 text-ink-600 peer-checked:bg-brand-600 peer-checked:text-white peer-checked:border-brand-600 peer-checked:shadow-brand smooth font-semibold text-sm flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Masuk</span>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="tipe_absen" value="Pulang" class="peer sr-only" required>
                    <div class="px-4 py-3.5 rounded-xl text-center bg-white border border-ink-200 text-ink-600 peer-checked:bg-ink-800 peer-checked:text-white peer-checked:border-ink-800 peer-checked:shadow-soft smooth font-semibold text-sm flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 8l4 4m0 0l-4 4m4-4H3m5-4v-1a3 3 0 013-3h7a3 3 0 013 3v12a3 3 0 01-3 3h-7a3 3 0 01-3-3v-1" />
                        </svg>
                        <span>Pulang</span>
                    </div>
                </label>
            </div>
        </div>

        {{-- KODE ABSEN --}}
        <div id="kodeContainer">
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">Kode Absensi</label>
            <div class="relative">
                <select id="kodeAbsen" class="w-full pl-4 pr-10 py-3.5 bg-white border border-ink-200 rounded-xl text-sm font-medium focus:border-brand-500 smooth appearance-none cursor-pointer" required onchange="onKodeChange()">
                    <option value="">Memuat kode absensi...</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            <p id="kodeHelper" class="text-[11px] text-ink-500 mt-1.5"></p>
        </div>

        {{-- FOTO --}}
        <div id="photo-container">
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">
                <span id="photoLabelText">Foto Selfie</span>
                <span id="photoRequired" class="text-red-500">*</span>
            </label>

            <div class="relative">
                <input type="file" id="absenPhoto" accept="image/*" capture="user" class="hidden" onchange="previewPhoto(event)">
                <label for="absenPhoto" id="photoBox"
                    class="flex flex-col items-center justify-center w-full h-32 bg-white border-2 border-dashed border-ink-300 rounded-xl cursor-pointer hover:border-brand-400 smooth">
                    <div id="photoPlaceholder" class="flex flex-col items-center">
                        <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-ink-700">Ambil Foto</p>
                        <p class="text-[10px] text-ink-400 mt-0.5">Ketuk untuk buka kamera</p>
                    </div>
                    <img id="photoPreview" src="" alt="Preview" class="hidden w-full h-full object-cover rounded-xl">
                </label>
            </div>
            <p id="photoHelper" class="text-[11px] text-ink-500 mt-1.5 hidden"></p>
        </div>

        {{-- GPS --}}
        <div id="absen-gps-container">
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">Lokasi GPS</label>
            <div class="bg-white border border-ink-200 rounded-xl p-4">
                <button type="button" onclick="getAbsenLocation()" id="gpsBtn"
                    class="w-full flex items-center justify-center space-x-2 bg-brand-50 hover:bg-brand-100 text-brand-700 text-sm font-semibold px-4 py-3 rounded-lg smooth active:scale-[0.98]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Kunci Lokasi Sekarang</span>
                </button>

                <div id="gpsStatusBox" class="hidden mt-3 p-3 rounded-lg border flex items-start space-x-2">
                    <svg id="gpsStatusIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="flex-1">
                        <p id="gpsStatusText" class="text-xs font-semibold"></p>
                        <p id="gpsStatusDetail" class="text-[10px] mt-0.5"></p>
                    </div>
                </div>

                <input type="hidden" id="absenLat">
                <input type="hidden" id="absenLng">
            </div>
        </div>

        {{-- KETERANGAN --}}
        <div>
            <label class="block text-xs font-semibold text-ink-700 mb-2 uppercase tracking-wider">
                Keterangan <span class="text-ink-400 font-normal normal-case">(opsional)</span>
            </label>
            <input type="text" id="absenNotes" placeholder="Tambahkan catatan jika perlu..."
                class="w-full px-4 py-3.5 bg-white border border-ink-200 rounded-xl text-sm focus:border-brand-500 smooth">
        </div>

        {{-- SUBMIT --}}
        <button type="submit" id="submitAbsenBtn"
            class="w-full bg-brand-600 hover:bg-brand-700 text-white py-4 rounded-xl font-semibold text-sm shadow-brand smooth active:scale-[0.98] flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span id="submitAbsenText">Kirim Absen Masuk</span>
        </button>

    </form>

    <div class="h-4"></div>
</div>

<script>
    // ==================================================
    // LOAD JADWAL HARI INI
    // ==================================================
    async function loadAbsenSchedule() {
        const el = document.getElementById('absenScheduleText');
        const noteEl = document.getElementById('absenScheduleNote');
        try {
            const result = await apiGet('/api/work-today');
            if (!result.success) throw new Error();

            const d = result.data;
            AppState.workSchedule = d;

            if (!d.is_workday) {
                el.innerHTML = `<span class="text-red-600 font-semibold">Hari Libur</span>`;
                return;
            }

            el.innerHTML = `<span class="text-green-700 font-semibold">${d.hari}</span>
                <span class="text-ink-400"> · </span>
                <span class="font-bold">${d.jam_masuk} – ${d.jam_pulang}</span>`;

            const now = new Date();
            const [hM, mM] = d.jam_masuk.split(':').map(Number);
            const jadwalMasuk = new Date();
            jadwalMasuk.setHours(hM, mM, 0, 0);

            if (now > jadwalMasuk) {
                const menit = Math.floor((now - jadwalMasuk) / 60000);
                let tlKode = 'TL1';
                if (menit > 20) tlKode = 'TL3';
                else if (menit > 10) tlKode = 'TL2';

                noteEl.className = 'text-xs mt-1 text-red-600 font-semibold';
                noteEl.textContent = `Telat ± ${menit} menit (${tlKode})`;
                noteEl.classList.remove('hidden');
            } else {
                noteEl.classList.add('hidden');
            }
        } catch (e) {
            el.textContent = 'Gagal memuat jadwal';
        }
    }

    // ==================================================
    // LOAD KODE ABSEN
    // ==================================================
    async function loadKodeAbsen() {
        try {
            const result = await apiGet('/api/attendance-codes');
            AppState.kodeListData = result.data || [];

            const kategori = {
                hadir:     { label: 'Kehadiran', options: [] },
                izin:      { label: 'Izin', options: [] },
                cuti:      { label: 'Cuti', options: [] },
                absen:     { label: 'Sakit / Absen', options: [] },
                khusus:    { label: 'Khusus', options: [] },
            };

            AppState.kodeListData.forEach(item => {
                if (item.auto) return;
                const kat = kategori[item.kategori] ? item.kategori : 'khusus';
                kategori[kat].options.push(item);
            });

            let optionsHtml = '<option value="">-- Pilih Kode --</option>';
            ['hadir', 'izin', 'cuti', 'absen', 'khusus'].forEach(katKey => {
                const kat = kategori[katKey];
                if (!kat || kat.options.length === 0) return;
                optionsHtml += `<optgroup label="${kat.label}">`;
                kat.options.forEach(opt => {
                    optionsHtml += `<option value="${opt.kode}">${opt.kode} — ${opt.label}</option>`;
                });
                optionsHtml += `</optgroup>`;
            });

            document.getElementById('kodeAbsen').innerHTML = optionsHtml;
        } catch (e) {
            document.getElementById('kodeAbsen').innerHTML = '<option value="">Gagal memuat</option>';
        }
    }

    // ==================================================
    // ON KODE CHANGE — DISESUAIKAN DENGAN MULTI-TIPE
    // ==================================================
    function onKodeChange() {
        const kode = document.getElementById('kodeAbsen').value;
        const kodeInfo = AppState.kodeListData.find(k => k.kode === kode);

        const gpsContainer = document.getElementById('absen-gps-container');
        const photoInput = document.getElementById('absenPhoto');
        const photoLabelText = document.getElementById('photoLabelText');
        const photoRequired = document.getElementById('photoRequired');
        const photoHelper = document.getElementById('photoHelper');
        const kodeHelper = document.getElementById('kodeHelper');

        kodeHelper.textContent = '';
        photoHelper.classList.add('hidden');

        if (!kodeInfo) {
            gpsContainer.style.display = 'block';
            photoLabelText.textContent = 'Foto Selfie';
            photoRequired.classList.remove('hidden');
            return;
        }

        // ---- LABEL FOTO ----
        if (kodeInfo.butuh_surat) {
            photoLabelText.textContent = 'Upload Bukti / Surat';
            photoInput.setAttribute('capture', '');
            photoRequired.classList.remove('hidden');
            photoHelper.textContent = 'Wajib upload surat/bukti pendukung (bisa dari galeri).';
            photoHelper.classList.remove('hidden');
        } else if (kodeInfo.butuh_foto) {
            photoLabelText.textContent = 'Foto Selfie';
            photoInput.setAttribute('capture', 'user');
            photoRequired.classList.remove('hidden');
        } else {
            photoLabelText.textContent = 'Upload Bukti (Opsional)';
            photoRequired.classList.add('hidden');
        }

        // ---- GPS: HANYA untuk kode yang butuh lokasi (H, TL1/TL2/TL3) ----
        if (kodeInfo.butuh_lokasi) {
            gpsContainer.style.display = 'block';
        } else {
            gpsContainer.style.display = 'none';
            document.getElementById('absenLat').value = '';
            document.getElementById('absenLng').value = '';
            document.getElementById('gpsStatusBox').classList.add('hidden');
        }

        // ---- FOTO REQUIRED ----
        if (kodeInfo.butuh_foto || kodeInfo.butuh_surat) {
            photoInput.setAttribute('required', 'required');
        } else {
            photoInput.removeAttribute('required');
        }

        // ---- HELPER TEXT ----
        if (kodeInfo.butuh_lokasi) {
            kodeHelper.textContent = 'Absen ini memerlukan lokasi GPS kantor.';
        } else if (kode === 'DLK') {
            kodeHelper.textContent = 'Dinas Luar Kota — dapat dilakukan dari mana saja.';
        } else if (kodeInfo.butuh_surat) {
            kodeHelper.textContent = 'Absen ini memerlukan bukti/surat pendukung.';
        } else {
            kodeHelper.textContent = '';
        }
    }

    // ==================================================
    // PREVIEW FOTO
    // ==================================================
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('photoPreview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            document.getElementById('photoPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    // ==================================================
    // GET LOCATION
    // ==================================================
    function getAbsenLocation() {
        const btn = document.getElementById('gpsBtn');
        const statusBox = document.getElementById('gpsStatusBox');
        const statusText = document.getElementById('gpsStatusText');
        const statusDetail = document.getElementById('gpsStatusDetail');

        btn.disabled = true;
        btn.innerHTML = '<span class="animate-pulse">Mencari lokasi...</span>';

        if (!navigator.geolocation) {
            alert('Browser Anda tidak mendukung GPS.');
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
                    statusDetail.textContent = `Akurasi terlalu rendah (${Math.round(position.coords.accuracy)}m). Matikan fake GPS.`;
                    statusBox.classList.remove('hidden');
                } else {
                    document.getElementById('absenLat').value = position.coords.latitude;
                    document.getElementById('absenLng').value = position.coords.longitude;

                    statusBox.className = 'mt-3 p-3 rounded-lg border border-green-200 bg-green-50 flex items-start space-x-2';
                    statusText.className = 'text-xs font-semibold text-green-700';
                    statusText.textContent = 'Lokasi terkunci';
                    statusDetail.className = 'text-[10px] mt-0.5 text-green-600';
                    statusDetail.textContent = `Lat: ${position.coords.latitude.toFixed(6)}, Lng: ${position.coords.longitude.toFixed(6)}`;
                    statusBox.classList.remove('hidden');
                }

                btn.disabled = false;
                btn.innerHTML = '<span>Perbarui Lokasi</span>';
            },
            function(error) {
                alert('Gagal mengakses GPS. Pastikan izin lokasi sudah diberikan.');
                btn.disabled = false;
                btn.innerHTML = 'Kunci Lokasi Sekarang';
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    }

    // ==================================================
    // TOGGLE FORM BERDASARKAN TIPE ABSEN
    // ==================================================
    document.addEventListener('DOMContentLoaded', () => {
        const tipeRadios = document.querySelectorAll('input[name="tipe_absen"]');
        const kodeContainer = document.getElementById('kodeContainer');
        const submitBtn = document.getElementById('submitAbsenBtn');
        const submitText = document.getElementById('submitAbsenText');

        tipeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Pulang') {
                    kodeContainer.style.display = 'none';
                    document.getElementById('kodeAbsen').removeAttribute('required');
                    document.getElementById('absen-gps-container').style.display = 'none';
                    document.getElementById('photo-container').style.display = 'none';
                    document.getElementById('absenPhoto').removeAttribute('required');

                    submitText.textContent = 'Kirim Absen Pulang';
                    submitBtn.classList.remove('bg-brand-600', 'hover:bg-brand-700');
                    submitBtn.classList.add('bg-ink-800', 'hover:bg-ink-900');
                } else {
                    kodeContainer.style.display = 'block';
                    document.getElementById('kodeAbsen').setAttribute('required', 'required');
                    document.getElementById('photo-container').style.display = 'block';

                    submitText.textContent = 'Kirim Absen Masuk';
                    submitBtn.classList.remove('bg-ink-800', 'hover:bg-ink-900');
                    submitBtn.classList.add('bg-brand-600', 'hover:bg-brand-700');

                    onKodeChange();
                }
            });
        });
    });

    // ==================================================
    // SUBMIT
    // ==================================================
    document.getElementById('formAbsen').addEventListener('submit', async function(e) {
        e.preventDefault();

        const btn = document.getElementById('submitAbsenBtn');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="animate-pulse">Mengirim...</span>';
        btn.disabled = true;

        const tipeAbsen = document.querySelector('input[name="tipe_absen"]:checked').value;
        const formData = new FormData();
        formData.append('tipe_absen', tipeAbsen);

        if (tipeAbsen === 'Masuk') {
            const kode = document.getElementById('kodeAbsen').value;
            if (!kode) {
                alert('Silakan pilih kode absensi terlebih dahulu.');
                btn.innerHTML = originalHtml;
                btn.disabled = false;
                return;
            }
            formData.append('kode_absen', kode);

            const lat = document.getElementById('absenLat').value;
            const lng = document.getElementById('absenLng').value;
            if (lat && lng) {
                formData.append('latitude', lat);
                formData.append('longitude', lng);
            }

            const photoInput = document.getElementById('absenPhoto');
            if (photoInput.files.length > 0) {
                formData.append('photo', photoInput.files[0]);
            }
        } else {
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
                let msg = data.message;
                if (data.kode_absen && data.kode_label) {
                    msg += `\n\nKode: ${data.kode_absen} — ${data.kode_label}`;
                }
                if (data.menit_telat > 0) {
                    msg += `\n\nAnda telat ${data.menit_telat} menit.`;
                }
                if (data.menit_lembur > 0) {
                    msg += `\n\nAnda lembur ${data.menit_lembur} menit.`;
                }
                alert(msg);

                document.getElementById('formAbsen').reset();
                document.getElementById('photoPreview').classList.add('hidden');
                document.getElementById('photoPlaceholder').classList.remove('hidden');
                document.getElementById('gpsStatusBox').classList.add('hidden');
                document.getElementById('kodeAbsen').value = '';
                document.querySelector('input[name="tipe_absen"][value="Masuk"]').click();
                onKodeChange();
                loadAbsenSchedule();
            } else {
                alert(data.message || 'Harap periksa isian Anda');
            }
        } catch (error) {
            alert('Terjadi kesalahan jaringan.');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    });

    // ==================================================
    // HOOK
    // ==================================================
    window.onTabAbsen = function() {
        loadAbsenSchedule();
        if (AppState.kodeListData.length === 0) {
            loadKodeAbsen();
        }
    };
</script>