@extends('layouts.app')

@section('title', 'Ayuda')

@section('content')
<section class="bg-gradient-to-b from-mde-blue/5 to-transparent pt-12 pb-16 px-4">
  <div class="max-w-3xl mx-auto text-center fade-up delay-2">
    <div class="inline-flex items-center gap-2 bg-mde-gold/10 text-mde-golddark text-xs font-semibold px-4 py-2 rounded-full border border-mde-gold/30 mb-6">
      <i class="fa-solid fa-circle-question text-mde-gold"></i>
      Centro de ayuda
    </div>
    <h2 class="font-heading font-black text-4xl text-mde-navy mb-4 leading-tight">
      ¿Cómo podemos<br/>
      <span class="text-mde-mid">ayudarte?</span>
    </h2>
    <p class="text-gray-500 text-base mb-10 max-w-xl mx-auto font-medium">
      Encuentra respuestas a las preguntas más frecuentes sobre el sistema de consulta y pago de tributos.
    </p>

    {{-- TODO: Contenido de ayuda --}}
    <div class="search-card p-8 fade-up delay-3">
      <p class="text-gray-400 text-sm py-8">
        <i class="fa-solid fa-book-open text-4xl text-mde-gold mb-4 block"></i>
        Centro de ayuda.<br/>
        <span class="text-xs">Próximamente disponible.</span>
      </p>
    </div>
  </div>
</section>
@endsection
