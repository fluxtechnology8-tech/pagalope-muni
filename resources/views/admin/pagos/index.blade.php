@extends('layouts.admin')

@section('title', 'Pagos')
@section('page-title', 'Pagos')

@section('content')
<div class="flex justify-between items-center mb-5 flex-wrap gap-3">
  <div class="relative">
    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    <input type="text" placeholder="Buscar pagos..."
      class="pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-mde-gold w-72 input-gold transition-all"/>
  </div>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-mde-light text-mde-navy text-xs font-bold">
        <th class="px-5 py-3 text-left">Contribuyente</th>
        <th class="px-5 py-3 text-left">Concepto</th>
        <th class="px-5 py-3 text-center">Fecha</th>
        <th class="px-5 py-3 text-right">Monto</th>
        <th class="px-5 py-3 text-center">Comprobante</th>
        <th class="px-5 py-3 text-center">Acc.</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      {{-- TODO: Obtener pagos desde el controlador --}}
      <tr>
        <td colspan="6" class="px-5 py-8 text-center text-gray-400 text-xs">No hay pagos registrados</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
