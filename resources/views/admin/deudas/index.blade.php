@extends('layouts.admin')

@section('title', 'Deudas')
@section('page-title', 'Deudas')

@section('content')
<div class="flex justify-between items-center mb-5 flex-wrap gap-3">
  <div class="relative">
    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    <input type="text" placeholder="Buscar deudas..."
      class="pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-mde-gold w-72 input-gold transition-all"/>
  </div>
  <a href="{{ route('admin.deudas.create') }}" class="btn-primary text-white text-sm font-bold px-4 py-2.5 rounded-xl inline-flex items-center gap-2 no-underline">
    <i class="fa-solid fa-plus"></i><span>Nueva deuda</span>
  </a>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-mde-light text-mde-navy text-xs font-bold">
        <th class="px-5 py-3 text-left">Contribuyente</th>
        <th class="px-5 py-3 text-left">Concepto</th>
        <th class="px-5 py-3 text-center">Periodo</th>
        <th class="px-5 py-3 text-right">Monto</th>
        <th class="px-5 py-3 text-center">Estado</th>
        <th class="px-5 py-3 text-center">Acc.</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      {{-- TODO: Obtener deudas desde el controlador --}}
      <tr>
        <td colspan="6" class="px-5 py-8 text-center text-gray-400 text-xs">No hay deudas registradas</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
