@extends('layouts.admin')

@section('title', 'Nuevo Rol')
@section('page-title', 'Nuevo Rol')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de creación de rol --}}
    <form action="{{ route('admin.roles.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Nombre del rol</label>
        <input type="text" name="nombre" placeholder="Ej: Supervisor de Cobranza" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-6">
        <label class="block text-xs font-bold text-mde-navy mb-1">Descripción</label>
        <textarea name="descripcion" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold"></textarea>
      </div>

      {{-- TODO: Agregar checkboxes de permisos por módulo --}}

      <div class="flex gap-3">
        <button type="submit" class="btn-primary text-white text-sm font-bold px-6 py-2.5 rounded-xl">
          <span>Crear rol</span>
        </button>
        <a href="{{ route('admin.roles.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
