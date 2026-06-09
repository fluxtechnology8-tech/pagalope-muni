@extends('layouts.admin')

@section('title', 'Editar Usuario')
@section('page-title', 'Editar Usuario')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de edición de usuario admin --}}
    <form action="{{ route('admin.usuarios.update', $usuario->id ?? 0) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Nombre completo</label>
        <input type="text" name="name" value="{{ $usuario->name ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Email</label>
        <input type="email" name="email" value="{{ $usuario->email ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Contraseña (dejar vacío para no cambiar)</label>
        <input type="password" name="password" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold"/>
      </div>

      <div class="mb-6">
        <label class="block text-xs font-bold text-mde-navy mb-1">Rol</label>
        <select name="rol_id" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required>
          <option value="">Seleccionar rol...</option>
          {{-- TODO: Listar roles --}}
        </select>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-primary text-white text-sm font-bold px-6 py-2.5 rounded-xl">
          <span>Actualizar usuario</span>
        </button>
        <a href="{{ route('admin.usuarios.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
