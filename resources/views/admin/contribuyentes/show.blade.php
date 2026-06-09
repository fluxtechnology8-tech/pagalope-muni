@extends('layouts.admin')

@section('title', 'Detalle Contribuyente')
@section('page-title', 'Detalle Contribuyente')

@section('content')
{{-- TODO: Obtener contribuyente y sus deudas desde el controlador --}}
@php
  $contribuyente = ['id' => 0, 'nombre' => '-', 'doc' => '-', 'direccion' => '-', 'telefono' => '-'];
  $deudasPendientes = [];
  $deudasPagadas = [];
@endphp

<div class="max-w-4xl">
  {{-- Info contribuyente --}}
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-6">
    <div class="flex items-start justify-between">
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-full bg-mde-light flex items-center justify-center">
          <i class="fa-solid fa-user-tie text-mde-mid text-2xl"></i>
        </div>
        <div>
          <h3 class="font-bold text-mde-navy text-lg">{{ $contribuyente['nombre'] }}</h3>
          <p class="text-gray-400 text-xs mt-0.5">
            <i class="fa-solid fa-id-card mr-1 text-mde-gold"></i>{{ $contribuyente['doc'] }}
            <span class="mx-2 text-gray-300">|</span>
            <i class="fa-solid fa-location-dot mr-1 text-mde-gold"></i>{{ $contribuyente['direccion'] }}
          </p>
        </div>
      </div>
      <div class="text-right">
        <p class="text-xs text-gray-400 font-medium">Deuda total</p>
        <p class="text-2xl font-black text-red-600">S/ 0.00</p>
      </div>
    </div>
  </div>

  {{-- Deudas pendientes --}}
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-mde-navy text-sm">Deudas pendientes</h3>
    </div>
    @forelse($deudasPendientes as $d)
      <div class="px-5 py-3 flex items-center gap-3 border-b border-gray-50">
        <span class="font-medium text-mde-navy text-sm flex-1">{{ $d['concepto'] }}</span>
        <span class="text-gray-500 text-xs">{{ $d['periodo'] }}</span>
        <span class="font-bold text-red-600 text-sm">{{ $d['monto'] }}</span>
      </div>
    @empty
      <p class="px-5 py-8 text-center text-gray-400 text-xs">No tiene deudas pendientes</p>
    @endforelse
  </div>

  {{-- Deudas pagadas --}}
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100">
      <h3 class="font-bold text-mde-navy text-sm">Deudas pagadas</h3>
    </div>
    @forelse($deudasPagadas as $d)
      <div class="px-5 py-3 flex items-center gap-3 border-b border-gray-50">
        <span class="font-medium text-mde-navy text-sm flex-1">{{ $d['concepto'] }}</span>
        <span class="text-gray-500 text-xs">{{ $d['periodo'] }}</span>
        <span class="font-bold text-green-600 text-sm">{{ $d['monto'] }}</span>
      </div>
    @empty
      <p class="px-5 py-8 text-center text-gray-400 text-xs">No tiene deudas pagadas</p>
    @endforelse
  </div>
</div>
@endsection
