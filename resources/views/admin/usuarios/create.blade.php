@extends('layouts.admin')

@section('title', 'Nuevo Usuario')
@section('page-title', 'Nuevo Usuario')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de creación de usuario admin --}}
    <form action="{{ route('admin.usuarios.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Nombre completo</label>
        <input type="text" name="name" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Email</label>
        <input type="email" name="email" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Contraseña</label>
        <input type="password" name="password" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
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
          <span>Crear usuario</span>
        </button>
        <a href="{{ route('admin.usuarios.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
