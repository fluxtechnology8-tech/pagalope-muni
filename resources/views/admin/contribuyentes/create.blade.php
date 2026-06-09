@extends('layouts.admin')

@section('title', 'Nuevo Contribuyente')
@section('page-title', 'Nuevo Contribuyente')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de creación de contribuyente --}}
    <form action="{{ route('admin.contribuyentes.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Tipo de documento</label>
        <select name="tipo_doc" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold">
          <option value="dni">DNI</option>
          <option value="ruc">RUC</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Número de documento</label>
        <input type="text" name="num_doc" maxlength="11" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Nombre completo</label>
        <input type="text" name="nombre" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Dirección</label>
        <input type="text" name="direccion" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold"/>
      </div>

      <div class="mb-6">
        <label class="block text-xs font-bold text-mde-navy mb-1">Teléfono</label>
        <input type="text" name="telefono" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold"/>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-primary text-white text-sm font-bold px-6 py-2.5 rounded-xl">
          <span>Guardar contribuyente</span>
        </button>
        <a href="{{ route('admin.contribuyentes.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
