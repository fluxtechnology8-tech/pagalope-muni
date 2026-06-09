<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'MDEContribuyente') — Municipalidad Distrital de La Esperanza</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Crimson+Pro:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet"/>
  <script>
    tailwind.config = {
      theme: {
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
  </style>
  @yield('styles')
</head>
<body class="bg-mde-light min-h-screen">

  {{-- ═══════════ TOPBAR INSTITUCIONAL ═══════════ --}}
  <div class="bg-mde-navy text-white text-xs py-2 px-4 flex justify-between items-center">
    <div class="flex items-center gap-4">
      <span class="flex items-center gap-1.5 opacity-75">
        <i class="fa-solid fa-clock text-mde-goldlt"></i>
        Lun–Vie: 8:00am – 4:30pm
      </span>
      <span class="hidden sm:flex items-center gap-1.5 opacity-75">
        <i class="fa-solid fa-phone text-mde-goldlt"></i>
        (044) 461-000
      </span>
    </div>
    <div class="flex items-center gap-4">
      <span class="opacity-60">Municipalidad Distrital de La Esperanza</span>
      <a href="{{ route('admin.login') }}" class="flex items-center gap-1.5 bg-mde-gold/20 hover:bg-mde-gold/40 px-3 py-1 rounded-full transition-all text-mde-goldlt font-medium">
        <i class="fa-solid fa-shield-halved"></i>
        Acceso Admin
      </a>
    </div>
  </div>

  {{-- ═══════════ HEADER PRINCIPAL ═══════════ --}}
  <header class="header-bg text-white relative">
    <div class="max-w-7xl mx-auto px-4 py-8 relative z-10">
      <div class="flex items-center justify-between gap-6 flex-wrap">
        {{-- Logo + Nombre --}}
        <a href="{{ route('portal.index') }}" class="flex items-center gap-4 fade-up no-underline">
          <div class="escudo">
            <img src="{{ asset('images/logoMuni.png') }}" alt="logo" class="w-full h-full object-cover rounded-full">
          </div>
          <div>
            <p class="text-mde-goldlt text-xs font-semibold tracking-widest uppercase mb-0.5">
              Municipalidad Distrital de La Esperanza
            </p>
            <h1 class="font-heading font-black text-3xl tracking-tight leading-none text-white">
              MDE<span class="text-mde-gold">Contribuyente</span>
            </h1>
            <p class="text-blue-200 text-xs mt-1 font-medium">
              Sistema de Consulta y Pago de Deudas Tributarias
            </p>
          </div>
        </a>

        {{-- Nav --}}
        <nav class="hidden md:flex items-center gap-6 fade-up delay-1">
          <a href="{{ route('portal.index') }}" class="nav-link text-sm font-medium {{ request()->routeIs('portal.*') ? 'text-white' : 'text-white/90' }} hover:text-white py-1">
            <i class="fa-solid fa-magnifying-glass mr-1.5 text-mde-goldlt"></i>
            Consultar deuda
          </a>
          <a href="{{ route('portal.pago') }}" class="nav-link text-sm font-medium text-white/90 hover:text-white py-1">
            <i class="fa-solid fa-credit-card mr-1.5 text-mde-goldlt"></i>
            Pagar en línea
          </a>
          <a href="{{ route('portal.fraccionamiento') }}" class="nav-link text-sm font-medium text-white/90 hover:text-white py-1">
            <i class="fa-solid fa-file-invoice mr-1.5 text-mde-goldlt"></i>
            Fraccionamiento
          </a>
          <a href="{{ route('portal.ayuda') }}" class="nav-link text-sm font-medium text-white/90 hover:text-white py-1">
            <i class="fa-solid fa-circle-question mr-1.5 text-mde-goldlt"></i>
            Ayuda
          </a>
        </nav>
      </div>
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

  @yield('scripts')
</body>
</html>
