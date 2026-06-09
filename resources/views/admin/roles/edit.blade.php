@extends('layouts.admin')

@section('title', 'Editar Rol')
@section('page-title', 'Editar Rol')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de edición de rol --}}
    <form action="{{ route('admin.roles.update', $rol->id ?? 0) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Nombre del rol</label>
        <input type="text" name="nombre" value="{{ $rol->nombre ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-6">
        <label class="block text-xs font-bold text-mde-navy mb-1">Descripción</label>
        <textarea name="descripcion" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold">{{ $rol->descripcion ?? '' }}</textarea>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-primary text-white text-sm font-bold px-6 py-2.5 rounded-xl">
          <span>Actualizar rol</span>
        </button>
        <a href="{{ route('admin.roles.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
