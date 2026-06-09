@extends('layouts.admin')

@section('title', 'Reportes')
@section('page-title', 'Reportes')

@section('content')
<div class="grid md:grid-cols-3 gap-4">
  {{-- TODO: Obtener reportes disponibles desde el controlador --}}
  @php
    $reportes = [
      ['nombre' => 'Recaudación mensual', 'icon' => 'fa-solid fa-sack-dollar', 'bg' => '#FEF3C7', 'color' => '#92400E', 'desc' => 'Resumen de recaudación por periodo'],
      ['nombre' => 'Deudas por vencer', 'icon' => 'fa-solid fa-triangle-exclamation', 'bg' => '#FEE2E2', 'color' => '#B91C1C', 'desc' => 'Deudas próximas a vencer'],
      ['nombre' => 'Contribuyentes con deuda', 'icon' => 'fa-solid fa-users', 'bg' => '#EEF4FB', 'color' => '#19376D', 'desc' => 'Listado de contribuyentes morosos'],
    ];
  @endphp

  @foreach($reportes as $r)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-all cursor-pointer">
      <div class="w-12 h-12 rounded-xl mb-4 flex items-center justify-center" style="background:{{ $r['bg'] }}">
        <i class="{{ $r['icon'] }} text-lg" style="color:{{ $r['color'] }}"></i>
      </div>
      <h3 class="font-bold text-mde-navy text-sm mb-1">{{ $r['nombre'] }}</h3>
      <p class="text-xs text-gray-400">{{ $r['desc'] }}</p>
      <button class="mt-4 text-xs font-semibold text-mde-mid hover:text-mde-navy transition-colors">
        Generar reporte <i class="fa-solid fa-arrow-right ml-1"></i>
      </button>
    </div>
  @endforeach
</div>
@endsection
