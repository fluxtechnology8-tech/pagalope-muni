@extends('layouts.app')

@section('title', 'Ayuda')

@section('content')
<section class="bg-gradient-to-b from-mde-blue/5 to-transparent pt-10 md:pt-12 pb-16 px-4"
         x-data="ayudaFaq()">
  <div class="max-w-3xl mx-auto text-center fade-up delay-2">
    <div class="inline-flex items-center gap-2 bg-mde-gold/10 text-mde-golddark text-xs font-semibold px-4 py-2 rounded-full border border-mde-gold/30 mb-6">
      <i class="fa-solid fa-circle-question text-mde-gold"></i>
      Centro de ayuda
    </div>
    <h2 class="font-heading font-black text-3xl md:text-4xl text-mde-navy mb-4 leading-tight">
      ¿Cómo podemos<br/>
      <span class="text-mde-mid">ayudarte?</span>
    </h2>
    <p class="text-gray-500 text-base mb-10 max-w-xl mx-auto font-medium" x-show="view === 'home'">
      Elige un tema para ver las preguntas frecuentes relacionadas.
    </p>
  </div>

  {{-- ═══════════ VISTA: 4 CATEGORÍAS ═══════════ --}}
  <div x-show="view === 'home'" x-transition class="max-w-4xl mx-auto fade-up delay-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
      <button @click="goTo('consulta')"
              class="group rounded-2xl bg-white border-2 border-gray-100 hover:border-mde-gold shadow-sm hover:shadow-xl transition-all p-8 flex flex-col items-center justify-center gap-4 text-center min-h-[200px] sm:min-h-[240px]">
        <div class="w-16 h-16 rounded-2xl bg-mde-light flex items-center justify-center group-hover:bg-mde-gold/15 transition-colors">
          <i class="fa-solid fa-magnifying-glass text-mde-mid text-2xl"></i>
        </div>
        <div>
          <p class="font-heading font-bold text-mde-navy text-lg">Consultar deuda</p>
          <p class="text-xs text-gray-400 mt-1">4 preguntas frecuentes</p>
        </div>
      </button>

      <button @click="goTo('pago')"
              class="group rounded-2xl bg-white border-2 border-gray-100 hover:border-mde-gold shadow-sm hover:shadow-xl transition-all p-8 flex flex-col items-center justify-center gap-4 text-center min-h-[200px] sm:min-h-[240px]">
        <div class="w-16 h-16 rounded-2xl bg-mde-light flex items-center justify-center group-hover:bg-mde-gold/15 transition-colors">
          <i class="fa-solid fa-credit-card text-mde-mid text-2xl"></i>
        </div>
        <div>
          <p class="font-heading font-bold text-mde-navy text-lg">Pagar en línea</p>
          <p class="text-xs text-gray-400 mt-1">4 preguntas frecuentes</p>
        </div>
      </button>

      <button @click="goTo('fraccionamiento')"
              class="group rounded-2xl bg-white border-2 border-gray-100 hover:border-mde-gold shadow-sm hover:shadow-xl transition-all p-8 flex flex-col items-center justify-center gap-4 text-center min-h-[200px] sm:min-h-[240px]">
        <div class="w-16 h-16 rounded-2xl bg-mde-light flex items-center justify-center group-hover:bg-mde-gold/15 transition-colors">
          <i class="fa-solid fa-file-invoice text-mde-mid text-2xl"></i>
        </div>
        <div>
          <p class="font-heading font-bold text-mde-navy text-lg">Fraccionamiento</p>
          <p class="text-xs text-gray-400 mt-1">3 preguntas frecuentes</p>
        </div>
      </button>

      <button @click="goTo('soporte')"
              class="group rounded-2xl bg-white border-2 border-gray-100 hover:border-mde-gold shadow-sm hover:shadow-xl transition-all p-8 flex flex-col items-center justify-center gap-4 text-center min-h-[200px] sm:min-h-[240px]">
        <div class="w-16 h-16 rounded-2xl bg-mde-light flex items-center justify-center group-hover:bg-mde-gold/15 transition-colors">
          <i class="fa-solid fa-headset text-mde-mid text-2xl"></i>
        </div>
        <div>
          <p class="font-heading font-bold text-mde-navy text-lg">Soporte y accesibilidad</p>
          <p class="text-xs text-gray-400 mt-1">6 preguntas frecuentes</p>
        </div>
      </button>
    </div>
  </div>

  {{-- ═══════════ VISTA: DETALLE DE CATEGORÍA ═══════════ --}}
  <div class="max-w-3xl mx-auto fade-up delay-3">

    {{-- Botón volver, compartido por las 4 categorías --}}
    <button x-show="view !== 'home'" x-cloak @click="goTo('home')"
            class="inline-flex items-center gap-2 text-sm font-semibold text-mde-mid hover:text-mde-navy mb-6 transition-colors">
      <i class="fa-solid fa-arrow-left"></i> Volver a categorías
    </button>

    {{-- Consulta de deuda --}}
    <div x-show="view === 'consulta'" x-cloak x-transition>
      <h3 class="flex items-center gap-2 text-mde-navy font-heading font-bold text-lg mb-3">
        <span class="w-8 h-8 rounded-lg bg-mde-light flex items-center justify-center shrink-0">
          <i class="fa-solid fa-magnifying-glass text-mde-mid text-sm"></i>
        </span>
        Consulta de deuda
      </h3>
      <div class="search-card divide-y divide-gray-100 overflow-hidden">
        @foreach ([
          ['q' => '¿Cómo consulto mi deuda tributaria?', 'a' => 'En la página principal, elige "Persona Natural (DNI)" o "Persona Jurídica (RUC)", ingresa tu número completo y presiona "Consultar". Verás tus deudas pendientes y pagadas, con el detalle de concepto, periodo y monto.'],
          ['q' => '¿Por qué el sistema dice que no encuentra resultados?', 'a' => 'Puede deberse a que el documento no está registrado en la base de contribuyentes, o a un error al digitar el número. Verifica que hayas ingresado los 8 dígitos del DNI o los 11 del RUC sin espacios.'],
          ['q' => '¿Los datos de mi deuda están actualizados?', 'a' => 'Sí, la información se actualiza en tiempo real conforme se registran pagos y nuevas deudas en el sistema municipal.'],
          ['q' => '¿Puedo consultar la deuda de otra persona?', 'a' => 'Puedes consultar cualquier DNI o RUC público, ya que es información tributaria de acceso general. Para trámites o reclamos sobre una deuda, debe hacerlo el titular.'],
        ] as $i => $item)
          <div>
            <button @click="toggle('consulta{{ $i }}')" :aria-expanded="open === 'consulta{{ $i }}'"
                    class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 hover:bg-mde-light/60 transition-colors">
              <span class="font-semibold text-mde-navy text-sm">{{ $item['q'] }}</span>
              <i class="fa-solid fa-chevron-down text-mde-gold text-xs transition-transform shrink-0" :class="open === 'consulta{{ $i }}' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open === 'consulta{{ $i }}'" x-collapse x-cloak class="px-5 pb-4 text-sm text-gray-500 leading-relaxed">
              {{ $item['a'] }}
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Pago en línea --}}
    <div x-show="view === 'pago'" x-cloak x-transition>
      <h3 class="flex items-center gap-2 text-mde-navy font-heading font-bold text-lg mb-3">
        <span class="w-8 h-8 rounded-lg bg-mde-light flex items-center justify-center shrink-0">
          <i class="fa-solid fa-credit-card text-mde-mid text-sm"></i>
        </span>
        Pago en línea
      </h3>
      <div class="search-card divide-y divide-gray-100 overflow-hidden">
        @foreach ([
          ['q' => '¿Qué métodos de pago están disponibles?', 'a' => 'Puedes pagar con tarjeta de crédito o débito (Visa, Mastercard) y próximamente por otros medios digitales. Todos los pagos se procesan a través de una pasarela segura con cifrado SSL.'],
          ['q' => '¿Es seguro pagar por este sistema?', 'a' => 'Sí. La plataforma no almacena los datos de tu tarjeta; estos son procesados directamente por la pasarela de pago certificada, siguiendo estándares de seguridad de la industria.'],
          ['q' => '¿En cuánto tiempo se refleja mi pago?', 'a' => 'El pago se refleja de inmediato en tu estado de cuenta. Recibirás un comprobante electrónico en el correo registrado.'],
          ['q' => '¿Puedo pagar solo una parte de mi deuda?', 'a' => 'Sí, puedes seleccionar y pagar conceptos de deuda de forma individual, o usar la opción "Pagar todo" para cancelar el total pendiente.'],
        ] as $i => $item)
          <div>
            <button @click="toggle('pago{{ $i }}')" :aria-expanded="open === 'pago{{ $i }}'"
                    class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 hover:bg-mde-light/60 transition-colors">
              <span class="font-semibold text-mde-navy text-sm">{{ $item['q'] }}</span>
              <i class="fa-solid fa-chevron-down text-mde-gold text-xs transition-transform shrink-0" :class="open === 'pago{{ $i }}' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open === 'pago{{ $i }}'" x-collapse x-cloak class="px-5 pb-4 text-sm text-gray-500 leading-relaxed">
              {{ $item['a'] }}
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Fraccionamiento --}}
    <div x-show="view === 'fraccionamiento'" x-cloak x-transition>
      <h3 class="flex items-center gap-2 text-mde-navy font-heading font-bold text-lg mb-3">
        <span class="w-8 h-8 rounded-lg bg-mde-light flex items-center justify-center shrink-0">
          <i class="fa-solid fa-file-invoice text-mde-mid text-sm"></i>
        </span>
        Fraccionamiento de deudas
      </h3>
      <div class="search-card divide-y divide-gray-100 overflow-hidden">
        @foreach ([
          ['q' => '¿Qué es el fraccionamiento de deudas?', 'a' => 'Es un beneficio que te permite dividir el pago de tu deuda tributaria en cuotas mensuales accesibles, en lugar de pagar el total de una sola vez.'],
          ['q' => '¿Quiénes pueden solicitarlo?', 'a' => 'Cualquier contribuyente, persona natural o jurídica, con deudas vencidas registradas a su nombre en la municipalidad.'],
          ['q' => '¿Cómo solicito un fraccionamiento?', 'a' => 'Desde la sección "Fraccionamiento" del portal, completa el formulario con tus datos y la deuda a fraccionar. El área de Rentas evaluará tu solicitud y te contactará con la propuesta de cuotas.'],
        ] as $i => $item)
          <div>
            <button @click="toggle('frac{{ $i }}')" :aria-expanded="open === 'frac{{ $i }}'"
                    class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 hover:bg-mde-light/60 transition-colors">
              <span class="font-semibold text-mde-navy text-sm">{{ $item['q'] }}</span>
              <i class="fa-solid fa-chevron-down text-mde-gold text-xs transition-transform shrink-0" :class="open === 'frac{{ $i }}' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open === 'frac{{ $i }}'" x-collapse x-cloak class="px-5 pb-4 text-sm text-gray-500 leading-relaxed">
              {{ $item['a'] }}
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Soporte y accesibilidad --}}
    <div x-show="view === 'soporte'" x-cloak x-transition>
      <h3 class="flex items-center gap-2 text-mde-navy font-heading font-bold text-lg mb-3">
        <span class="w-8 h-8 rounded-lg bg-mde-light flex items-center justify-center shrink-0">
          <i class="fa-solid fa-headset text-mde-mid text-sm"></i>
        </span>
        Soporte y accesibilidad
      </h3>
      <div class="search-card divide-y divide-gray-100 overflow-hidden">
        @foreach ([
          ['q' => 'Olvidé mi número de DNI o RUC, ¿qué hago?', 'a' => 'Puedes verificar tu número de DNI en tu documento de identidad físico o en la app "Mi RENIEC". El RUC puedes consultarlo en el portal de la SUNAT con tu DNI.'],
          ['q' => 'La página no carga o muestra un error', 'a' => 'Intenta recargar la página o probar con otro navegador actualizado (Chrome, Edge, Firefox). Si el problema persiste, contáctanos indicando el mensaje de error que aparece.'],
          ['q' => '¿Cuál es el horario de atención presencial?', 'a' => 'Lunes a viernes de 8:00 a.m. a 4:30 p.m. en Av. Sánchez Carrión Cdra. 18, La Esperanza.'],
          ['q' => '¿Cómo aumento el tamaño de letra del sistema?', 'a' => 'En la esquina inferior derecha de cualquier página encontrarás el botón redondo con el ícono de accesibilidad. Al abrirlo, usa los botones "A−" y "A+" para reducir o aumentar el tamaño del texto en todo el sitio.'],
          ['q' => '¿Puedo dejar activado el alto contraste o el texto grande de forma permanente?', 'a' => 'Sí, tus preferencias de accesibilidad se guardan automáticamente en tu navegador y se aplican cada vez que visites el portal, en cualquier página.'],
          ['q' => '¿Cómo restablezco las opciones de accesibilidad?', 'a' => 'Abre el panel de accesibilidad y presiona "Restablecer valores" para volver al tamaño de letra y contraste por defecto.'],
        ] as $i => $item)
          <div>
            <button @click="toggle('sop{{ $i }}')" :aria-expanded="open === 'sop{{ $i }}'"
                    class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 hover:bg-mde-light/60 transition-colors">
              <span class="font-semibold text-mde-navy text-sm">{{ $item['q'] }}</span>
              <i class="fa-solid fa-chevron-down text-mde-gold text-xs transition-transform shrink-0" :class="open === 'sop{{ $i }}' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open === 'sop{{ $i }}'" x-collapse x-cloak class="px-5 pb-4 text-sm text-gray-500 leading-relaxed">
              {{ $item['a'] }}
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Contacto directo --}}
  <div class="max-w-3xl mx-auto mt-10 fade-up delay-4">
    <div class="rounded-2xl bg-mde-navy text-white p-6 md:p-8 flex flex-col sm:flex-row items-center justify-between gap-5">
      <div class="text-center sm:text-left">
        <p class="font-heading font-bold text-lg mb-1">¿No encontraste tu respuesta?</p>
        <p class="text-blue-200 text-sm">Escríbenos o llámanos y con gusto te ayudamos.</p>
      </div>
      <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <a href="tel:+51044461000" class="btn-gold text-white font-bold px-5 py-2.5 rounded-xl text-sm flex items-center justify-center gap-2 no-underline">
          <i class="fa-solid fa-phone"></i> (044) 461-000
        </a>
        <a href="mailto:tributacion@mde.gob.pe" class="bg-white/10 hover:bg-white/20 text-white font-bold px-5 py-2.5 rounded-xl text-sm flex items-center justify-center gap-2 no-underline border border-white/20 transition-all">
          <i class="fa-solid fa-envelope"></i> Enviar correo
        </a>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
  function ayudaFaq() {
    return {
      view: 'home',
      open: null,
      goTo(view) {
        this.view = view;
        this.open = null;
        window.scrollTo({ top: 0, behavior: 'smooth' });
      },
      toggle(id) {
        this.open = this.open === id ? null : id;
      },
    };
  }
</script>
@endsection
