@extends('mobile.layouts.app')

@section('title', 'Sales App - Pakita Jaya')

@section('content')

    {{-- TAB: HOME --}}
    <div id="tab-home" class="tab-panel">
        @include('mobile.tabs.home')
    </div>

    {{-- TAB: ABSEN --}}
    <div id="tab-absen" class="tab-panel">
        @include('mobile.tabs.absen')
    </div>

    {{-- TAB: KUNJUNGAN (hanya untuk sales lapangan) --}}
    <div id="tab-kunjungan" class="tab-panel">
        @include('mobile.tabs.kunjungan')
    </div>

    {{-- TAB: LAPORAN --}}
    <div id="tab-laporan" class="tab-panel">
        @include('mobile.tabs.laporan')
    </div>

    {{-- TAB: PROFIL --}}
    <div id="tab-profil" class="tab-panel">
        @include('mobile.tabs.profil')
    </div>

@endsection