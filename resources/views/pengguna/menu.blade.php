@extends('layouts.utama')
@push('styles')
    @livewireStyles
@endpush
@push('styles')
    @livewireScripts
@endpush

@section('content')
    @livewire('menu-barang')
@endsection