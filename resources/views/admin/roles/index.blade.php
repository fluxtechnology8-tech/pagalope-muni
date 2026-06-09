@extends('layouts.admin')

@section('title', 'Roles y Permisos')
@section('page-title', 'Roles y Permisos')

@section('content')
<div class="flex justify-between items-center mb-5">
  <p class="text-sm text-gray-500">Gestiona roles y asigna permisos por módulo</p>
  <a href="{{ route('admin.roles.create') }}" class="btn-primary text-white text-sm font-bold px-4 py-2.5 rounded-xl inline-flex items-center gap-2 no-underline">
    <i class="fa-solid fa-plus"></i><span>Nuevo rol</span>
  </a>
</div>

<div class="grid md:grid-cols-3 gap-4">
  {{-- TODO: Obtener roles desde el controlador --}}
  @php $roles = []; @endphp

  @forelse($roles as $rol)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
      <div class="flex items-start justify-between mb-3">
        <div>
          <div class="w-8 h-8 rounded-lg mb-2 flex items-center justify-center" style="background:{{ $rol['bg'] ?? '#F1F5F9' }}">
            <i class="{{ $rol['icon'] ?? 'fa-solid fa-user' }} text-sm" style="color:{{ $rol['color'] ?? '#64748B' }}"></i>
          </div>
          <p class="font-bold text-mde-navy text-sm">{{ $rol['nombre'] }}</p>
          <p class="text-xs text-gray-400 mt-0.5">{{ $rol['usuarios'] ?? 0 }} usuarios</p>
        </div>
        <div class="flex gap-1.5">
          <a href="{{ route('admin.roles.edit', $rol['id']) }}" class="p-1.5 hover:bg-blue-50 rounded-lg text-mde-mid transition-all">
            <i class="fa-solid fa-pen text-xs"></i>
          </a>
          <form action="{{ route('admin.roles.destroy', $rol['id']) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este rol?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-1.5 hover:bg-red-50 rounded-lg text-gray-400 hover:text-red-500 transition-all">
              <i class="fa-solid fa-trash text-xs"></i>
            </button>
          </form>
        </div>
      </div>
      <div class="flex flex-wrap gap-1.5 mt-3">
        @foreach(($rol['permisos'] ?? []) as $p)
          <span class="text-[10px] bg-mde-light text-mde-mid font-semibold px-2 py-0.5 rounded-full">{{ $p }}</span>
        @endforeach
      </div>
    </div>
  @empty
    <div class="col-span-3 bg-white rounded-xl border border-gray-100 shadow-sm p-8 text-center">
      <p class="text-gray-400 text-sm">No hay roles creados</p>
    </div>
  @endforelse
</div>
@endsection
