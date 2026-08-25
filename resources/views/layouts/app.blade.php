<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Consulta y Pago de Deudas - MDContribuyente</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logoMuni.png') }}"/>
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/logoMuni.png') }}"/>
  <link rel="apple-touch-icon" href="{{ asset('images/logoMuni.png') }}"/>
  <script>
    (function () {
      try {
        var html = document.documentElement;
        html.setAttribute('data-a11y-font', localStorage.getItem('mde_a11y_font') || '0');
        html.setAttribute('data-a11y-contrast', localStorage.getItem('mde_a11y_contrast') || 'off');
        html.setAttribute('data-a11y-underline', localStorage.getItem('mde_a11y_underline') || 'off');
      } catch (e) {}
    })();
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Crimson+Pro:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet"/>
  <script>
    tailwind.config = {
      theme: {
        screens: {
          'xs': '420px',
          'sm': '640px',
          'md': '768px',
          'lg': '1024px',
          'xl': '1280px',
          '2xl': '1536px',
        },
        extend: {
          colors: {
            mde: {
              navy:   '#0B2447',
              blue:   '#19376D',
              mid:    '#146C94',
              sky:    '#1E90CF',
              gold:   '#C9A84C',
              golddark:'#A8853A',
              goldlt: '#F0D080',
              cream:  '#FDF6E3',
              light:  '#EEF4FB',
            }
          },
          fontFamily: {
            heading: ['Montserrat', 'sans-serif'],
            serif:   ['Crimson Pro', 'serif'],
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Montserrat', sans-serif; }
    .header-bg {
      background: linear-gradient(135deg, #0B2447 0%, #19376D 50%, #146C94 100%);
      position: relative;
      overflow: hidden;
    }
    .header-bg::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        radial-gradient(circle at 20% 50%, rgba(201,168,76,0.12) 0%, transparent 60%),
        radial-gradient(circle at 80% 20%, rgba(30,144,207,0.15) 0%, transparent 50%);
    }
    .header-bg::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 4px;
      background: linear-gradient(90deg, #C9A84C, #F0D080, #C9A84C);
    }
    .escudo {
      width: 64px; height: 64px;
      background: linear-gradient(135deg, #C9A84C, #F0D080);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 28px;
      box-shadow: 0 0 0 3px rgba(201,168,76,0.35), 0 4px 20px rgba(0,0,0,0.3);
      flex-shrink: 0;
    }
    .search-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(11,36,71,0.18), 0 4px 16px rgba(11,36,71,0.1);
      border: 1px solid rgba(201,168,76,0.2);
    }
    .input-gold:focus {
      outline: none;
      border-color: #C9A84C;
      box-shadow: 0 0 0 3px rgba(201,168,76,0.2);
    }
    .btn-primary {
      background: linear-gradient(135deg, #0B2447, #19376D);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .btn-primary::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, #19376D, #146C94);
      opacity: 0;
      transition: opacity 0.3s;
    }
    .btn-primary:hover::after { opacity: 1; }
    .btn-primary span { position: relative; z-index: 1; }
    .btn-gold {
      background: linear-gradient(135deg, #C9A84C, #A8853A);
      transition: all 0.3s ease;
    }
    .btn-gold:hover {
      background: linear-gradient(135deg, #A8853A, #8B6B2A);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(201,168,76,0.4);
    }
    .stat-card {
      background: white;
      border-radius: 16px;
      border: 1px solid #E8F0F7;
      transition: all 0.3s ease;
    }
    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 36px rgba(11,36,71,0.12);
      border-color: rgba(201,168,76,0.3);
    }
    .badge-vencida { background: #FEE2E2; color: #B91C1C; }
    .badge-vigente  { background: #DCFCE7; color: #166534; }
    .badge-fraccion { background: #FEF3C7; color: #92400E; }
    .result-row { transition: background 0.2s; }
    .result-row:hover { background: #EEF4FB; }
    .gold-line {
      height: 3px;
      background: linear-gradient(90deg, transparent, #C9A84C, transparent);
      border: none;
    }
    .nav-link {
      position: relative;
      transition: color 0.2s;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px; left: 0; right: 0;
      height: 2px;
      background: #C9A84C;
      transform: scaleX(0);
      transition: transform 0.25s;
    }
    .nav-link:hover::after { transform: scaleX(1); }
    @keyframes fadeUp {
      from { opacity:0; transform: translateY(20px); }
      to   { opacity:1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.5s ease forwards; }
    .delay-1 { animation-delay: 0.1s; opacity: 0; }
    .delay-2 { animation-delay: 0.2s; opacity: 0; }
    .delay-3 { animation-delay: 0.3s; opacity: 0; }
    .delay-4 { animation-delay: 0.4s; opacity: 0; }
    html { scroll-behavior: smooth; }
    @keyframes pulse-gold {
      0%, 100% { box-shadow: 0 0 0 0 rgba(201,168,76, 0.4); }
      50%       { box-shadow: 0 0 0 8px rgba(201,168,76, 0); }
    }
    .pulse-gold { animation: pulse-gold 2s infinite; }
    [x-cloak] { display: none !important; }
    :focus-visible {
      outline: 3px solid #C9A84C;
      outline-offset: 2px;
      border-radius: 4px;
    }

    /* ═══════════ ACCESIBILIDAD ═══════════ */
    html[data-a11y-font="1"] { font-size: 112.5%; }
    html[data-a11y-font="2"] { font-size: 125%; }
    html[data-a11y-font="3"] { font-size: 140%; }
    html[data-a11y-contrast="on"] { filter: contrast(1.35) saturate(1.15); }
    html[data-a11y-contrast="on"] :focus-visible { outline-width: 4px; }
    html[data-a11y-underline="on"] a { text-decoration: underline !important; text-underline-offset: 3px; }
    .a11y-toggle { width: 2.5rem; height: 1.5rem; border-radius: 9999px; position: relative; transition: background-color .2s; cursor: pointer; flex-shrink: 0; }
    .a11y-toggle-dot { position: absolute; top: 2px; left: 2px; width: 1.25rem; height: 1.25rem; background: white; border-radius: 9999px; box-shadow: 0 1px 3px rgba(0,0,0,0.3); transition: transform .2s; }
  </style>
  @yield('styles')
</head>
<body class="bg-mde-light min-h-screen">

  @php
    $navItems = [
      'portal.index' => ['label' => 'Consultar deuda', 'icon' => 'fa-magnifying-glass', 'url' => route('portal.index')],
      'portal.pago' => ['label' => 'Pagar en línea', 'icon' => 'fa-credit-card', 'url' => route('portal.pago')],
      'portal.fraccionamiento' => ['label' => 'Fraccionamiento', 'icon' => 'fa-file-invoice', 'url' => route('portal.fraccionamiento')],
      'portal.ayuda' => ['label' => 'Ayuda', 'icon' => 'fa-circle-question', 'url' => route('portal.ayuda')],
    ];
    $currentRoute = request()->route()?->getName();
    $currentSection = $navItems[$currentRoute] ?? null;
  @endphp

  {{-- ═══════════ TOPBAR INSTITUCIONAL ═══════════ --}}
  <div class="bg-mde-navy text-white text-xs py-2 px-4 flex justify-between items-center gap-2">
    <div class="flex items-center gap-4 min-w-0">
      <span class="flex items-center gap-1.5 opacity-75 truncate">
        <i class="fa-solid fa-clock text-mde-goldlt shrink-0"></i>
        <span class="hidden xs:inline">Lun–Vie: 8:00am – 4:30pm</span>
      </span>
      <span class="hidden sm:flex items-center gap-1.5 opacity-75 shrink-0">
        <i class="fa-solid fa-phone text-mde-goldlt"></i>
        (044) 461-000
      </span>
    </div>
    <div class="flex items-center gap-2 sm:gap-4 shrink-0">
      <span class="opacity-60">Municipalidad Distrital de La Esperanza</span>
    </div>
  </div>

  {{-- ═══════════ HEADER PRINCIPAL ═══════════ --}}
  <header class="header-bg text-white relative" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 py-6 md:py-8 relative z-10">
      <div class="flex items-center justify-between gap-4 md:gap-6">
        {{-- Logo + Nombre --}}
        <a href="{{ route('portal.index') }}" class="flex items-center gap-3 md:gap-4 fade-up no-underline min-w-0">
          <div class="escudo w-12 h-12 md:w-16 md:h-16 text-xl md:text-2xl">
            <img src="{{ asset('images/logoMuni.png') }}" alt="logo" class="w-full h-full object-cover rounded-full">
          </div>
          <div class="min-w-0">
            <p class="text-mde-goldlt text-[10px] md:text-xs font-semibold tracking-widest uppercase mb-0.5 truncate">
              Municipalidad Distrital de La Esperanza
            </p>
            <h1 class="font-heading font-black text-xl md:text-3xl tracking-tight leading-none text-white">
              MDE<span class="text-mde-gold">Contribuyente</span>
            </h1>
            <p class="text-blue-200 text-[11px] md:text-xs mt-1 font-medium hidden sm:block">
              Sistema de Consulta y Pago de Deudas Tributarias
            </p>
          </div>
        </a>

        {{-- Nav desktop --}}
        <nav class="hidden md:flex items-center gap-1 fade-up delay-1" aria-label="Navegación principal">
          @foreach ($navItems as $name => $item)
            <a href="{{ $item['url'] }}"
               aria-current="{{ $currentRoute === $name ? 'page' : 'false' }}"
               class="nav-link text-sm font-medium px-4 py-2 rounded-full transition-all {{ $currentRoute === $name ? 'bg-white/15 text-white' : 'text-white/85 hover:text-white' }}">
              <i class="fa-solid {{ $item['icon'] }} mr-1.5 text-mde-goldlt"></i>
              {{ $item['label'] }}
            </a>
          @endforeach
        </nav>

        {{-- Botón menú móvil --}}
        <button @click="mobileOpen = !mobileOpen"
                :aria-expanded="mobileOpen.toString()"
                aria-label="Abrir menú de navegación"
                class="md:hidden w-11 h-11 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all shrink-0">
          <i class="fa-solid text-lg" :class="mobileOpen ? 'fa-xmark' : 'fa-bars'"></i>
        </button>
      </div>

      {{-- Nav móvil --}}
      <nav x-show="mobileOpen" x-transition x-cloak
           class="md:hidden mt-4 flex flex-col gap-1"
           aria-label="Navegación principal móvil">
        @foreach ($navItems as $name => $item)
          <a href="{{ $item['url'] }}"
             @click="mobileOpen = false"
             aria-current="{{ $currentRoute === $name ? 'page' : 'false' }}"
             class="flex items-center gap-3 text-sm font-medium px-4 py-3 rounded-xl transition-all {{ $currentRoute === $name ? 'bg-white/15 text-white' : 'text-white/85 hover:bg-white/10' }}">
            <i class="fa-solid {{ $item['icon'] }} text-mde-goldlt w-4"></i>
            {{ $item['label'] }}
          </a>
        @endforeach
      </nav>

      {{-- Indicador de sección actual --}}
      @if ($currentSection)
        <div class="flex items-center gap-2 text-xs font-semibold text-mde-goldlt border-t border-white/15 mt-5 pt-3">
          <i class="fa-solid fa-location-arrow text-[10px]"></i>
          <span class="opacity-75 font-medium">Estás en:</span>
          <i class="fa-solid {{ $currentSection['icon'] }}"></i>
          <span class="text-white">{{ $currentSection['label'] }}</span>
        </div>
      @endif
    </div>
  </header>

  {{-- ═══════════ CONTENIDO PRINCIPAL ═══════════ --}}
  <main>
    @yield('content')
  </main>

  {{-- ═══════════ FOOTER ═══════════ --}}
  <footer class="bg-mde-navy text-white mt-4">
    <div class="max-w-7xl mx-auto px-4 py-10">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-mde-gold/20 flex items-center justify-center">
              <i class="fa-solid fa-landmark text-mde-goldlt"></i>
            </div>
            <div>
              <p class="font-black text-sm">MDE<span class="text-mde-gold">Contribuyente</span></p>
              <p class="text-xs text-blue-300">La Esperanza, La Libertad</p>
            </div>
          </div>
          <p class="text-xs text-blue-300 leading-relaxed">
            Sistema oficial de consulta y pago de tributos de la Municipalidad Distrital de La Esperanza.
          </p>
        </div>
        <div>
          <p class="text-xs font-bold text-mde-goldlt tracking-wider uppercase mb-4">Servicios</p>
          <ul class="space-y-2 text-xs text-blue-300">
            <li><a href="{{ route('portal.index') }}" class="hover:text-mde-goldlt transition-colors"><i class="fa-solid fa-chevron-right text-mde-gold mr-2 text-[10px]"></i>Consulta de deudas</a></li>
            <li><a href="{{ route('portal.pago') }}" class="hover:text-mde-goldlt transition-colors"><i class="fa-solid fa-chevron-right text-mde-gold mr-2 text-[10px]"></i>Pago en línea</a></li>
            <li><a href="{{ route('portal.fraccionamiento') }}" class="hover:text-mde-goldlt transition-colors"><i class="fa-solid fa-chevron-right text-mde-gold mr-2 text-[10px]"></i>Fraccionamiento de deudas</a></li>
            <li><a href="#" class="hover:text-mde-goldlt transition-colors"><i class="fa-solid fa-chevron-right text-mde-gold mr-2 text-[10px]"></i>Certificado de no adeudo</a></li>
          </ul>
        </div>
        <div>
          <p class="text-xs font-bold text-mde-goldlt tracking-wider uppercase mb-4">Contacto</p>
          <ul class="space-y-2 text-xs text-blue-300">
            <li class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-mde-gold w-4"></i>Av. Sánchez Carrión Cdra. 18, La Esperanza</li>
            <li class="flex items-center gap-2"><i class="fa-solid fa-phone text-mde-gold w-4"></i>(044) 461-000</li>
            <li class="flex items-center gap-2"><i class="fa-solid fa-envelope text-mde-gold w-4"></i>tributacion@mde.gob.pe</li>
          </ul>
        </div>
      </div>
      <hr class="gold-line mt-8 mb-4"/>
      <p class="text-center text-xs text-blue-400">&copy; {{ date('Y') }} Municipalidad Distrital de La Esperanza — MDEContribuyente v1.0</p>
    </div>
  </footer>

  {{-- ═══════════ PANEL DE ACCESIBILIDAD ═══════════ --}}
  <div x-data="a11yPanel()" x-init="init()" @keydown.escape.window="open = false" class="fixed bottom-5 right-4 md:right-6 z-50">
    <button @click="open = !open"
            :aria-expanded="open.toString()"
            aria-label="Opciones de accesibilidad"
            class="w-14 h-14 rounded-full bg-mde-navy text-white shadow-2xl flex items-center justify-center text-xl border-2 border-mde-gold hover:bg-mde-blue transition-all pulse-gold">
      <i class="fa-solid fa-universal-access"></i>
    </button>

    <div x-show="open" x-transition x-cloak @click.outside="open = false"
         class="absolute bottom-[4.5rem] right-0 w-[19rem] max-w-[calc(100vw-2rem)] bg-white rounded-2xl shadow-2xl border border-gray-100 p-5"
         role="dialog" aria-label="Panel de accesibilidad">
      <div class="flex items-center justify-between mb-4">
        <p class="font-bold text-mde-navy text-sm flex items-center gap-2">
          <i class="fa-solid fa-universal-access text-mde-gold"></i> Accesibilidad
        </p>
        <button @click="open = false" aria-label="Cerrar panel" class="text-gray-400 hover:text-gray-600 w-7 h-7 flex items-center justify-center">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="mb-4">
        <p class="text-xs font-semibold text-gray-500 mb-2">Tamaño de letra</p>
        <div class="flex items-center gap-2">
          <button @click="setFont(-1)" :disabled="font === 0" aria-label="Reducir tamaño de letra"
                  class="flex-1 py-2 rounded-lg border-2 border-gray-200 font-bold text-sm hover:border-mde-gold disabled:opacity-30 disabled:cursor-not-allowed transition-all">
            A−
          </button>
          <span class="text-xs font-bold text-mde-navy w-12 text-center" x-text="['100%','112%','125%','140%'][font]"></span>
          <button @click="setFont(1)" :disabled="font === 3" aria-label="Aumentar tamaño de letra"
                  class="flex-1 py-2 rounded-lg border-2 border-gray-200 font-bold text-sm hover:border-mde-gold disabled:opacity-30 disabled:cursor-not-allowed transition-all">
            A+
          </button>
        </div>
      </div>

      <div class="flex items-center justify-between mb-3">
        <label for="a11y-contrast" class="text-xs font-semibold text-gray-600">Alto contraste</label>
        <span id="a11y-contrast" role="switch" tabindex="0" :aria-checked="contrast.toString()"
              @click="toggleContrast()" @keydown.enter="toggleContrast()" @keydown.space.prevent="toggleContrast()"
              class="a11y-toggle" :class="contrast ? 'bg-mde-mid' : 'bg-gray-200'">
          <span class="a11y-toggle-dot" :style="contrast ? 'transform:translateX(1rem)' : ''"></span>
        </span>
      </div>

      <div class="flex items-center justify-between mb-4">
        <label for="a11y-underline" class="text-xs font-semibold text-gray-600">Subrayar enlaces</label>
        <span id="a11y-underline" role="switch" tabindex="0" :aria-checked="underline.toString()"
              @click="toggleUnderline()" @keydown.enter="toggleUnderline()" @keydown.space.prevent="toggleUnderline()"
              class="a11y-toggle" :class="underline ? 'bg-mde-mid' : 'bg-gray-200'">
          <span class="a11y-toggle-dot" :style="underline ? 'transform:translateX(1rem)' : ''"></span>
        </span>
      </div>

      <button @click="reset()" class="w-full text-xs font-semibold text-gray-400 hover:text-mde-navy py-2 border-t border-gray-100 transition-colors">
        Restablecer valores
      </button>
    </div>
  </div>

  <script>
    function a11yPanel() {
      return {
        open: false,
        font: 0,
        contrast: false,
        underline: false,
        init() {
          this.font = parseInt(document.documentElement.getAttribute('data-a11y-font') || '0', 10);
          this.contrast = document.documentElement.getAttribute('data-a11y-contrast') === 'on';
          this.underline = document.documentElement.getAttribute('data-a11y-underline') === 'on';
        },
        setFont(delta) {
          this.font = Math.min(3, Math.max(0, this.font + delta));
          document.documentElement.setAttribute('data-a11y-font', this.font);
          localStorage.setItem('mde_a11y_font', this.font);
        },
        toggleContrast() {
          this.contrast = !this.contrast;
          document.documentElement.setAttribute('data-a11y-contrast', this.contrast ? 'on' : 'off');
          localStorage.setItem('mde_a11y_contrast', this.contrast ? 'on' : 'off');
        },
        toggleUnderline() {
          this.underline = !this.underline;
          document.documentElement.setAttribute('data-a11y-underline', this.underline ? 'on' : 'off');
          localStorage.setItem('mde_a11y_underline', this.underline ? 'on' : 'off');
        },
        reset() {
          this.font = 0;
          this.contrast = false;
          this.underline = false;
          document.documentElement.setAttribute('data-a11y-font', '0');
          document.documentElement.setAttribute('data-a11y-contrast', 'off');
          document.documentElement.setAttribute('data-a11y-underline', 'off');
          localStorage.removeItem('mde_a11y_font');
          localStorage.removeItem('mde_a11y_contrast');
          localStorage.removeItem('mde_a11y_underline');
        },
      };
    }
  </script>

  @yield('scripts')
</body>
</html>
