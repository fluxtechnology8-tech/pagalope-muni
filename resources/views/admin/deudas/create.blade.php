@extends('layouts.admin')

@section('title', 'Nueva Deuda')
@section('page-title', 'Nueva Deuda')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
    {{-- TODO: Formulario de creación de deuda --}}
    <form action="{{ route('admin.deudas.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Contribuyente</label>
        <select name="contribuyente_id" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required>
          <option value="">Seleccionar contribuyente...</option>
          {{-- TODO: Listar contribuyentes --}}
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-xs font-bold text-mde-navy mb-1">Concepto</label>
        <input type="text" name="concepto" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
      </div>

      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-xs font-bold text-mde-navy mb-1">Periodo</label>
          <input type="text" name="periodo" placeholder="Ej: 2025-01" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
        </div>
        <div>
          <label class="block text-xs font-bold text-mde-navy mb-1">Monto (S/)</label>
          <input type="number" name="monto" step="0.01" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold" required/>
        </div>
      </div>

      <div class="mb-6">
        <label class="block text-xs font-bold text-mde-navy mb-1">Estado</label>
        <select name="estado" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm input-gold">
          <option value="pendiente">Pendiente</option>
          <option value="vencida">Vencida</option>
          <option value="pagada">Pagada</option>
        </select>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-primary text-white text-sm font-bold px-6 py-2.5 rounded-xl">
          <span>Guardar deuda</span>
        </button>
        <a href="{{ route('admin.deudas.index') }}" class="text-sm font-semibold text-gray-500 hover:text-mde-navy px-4 py-2.5">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
