@extends('layouts.admin')

@section('title', 'Auditoría')
@section('page-title', 'Auditoría')

@section('content')
<div class="flex justify-between items-center mb-5 flex-wrap gap-3">
  <div class="relative">
    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    <input type="text" placeholder="Buscar en auditoría..."
      class="pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-mde-gold w-72 input-gold transition-all"/>
  </div>
  <div class="flex gap-2">
    <select class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold">
      <option value="">Todos los módulos</option>
      {{-- TODO: Listar módulos --}}
    </select>
    <select class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold">
      <option value="">Todas las acciones</option>
      <option value="create">Crear</option>
      <option value="update">Editar</option>
      <option value="delete">Eliminar</option>
    </select>
  </div>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-mde-light text-mde-navy text-xs font-bold">
        <th class="px-5 py-3 text-left">Fecha/Hora</th>
        <th class="px-5 py-3 text-left">Usuario</th>
        <th class="px-5 py-3 text-center">Módulo</th>
        <th class="px-5 py-3 text-center">Acción</th>
        <th class="px-5 py-3 text-left">Detalle</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      {{-- TODO: Obtener registros de auditoría desde el controlador --}}
      <tr>
        <td colspan="5" class="px-5 py-8 text-center text-gray-400 text-xs">No hay registros de auditoría</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
