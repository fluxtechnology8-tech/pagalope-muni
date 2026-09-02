@extends('layouts.app')

@section('title', 'Acceso CONTRIBUYENTE')

@section('content')
<section class="bg-gradient-to-b from-mde-blue/5 to-transparent pt-12 pb-16 px-4">
  <div class="max-w-md mx-auto text-center fade-up delay-2">
    <div class="inline-flex items-center gap-2 bg-mde-gold/10 text-mde-golddark text-xs font-semibold px-4 py-2 rounded-full border border-mde-gold/30 mb-6">
      <i class="fa-solid fa-shield-halved text-mde-gold"></i>
      Acceso restringido
    </div>
    <h2 class="font-heading font-black text-3xl text-mde-navy mb-4 leading-tight">
      Acceso<span class="text-mde-gold"> CONTRIBUYENTE</span>
    </h2>
    <p class="text-gray-500 text-sm mb-8 max-w-sm mx-auto font-medium">
      Municipalidad Distrital de La Esperanza
    </p>

    <div class="search-card p-8 fade-up delay-3">
      <form method="POST" action="{{ route('contribuyentes.login.post') }}">
        @csrf
        <div class="text-left mb-4">
          <label class="block text-xs font-bold text-mde-navy mb-1">Usuario</label>
          <input type="text" name="email" placeholder="usuario@mde.gob.pe"
            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm input-gold transition-all" required/>
        </div>
        <div class="text-left mb-6">
          <label class="block text-xs font-bold text-mde-navy mb-1">Contraseña</label>
          <input type="password" name="password" placeholder="••••••••"
            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm input-gold transition-all" required/>
        </div>

        @if($errors->any())
          <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600">
            {{ $errors->first() }}
          </div>
        @endif

        <button type="submit" class="btn-primary text-white w-full py-3 rounded-xl font-bold text-sm">
          <span class="flex items-center justify-center gap-2">
            <i class="fa-solid fa-right-to-bracket"></i>
            Ingresar
          </span>
        </button>
      </form>
    </div>
  </div>
</section>
@endsection
