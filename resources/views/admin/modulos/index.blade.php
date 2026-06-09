@extends('layouts.admin')

@section('title', 'Módulos del Sistema')
@section('page-title', 'Módulos del Sistema')

@section('content')
<div class="flex justify-between items-center mb-5">
  <p class="text-sm text-gray-500">Activa, desactiva y crea módulos del sistema</p>
  <a href="{{ route('admin.modulos.create') }}" class="btn-primary text-white text-sm font-bold px-4 py-2.5 rounded-xl inline-flex items-center gap-2 no-underline">
    <i class="fa-solid fa-plus"></i><span>Nuevo módulo</span>
  </a>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="bg-mde-light text-mde-navy">
        <th class="px-5 py-3 text-left font-bold text-xs">Módulo</th>
        <th class="px-5 py-3 text-left font-bold text-xs">Ruta</th>
        <th class="px-5 py-3 text-center font-bold text-xs">Roles con acceso</th>
        <th class="px-5 py-3 text-center font-bold text-xs">Estado</th>
        <th class="px-5 py-3 text-center font-bold text-xs">Acciones</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      {{-- TODO: Obtener módulos desde el controlador --}}
      @php $modulos = []; @endphp

      @forelse($modulos as $mod)
        <tr class="result-row">
          <td class="px-5 py-3">
            <div class="flex items-center gap-3">
              <div class="w-7 h-7 rounded-lg bg-mde-light flex items-center justify-center">
                <i class="{{ $mod['icon'] ?? 'fa-solid fa-puzzle-piece' }} text-mde-mid text-xs"></i>
              </div>
              <span class="font-semibold text-mde-navy">{{ $mod['nombre'] }}</span>
            </div>
          </td>
          <td class="px-5 py-3 text-gray-400 font-mono text-xs">{{ $mod['ruta'] }}</td>
          <td class="px-5 py-3 text-center">
            <div class="flex flex-wrap gap-1 justify-center">
              @foreach(($mod['roles'] ?? []) as $r)
                <span class="text-[10px] bg-blue-50 text-blue-700 font-semibold px-2 py-0.5 rounded-full">{{ $r }}</span>
              @endforeach
            </div>
          </td>
          <td class="px-5 py-3 text-center">
            <span class="{{ ($mod['activo'] ?? false) ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-400' }} px-3 py-1 rounded-full text-xs font-bold">
              <i class="{{ ($mod['activo'] ?? false) ? 'fa-solid fa-toggle-on' : 'fa-solid fa-toggle-off' }} mr-1"></i>
              {{ ($mod['activo'] ?? false) ? 'Activo' : 'Inactivo' }}
            </span>
          </td>
          <td class="px-5 py-3 text-center">
            <div class="flex items-center justify-center gap-2">
              <a href="{{ route('admin.modulos.edit', $mod['id']) }}" class="p-1.5 hover:bg-blue-50 rounded-lg text-mde-mid transition-all">
                <i class="fa-solid fa-pen text-xs"></i>
              </a>
              <form action="{{ route('admin.modulos.destroy', $mod['id']) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este módulo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1.5 hover:bg-red-50 rounded-lg text-gray-400 hover:text-red-500 transition-all">
                  <i class="fa-solid fa-trash text-xs"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="px-5 py-8 text-center text-gray-400 text-xs">No hay módulos creados</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
