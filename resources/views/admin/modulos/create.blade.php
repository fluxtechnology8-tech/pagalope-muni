@extends('layouts.admin')

@section('title', 'Nuevo Módulo')
@section('page-title', 'Nuevo Módulo')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de creación de módulo --}}
    <form action="{{ route('admin.modulos.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Nombre del módulo</label>
        <input type="text" name="nombre" placeholder="Ej: Fiscalización" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Ruta URL</label>
        <input type="text" name="ruta" placeholder="/admin/fiscalizacion" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-6">
        <label class="block text-xs font-bold text-mde-navy mb-1">Descripción</label>
        <textarea name="descripcion" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold"></textarea>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-primary text-white text-sm font-bold px-6 py-2.5 rounded-xl">
          <span>Crear módulo</span>
        </button>
        <a href="{{ route('admin.modulos.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
