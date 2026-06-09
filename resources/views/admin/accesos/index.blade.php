@extends('layouts.admin')

@section('title', 'Log de Accesos')
@section('page-title', 'Log de Accesos')

@section('content')
<div class="flex justify-between items-center mb-5 flex-wrap gap-3">
  <div class="relative">
    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    <input type="text" placeholder="Buscar en log de accesos..."
      class="pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-mde-gold w-72 input-gold transition-all"/>
  </div>
  <div class="flex gap-2">
    <select class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold">
      <option value="">Todos los estados</option>
      <option value="exitoso">Exitoso</option>
      <option value="fallido">Fallido</option>
    </select>
  </div>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-mde-light text-mde-navy text-xs font-bold">
        <th class="px-5 py-3 text-left">Fecha/Hora</th>
        <th class="px-5 py-3 text-left">Usuario</th>
        <th class="px-5 py-3 text-center">IP</th>
        <th class="px-5 py-3 text-center">Navegador</th>
        <th class="px-5 py-3 text-center">Estado</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      {{-- TODO: Obtener logs de acceso desde el controlador --}}
      <tr>
        <td colspan="5" class="px-5 py-8 text-center text-gray-400 text-xs">No hay registros de acceso</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
