@extends('layouts.admin')

@section('title', 'Editar Módulo')
@section('page-title', 'Editar Módulo')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de edición de módulo --}}
    <form action="{{ route('admin.modulos.update', $modulo->id ?? 0) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Nombre del módulo</label>
        <input type="text" name="nombre" value="{{ $modulo->nombre ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Ruta URL</label>
        <input type="text" name="ruta" value="{{ $modulo->ruta ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-6">
        <label class="block text-xs font-bold text-mde-navy mb-1">Descripción</label>
        <textarea name="descripcion" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold">{{ $modulo->descripcion ?? '' }}</textarea>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-primary text-white text-sm font-bold px-6 py-2.5 rounded-xl">
          <span>Actualizar módulo</span>
        </button>
        <a href="{{ route('admin.modulos.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
