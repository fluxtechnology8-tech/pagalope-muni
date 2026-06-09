@extends('layouts.admin')

@section('title', 'Usuarios Admin')
@section('page-title', 'Usuarios Admin')

@section('content')
<div class="flex justify-between items-center mb-5 flex-wrap gap-3">
  <div class="relative">
    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
    <input type="text" placeholder="Buscar usuarios..."
      class="pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-mde-gold w-72 input-gold transition-all"/>
  </div>
  <a href="{{ route('admin.usuarios.create') }}" class="btn-primary text-white text-sm font-bold px-4 py-2.5 rounded-xl inline-flex items-center gap-2 no-underline">
    <i class="fa-solid fa-plus"></i><span>Nuevo usuario</span>
  </a>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-mde-light text-mde-navy text-xs font-bold">
        <th class="px-5 py-3 text-left">Usuario</th>
        <th class="px-5 py-3 text-center">Email</th>
        <th class="px-5 py-3 text-center">Rol</th>
        <th class="px-5 py-3 text-center">Estado</th>
        <th class="px-5 py-3 text-center">Acciones</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      {{-- TODO: Obtener usuarios desde el controlador --}}
      @php $usuarios = []; @endphp

      @forelse($usuarios as $u)
        <tr class="result-row">
          <td class="px-5 py-3">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-full bg-mde-light flex items-center justify-center text-xs font-bold text-mde-mid">{{ $u['iniciales'] }}</div>
              <span class="font-semibold text-mde-navy text-xs">{{ $u['nombre'] }}</span>
            </div>
          </td>
          <td class="px-5 py-3 text-center text-gray-600 text-xs">{{ $u['email'] }}</td>
          <td class="px-5 py-3 text-center">
            <span class="text-[10px] bg-blue-50 text-blue-700 font-semibold px-2 py-0.5 rounded-full">{{ $u['rol'] }}</span>
          </td>
          <td class="px-5 py-3 text-center">
            <span class="{{ ($u['activo'] ?? true) ? 'badge-vigente' : 'bg-gray-100 text-gray-400' }} px-2.5 py-1 rounded-full text-[10px] font-bold">
              {{ ($u['activo'] ?? true) ? 'Activo' : 'Inactivo' }}
            </span>
          </td>
          <td class="px-5 py-3 text-center">
            <div class="flex items-center justify-center gap-2">
              <a href="{{ route('admin.usuarios.edit', $u['id']) }}" class="p-1.5 hover:bg-blue-50 rounded-lg text-mde-mid transition-all">
                <i class="fa-solid fa-pen text-xs"></i>
              </a>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="px-5 py-8 text-center text-gray-400 text-xs">No hay usuarios registrados</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
