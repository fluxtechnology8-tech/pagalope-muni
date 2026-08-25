@extends('layouts.app')

@section('title', 'Pagar en Línea')

@section('content')
<section class="bg-gradient-to-b from-mde-blue/5 to-transparent pt-12 pb-16 px-4">
  <div class="max-w-3xl mx-auto text-center fade-up delay-2">
    <div class="inline-flex items-center gap-2 bg-mde-gold/10 text-mde-golddark text-xs font-semibold px-4 py-2 rounded-full border border-mde-gold/30 mb-6">
      <i class="fa-solid fa-shield-halved text-mde-gold"></i>
      Pasarela de pago segura
    </div>
    <h2 class="font-heading font-black text-3xl md:text-4xl text-mde-navy mb-4 leading-tight">
      Pago en línea<br/>
      <span class="text-mde-mid">de tus tributos</span>
    </h2>
    <p class="text-gray-500 text-base mb-10 max-w-xl mx-auto font-medium">
      Realiza el pago de tus deudas tributarias de forma rápida y segura.
    </p>

    {{-- TODO: Formulario de pago - integrar con pasarela de pago --}}
    <div class="search-card p-8 fade-up delay-3">
      <p class="text-gray-400 text-sm py-8">
        <i class="fa-solid fa-credit-card text-4xl text-mde-gold mb-4 block"></i>
        Módulo de pago en línea.<br/>
        <span class="text-xs">Próximamente disponible.</span>
      </p>
    </div>
  </div>
</section>
@endsection
