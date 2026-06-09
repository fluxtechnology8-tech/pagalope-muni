@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stats admin --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
  {{-- TODO: Obtener estadísticas desde el controlador --}}
  @php
    $adminStats = [
      ['value' => 'S/ 0', 'label' => 'Recaudado hoy', 'icon' => 'fa-solid fa-sack-dollar', 'bg' => '#FEF3C7', 'color' => '#92400E', 'trend' => 0],
      ['value' => '0', 'label' => 'Pagos procesados', 'icon' => 'fa-solid fa-credit-card', 'bg' => '#DCFCE7', 'color' => '#166534', 'trend' => 0],
      ['value' => '0', 'label' => 'Nuevas consultas', 'icon' => 'fa-solid fa-magnifying-glass', 'bg' => '#EEF4FB', 'color' => '#19376D', 'trend' => 0],
      ['value' => '0', 'label' => 'Deudas vencidas hoy', 'icon' => 'fa-solid fa-triangle-exclamation', 'bg' => '#FEE2E2', 'color' => '#B91C1C', 'trend' => 0],
    ];
  @endphp

  @foreach($adminStats as $s)
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
      <div class="flex items-start justify-between mb-3">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:{{ $s['bg'] }}">
          <i class="{{ $s['icon'] }} text-base" style="color:{{ $s['color'] }}"></i>
        </div>
        @if($s['trend'] != 0)
          <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $s['trend'] > 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
            <i class="{{ $s['trend'] > 0 ? 'fa-solid fa-arrow-up' : 'fa-solid fa-arrow-down' }} text-[10px]"></i>
            {{ abs($s['trend']) }}%
          </span>
        @endif
      </div>
      <p class="text-xl font-black text-mde-navy">{{ $s['value'] }}</p>
      <p class="text-xs text-gray-400 mt-1">{{ $s['label'] }}</p>
    </div>
  @endforeach
</div>

{{-- Actividad reciente --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm">
  <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
    <h3 class="font-bold text-mde-navy text-sm">Actividad reciente</h3>
    <a href="{{ route('admin.auditoria.index') }}" class="text-xs text-mde-mid font-semibold hover:underline">Ver todo</a>
  </div>
  <div class="divide-y divide-gray-50">
    {{-- TODO: Obtener actividad reciente desde el controlador --}}
    @php
      $actividad = [];
    @endphp

    @forelse($actividad as $act)
      <div class="px-5 py-3 flex items-center gap-3">
        <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0" style="background:{{ $act['bg'] }}">
          <i class="{{ $act['icon'] }} text-xs" style="color:{{ $act['color'] }}"></i>
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-xs font-medium text-mde-navy truncate">{{ $act['msg'] }}</p>
          <p class="text-[10px] text-gray-400 mt-0.5">{{ $act['time'] }}</p>
        </div>
        @if(!empty($act['amount']))
          <span class="text-xs font-bold text-mde-navy">{{ $act['amount'] }}</span>
        @endif
      </div>
    @empty
      <p class="px-5 py-8 text-center text-gray-400 text-xs">No hay actividad reciente</p>
    @endforelse
  </div>
</div>
@endsection
