@if(request()->routeIs('filament.admin.auth.login'))
    <div class="flex items-center justify-center">
        <img 
            src="{{ asset('images/Logo_PJ.png') }}" 
            alt="Logo Pakita Jaya" 
            style="height: 100px; width: auto; object-fit: contain;"
        />
    </div>
@else
    <div class="flex items-center gap-2">
        <img 
            src="{{ asset('images/Logo_PJ.png') }}" 
            alt="Logo Pakita Jaya" 
            style="height: 50px; width: auto; object-fit: contain;"
        />
        <span class="font-bold text-lg" style="color: #2563eb;">
            PT. Pakita Jaya
        </span>
    </div>
@endif