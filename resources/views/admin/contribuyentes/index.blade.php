@extends('layouts.admin')

@section('title', 'Contribuyentes')
@section('page-title', 'Contribuyentes')

@section('content')
<div class="flex justify-between items-center mb-5 flex-wrap gap-3">
  <div class="relative">
    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    <input type="text" placeholder="Buscar por DNI, nombre o dirección..."
      class="pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-mde-gold w-72 input-gold transition-all"/>
  </div>
  <a href="{{ route('admin.contribuyentes.create') }}" class="btn-primary text-white text-sm font-bold px-4 py-2.5 rounded-xl inline-flex items-center gap-2 no-underline">
    <i class="fa-solid fa-plus"></i><span>Nuevo contribuyente</span>
  </a>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-mde-light text-mde-navy text-xs font-bold">
        <th class="px-5 py-3 text-left">Contribuyente</th>
        <th class="px-5 py-3 text-center">Doc.</th>
        <th class="px-5 py-3 text-right">Deuda total</th>
        <th class="px-5 py-3 text-center">Estado</th>
        <th class="px-5 py-3 text-center">Acc.</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      {{-- TODO: Obtener contribuyentes desde el controlador --}}
      @php $contribuyentes = []; @endphp

      @forelse($contribuyentes as $c)
        <tr class="result-row">
          <td class="px-5 py-3">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-full bg-mde-light flex items-center justify-center text-xs font-bold text-mde-mid">{{ $c['iniciales'] }}</div>
              <div>
                <p class="font-semibold text-mde-navy text-xs">{{ $c['nombre'] }}</p>
                <p class="text-[10px] text-gray-400">{{ $c['direccion'] }}</p>
              </div>
            </div>
          </td>
          <td class="px-5 py-3 text-center font-mono text-xs text-gray-600">{{ $c['doc'] }}</td>
          <td class="px-5 py-3 text-right font-bold {{ $c['deuda'] > 0 ? 'text-red-600' : 'text-green-600' }}">S/ {{ number_format($c['deuda'], 2) }}</td>
          <td class="px-5 py-3 text-center">
            <span class="{{ $c['deuda'] > 0 ? 'badge-vencida' : 'badge-vigente' }} px-2.5 py-1 rounded-full text-[10px] font-bold">
              {{ $c['deuda'] > 0 ? 'Con deuda' : 'Al día' }}
            </span>
          </td>
          <td class="px-5 py-3 text-center">
            <a href="{{ route('admin.contribuyentes.show', $c['id']) }}" class="p-1.5 hover:bg-blue-50 rounded-lg text-mde-mid transition-all inline-block">
              <i class="fa-solid fa-eye text-xs"></i>
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="px-5 py-8 text-center text-gray-400 text-xs">No hay contribuyentes registrados</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
