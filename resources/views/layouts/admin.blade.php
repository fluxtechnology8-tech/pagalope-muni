<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Panel Admin') — MDEAdmin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Montserrat', sans-serif; }
    .sidebar-item {
      transition: all 0.2s;
      border-left: 3px solid transparent;
    }
    .sidebar-item:hover, .sidebar-item.active {
      background: rgba(201,168,76,0.1);
      border-left-color: #C9A84C;
      color: #C9A84C;
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
    .input-gold:focus {
      outline: none;
      border-color: #C9A84C;
      box-shadow: 0 0 0 3px rgba(201,168,76,0.2);
    }
    .result-row { transition: background 0.2s; }
    .result-row:hover { background: #EEF4FB; }
    .badge-vencida { background: #FEE2E2; color: #B91C1C; }
    .badge-vigente  { background: #DCFCE7; color: #166534; }
  </style>
  @yield('styles')
</head>
<body class="bg-gray-50 min-h-screen" x-data="{ sidebarOpen: false }">

  <div class="flex min-h-screen">

    {{-- ═══════════ SIDEBAR ═══════════ --}}
    <aside class="w-64 bg-mde-navy min-h-screen flex-shrink-0 flex flex-col" :class="sidebarOpen ? 'block' : 'hidden md:flex'">
      {{-- Logo --}}
      <div class="p-5 border-b border-white/10">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 no-underline">
          <div class="w-9 h-9 rounded-full bg-mde-gold/20 flex items-center justify-center">
            <i class="fa-solid fa-landmark text-mde-goldlt text-sm"></i>
          </div>
          <div>
            <p class="font-black text-white text-sm">MDE<span class="text-mde-gold">Admin</span></p>
            <p class="text-xs text-blue-300">Panel de control</p>
          </div>
        </a>
      </div>

      {{-- Nav items --}}
      <nav class="flex-1 py-4 px-3 overflow-y-auto">
        <p class="text-[10px] font-bold text-blue-400 tracking-widest uppercase px-3 mb-2">Principal</p>
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="fa-solid fa-chart-pie w-4 text-center"></i>
          <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.contribuyentes.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.contribuyentes.*') ? 'active' : '' }}">
          <i class="fa-solid fa-users w-4 text-center"></i>
          <span>Contribuyentes</span>
        </a>
        <a href="{{ route('admin.deudas.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.deudas.*') ? 'active' : '' }}">
          <i class="fa-solid fa-file-invoice-dollar w-4 text-center"></i>
          <span>Deudas</span>
          {{-- <span class="ml-auto bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5 py-0.5">12</span> --}}
        </a>
        <a href="{{ route('admin.pagos.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.pagos.*') ? 'active' : '' }}">
          <i class="fa-solid fa-credit-card w-4 text-center"></i>
          <span>Pagos</span>
        </a>

        <p class="text-[10px] font-bold text-blue-400 tracking-widest uppercase px-3 mt-5 mb-2">Administración</p>
        <a href="{{ route('admin.roles.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
          <i class="fa-solid fa-user-shield w-4 text-center"></i>
          <span>Roles y permisos</span>
        </a>
        <a href="{{ route('admin.modulos.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.modulos.*') ? 'active' : '' }}">
          <i class="fa-solid fa-puzzle-piece w-4 text-center"></i>
          <span>Módulos del sistema</span>
        </a>
        <a href="{{ route('admin.usuarios.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
          <i class="fa-solid fa-user-gear w-4 text-center"></i>
          <span>Usuarios admin</span>
        </a>
        <a href="{{ route('admin.reportes.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.reportes.*') ? 'active' : '' }}">
          <i class="fa-solid fa-chart-bar w-4 text-center"></i>
          <span>Reportes</span>
        </a>

        <p class="text-[10px] font-bold text-blue-400 tracking-widest uppercase px-3 mt-5 mb-2">Seguridad</p>
        <a href="{{ route('admin.auditoria.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.auditoria.*') ? 'active' : '' }}">
          <i class="fa-solid fa-scroll w-4 text-center"></i>
          <span>Auditoría</span>
        </a>
        <a href="{{ route('admin.accesos.index') }}"
           class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-blue-200 text-sm font-medium text-left mb-0.5 {{ request()->routeIs('admin.accesos.*') ? 'active' : '' }}">
          <i class="fa-solid fa-key w-4 text-center"></i>
          <span>Log de accesos</span>
        </a>
      </nav>

      {{-- User info --}}
      <div class="p-4 border-t border-white/10">
        <div class="flex items-center gap-3">
          {{-- TODO: Reemplazar con datos del usuario autenticado: Auth::user() --}}
          <div class="w-8 h-8 rounded-full bg-mde-gold flex items-center justify-center text-xs font-bold text-mde-navy">JR</div>
          <div class="flex-1 min-w-0">
            <p class="text-white text-xs font-semibold truncate">Jorge Ramírez</p>
            <p class="text-blue-400 text-[10px]">Administrador</p>
          </div>
          <form method="POST" action="{{ route('admin.logout') }}" class="inline">
            @csrf
            @method('POST')
            <button type="submit" class="text-blue-400 hover:text-red-400 transition-colors">
              <i class="fa-solid fa-right-from-bracket text-sm"></i>
            </button>
          </form>
        </div>
      </div>
    </aside>

    {{-- ═══════════ MAIN CONTENT ═══════════ --}}
    <div class="flex-1 flex flex-col min-w-0">

      {{-- Top bar admin --}}
      <div class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-400 hover:text-mde-navy">
            <i class="fa-solid fa-bars text-lg"></i>
          </button>
          <div>
            <h2 class="font-bold text-mde-navy text-lg">@yield('page-title', 'Panel')</h2>
            <p class="text-xs text-gray-400 font-medium">Municipalidad Distrital de La Esperanza</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <button class="relative p-2 text-gray-400 hover:text-mde-navy rounded-lg hover:bg-gray-50 transition-all">
            <i class="fa-solid fa-bell text-lg"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
          </button>
          <a href="{{ route('portal.index') }}" class="flex items-center gap-2 text-xs font-semibold text-mde-mid hover:text-mde-navy border border-mde-mid/30 px-3 py-2 rounded-lg transition-all">
            <i class="fa-solid fa-arrow-left"></i>
            Portal público
          </a>
        </div>
      </div>

      {{-- Dashboard content --}}
      <div class="flex-1 p-6 overflow-auto">
        @yield('content')
      </div>

    </div>
  </div>

  @yield('scripts')
</body>
</html>
