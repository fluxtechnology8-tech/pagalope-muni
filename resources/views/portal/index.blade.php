@extends('layouts.app')

@section('title', 'Consulta de Deuda')

@section('content')
{{-- ═══════════ HERO CON BUSCADOR ═══════════ --}}
<section class="bg-gradient-to-b from-mde-blue/5 to-transparent pt-12 pb-16 px-4"
         x-data="portalBuscador()" x-init="init()">
  <div class="max-w-3xl mx-auto text-center fade-up delay-2">
    <div class="inline-flex items-center gap-2 bg-mde-gold/10 text-mde-golddark text-xs font-semibold px-4 py-2 rounded-full border border-mde-gold/30 mb-6">
      <i class="fa-solid fa-circle-check text-mde-gold pulse-gold"></i>
      Servicio disponible 24 horas
    </div>
    <h2 class="font-heading font-black text-4xl text-mde-navy mb-4 leading-tight">
      Consulta tu deuda tributaria<br/>
      <span class="text-mde-mid">desde cualquier lugar</span>
    </h2>
    <p class="text-gray-500 text-base mb-10 max-w-xl mx-auto font-medium">
      Ingresa tu número de DNI o RUC para ver tu estado de cuenta, deudas pendientes y realizar pagos en línea.
    </p>

    {{-- Tarjeta de búsqueda --}}
    <div class="search-card p-8 fade-up delay-3">
      {{-- Tabs tipo --}}
      <div class="flex bg-mde-light rounded-xl p-1 mb-6 gap-1">
        <button @click="searchType='dni'"
          :class="searchType==='dni' ? 'bg-mde-navy text-white shadow' : 'text-gray-500 hover:text-mde-navy'"
          class="flex-1 py-2.5 rounded-lg text-sm font-semibold transition-all">
          <i class="fa-solid fa-id-card mr-2"></i>Persona Natural (DNI)
        </button>
        <button @click="searchType='ruc'"
          :class="searchType==='ruc' ? 'bg-mde-navy text-white shadow' : 'text-gray-500 hover:text-mde-navy'"
          class="flex-1 py-2.5 rounded-lg text-sm font-semibold transition-all">
          <i class="fa-solid fa-building mr-2"></i>Persona Jurídica (RUC)
        </button>
      </div>

      {{-- Input búsqueda --}}
      <div class="flex gap-3">
        <div class="flex-1 relative">
          <div class="absolute left-4 top-1/2 -translate-y-1/2 text-mde-mid pointer-events-none">
            <i x-show="searchType==='dni'" class="fa-solid fa-id-card text-lg"></i>
            <i x-show="searchType==='ruc'" class="fa-solid fa-building text-lg"></i>
          </div>
          <input
            x-model="searchDoc"
            type="text"
            :placeholder="searchType==='dni' ? 'Ingresa tu DNI (8 dígitos)' : 'Ingresa tu RUC (11 dígitos)'"
            :maxlength="searchType==='dni' ? 8 : 11"
            class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl text-mde-navy font-semibold text-lg input-gold transition-all"
            @keyup.enter="buscar()"
          />
        </div>
        <button @click="buscar()"
          class="btn-primary text-white px-8 py-4 rounded-xl font-bold text-sm flex items-center gap-2">
          <i class="fa-solid fa-magnifying-glass"></i>
          <span>Consultar</span>
        </button>
      </div>

      {{-- Resultado --}}
      <div x-show="showResult" x-transition class="mt-6">
        <hr class="gold-line mb-6"/>

        {{-- Info contribuyente --}}
        <div class="flex items-start justify-between mb-5 flex-wrap gap-3">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-mde-light flex items-center justify-center">
              <i class="fa-solid fa-user-tie text-mde-mid text-xl"></i>
            </div>
            <div class="text-left">
              <p class="font-bold text-mde-navy text-base" x-text="contributor?.nombre || '-'"></p>
              <p class="text-gray-400 text-xs font-medium mt-0.5">
                <i class="fa-solid fa-id-card mr-1 text-mde-gold"></i><span x-text="contributor?.doc || '-'"></span>
                <span class="mx-2 text-gray-300">|</span>
                <i class="fa-solid fa-location-dot mr-1 text-mde-gold"></i><span x-text="contributor?.direccion || '-'"></span>
              </p>
            </div>
          </div>
          <div class="text-right">
            <p class="text-xs text-gray-400 font-medium">Deuda total</p>
            <p class="text-2xl font-black text-red-600" x-text="'S/ ' + (contributor?.total || 0).toFixed(2)"></p>
          </div>
        </div>

        {{-- Tabs deudas --}}
        <div class="flex bg-mde-light rounded-xl p-1 mb-4 gap-1">
          <button @click="deudaTab='pendientes'"
            :class="deudaTab==='pendientes' ? 'bg-red-600 text-white shadow' : 'text-gray-500 hover:text-red-600'"
            class="flex-1 py-2.5 rounded-lg text-sm font-semibold transition-all">
            <i class="fa-solid fa-clock-rotate-left mr-2"></i>Pendientes
            <span class="ml-1 text-xs" x-text="'(' + deudasPendientes.length + ')'"></span>
          </button>
          <button @click="deudaTab='pagadas'"
            :class="deudaTab==='pagadas' ? 'bg-green-600 text-white shadow' : 'text-gray-500 hover:text-green-600'"
            class="flex-1 py-2.5 rounded-lg text-sm font-semibold transition-all">
            <i class="fa-solid fa-circle-check mr-2"></i>Pagadas
            <span class="ml-1 text-xs" x-text="'(' + deudasPagadas.length + ')'"></span>
          </button>
        </div>

        {{-- TABLA PENDIENTES --}}
        <div x-show="deudaTab==='pendientes'">
          <template x-if="deudasPendientes.length === 0">
            <p class="text-center text-gray-400 text-sm py-8">No tiene deudas pendientes</p>
          </template>
          <template x-if="deudasPendientes.length > 0">
            <div>
              <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="w-full text-sm">
                  <thead>
                    <tr class="bg-red-600 text-white">
                      <th class="px-4 py-3 text-left font-semibold text-xs">#</th>
                      <th class="px-4 py-3 text-left font-semibold text-xs">Concepto</th>
                      <th class="px-4 py-3 text-center font-semibold text-xs">Periodo</th>
                      <th class="px-4 py-3 text-right font-semibold text-xs">Monto</th>
                      <th class="px-4 py-3 text-center font-semibold text-xs">Estado</th>
                      <th class="px-4 py-3 text-center font-semibold text-xs">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template x-for="(deuda, idx) in paginatedPendientes" :key="deuda.id">
                      <tr class="result-row border-b border-gray-50">
                        <td class="px-4 py-3 text-gray-400 text-xs font-medium" x-text="(pagePendientes - 1) * perPage + idx + 1"></td>
                        <td class="px-4 py-3">
                          <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-red-50 flex items-center justify-center">
                              <i class="fa-solid fa-file-invoice text-red-500 text-xs"></i>
                            </div>
                            <span class="font-medium text-mde-navy" x-text="deuda.concepto"></span>
                          </div>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500 font-medium" x-text="deuda.periodo"></td>
                        <td class="px-4 py-3 text-right font-bold text-red-600" x-text="deuda.monto"></td>
                        <td class="px-4 py-3 text-center">
                          <span class="badge-vencida px-2.5 py-1 rounded-full text-xs font-bold" x-text="deuda.estado"></span>
                        </td>
                        <td class="px-4 py-3 text-center">
                          <button @click="pagarDeuda(deuda)"
                            class="bg-mde-mid hover:bg-mde-navy text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-all">
                            <i class="fa-solid fa-credit-card mr-1"></i>Pagar
                          </button>
                        </td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
              {{-- Paginación pendientes --}}
              <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-100" x-show="totalPagesPendientes > 1">
                <p class="text-xs text-gray-400">
                  Mostrando <span x-text="(pagePendientes-1)*perPage+1"></span>–<span x-text="Math.min(pagePendientes*perPage, deudasPendientes.length)"></span>
                  de <span x-text="deudasPendientes.length"></span>
                </p>
                <div class="flex gap-1">
                  <button @click="pagePendientes > 1 && pagePendientes--"
                    class="w-8 h-8 rounded-lg text-xs font-bold border border-gray-200 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-mde-light transition-all">
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <template x-for="pg in totalPagesPendientes" :key="'pp'+pg">
                    <button @click="pagePendientes = pg"
                      :class="pg===pagePendientes ? 'bg-red-600 text-white border-red-600' : 'text-gray-500 hover:bg-mde-light'"
                      class="w-8 h-8 rounded-lg text-xs font-bold border border-gray-200 transition-all" x-text="pg"></button>
                  </template>
                  <button @click="pagePendientes < totalPagesPendientes && pagePendientes++"
                    class="w-8 h-8 rounded-lg text-xs font-bold border border-gray-200 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-mde-light transition-all">
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </template>
        </div>

        {{-- TABLA PAGADAS --}}
        <div x-show="deudaTab==='pagadas'">
          <template x-if="deudasPagadas.length === 0">
            <p class="text-center text-gray-400 text-sm py-8">No tiene deudas pagadas</p>
          </template>
          <template x-if="deudasPagadas.length > 0">
            <div>
              <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="w-full text-sm">
                  <thead>
                    <tr class="bg-green-600 text-white">
                      <th class="px-4 py-3 text-left font-semibold text-xs">#</th>
                      <th class="px-4 py-3 text-left font-semibold text-xs">Concepto</th>
                      <th class="px-4 py-3 text-center font-semibold text-xs">Periodo</th>
                      <th class="px-4 py-3 text-right font-semibold text-xs">Monto</th>
                      <th class="px-4 py-3 text-center font-semibold text-xs">Estado</th>
                      <th class="px-4 py-3 text-center font-semibold text-xs">Comprobante</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template x-for="(deuda, idx) in paginatedPagadas" :key="deuda.id">
                      <tr class="result-row border-b border-gray-50">
                        <td class="px-4 py-3 text-gray-400 text-xs font-medium" x-text="(pagePagadas - 1) * perPage + idx + 1"></td>
                        <td class="px-4 py-3">
                          <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                              <i class="fa-solid fa-check-circle text-green-500 text-xs"></i>
                            </div>
                            <span class="font-medium text-mde-navy" x-text="deuda.concepto"></span>
                          </div>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500 font-medium" x-text="deuda.periodo"></td>
                        <td class="px-4 py-3 text-right font-bold text-green-600" x-text="deuda.monto"></td>
                        <td class="px-4 py-3 text-center">
                          <span class="badge-vigente px-2.5 py-1 rounded-full text-xs font-bold" x-text="deuda.estado"></span>
                        </td>
                        <td class="px-4 py-3 text-center">
                          <span class="text-gray-400 text-xs"><i class="fa-solid fa-file-pdf mr-1 text-red-400"></i>PDF</span>
                        </td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
              {{-- Paginación pagadas --}}
              <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-100" x-show="totalPagesPagadas > 1">
                <p class="text-xs text-gray-400">
                  Mostrando <span x-text="(pagePagadas-1)*perPage+1"></span>–<span x-text="Math.min(pagePagadas*perPage, deudasPagadas.length)"></span>
                  de <span x-text="deudasPagadas.length"></span>
                </p>
                <div class="flex gap-1">
                  <button @click="pagePagadas > 1 && pagePagadas--"
                    class="w-8 h-8 rounded-lg text-xs font-bold border border-gray-200 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-mde-light transition-all">
                    <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <template x-for="pg in totalPagesPagadas" :key="'pa'+pg">
                    <button @click="pagePagadas = pg"
                      :class="pg===pagePagadas ? 'bg-green-600 text-white border-green-600' : 'text-gray-500 hover:bg-mde-light'"
                      class="w-8 h-8 rounded-lg text-xs font-bold border border-gray-200 transition-all" x-text="pg"></button>
                  </template>
                  <button @click="pagePagadas < totalPagesPagadas && pagePagadas++"
                    class="w-8 h-8 rounded-lg text-xs font-bold border border-gray-200 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-mde-light transition-all">
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </template>
        </div>

        {{-- Botón pagar todo --}}
        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
          <p class="text-xs text-gray-400">
            <i class="fa-solid fa-lock text-mde-gold mr-1"></i>
            Pago seguro con cifrado SSL
          </p>
          <button @click="pagarTodo()"
            class="btn-gold text-white font-bold px-6 py-2.5 rounded-xl text-sm flex items-center gap-2">
            <i class="fa-solid fa-credit-card"></i>
            <span x-text="'Pagar todo (S/ ' + (contributor?.total || 0).toFixed(2) + ')'"></span>
          </button>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════ STATS ═══════════ --}}
<section class="max-w-7xl mx-auto px-4 pb-16 fade-up delay-4"
         x-data="portalStats()" x-init="cargarStats()">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <template x-for="stat in stats">
      <div class="stat-card p-5 text-center">
        <div class="w-10 h-10 rounded-xl mx-auto mb-3 flex items-center justify-center" :class="stat.bg">
          <i :class="stat.icon + ' text-lg'" :style="'color:' + stat.color"></i>
        </div>
        <p class="font-black text-2xl text-mde-navy" x-text="stat.value"></p>
        <p class="text-xs text-gray-400 font-medium mt-1" x-text="stat.label"></p>
      </div>
    </template>
  </div>
</section>
@endsection

@section('scripts')
<script>
function portalBuscador() {
  return {
    searchType: 'dni',
    searchDoc: '',
    showResult: false,
    contributor: null,
    deudaTab: 'pendientes',
    deudasPendientes: [],
    deudasPagadas: [],
    pagePendientes: 1,
    pagePagadas: 1,
    perPage: 8,

    get totalPagesPendientes() { return Math.max(1, Math.ceil(this.deudasPendientes.length / this.perPage)); },
    get paginatedPendientes() {
      const start = (this.pagePendientes - 1) * this.perPage;
      return this.deudasPendientes.slice(start, start + this.perPage);
    },
    get totalPagesPagadas() { return Math.max(1, Math.ceil(this.deudasPagadas.length / this.perPage)); },
    get paginatedPagadas() {
      const start = (this.pagePagadas - 1) * this.perPage;
      return this.deudasPagadas.slice(start, start + this.perPage);
    },

    init() {},

    async buscar() {
      if (!this.searchDoc || this.searchDoc.length < 8) {
        Swal.fire({ icon:'warning', title:'Número incompleto', text:`Ingresa un ${this.searchType.toUpperCase()} válido.`, confirmButtonColor:'#19376D' });
        return;
      }
      Swal.fire({ title:'Consultando...', html:'<p class="text-sm text-gray-500">Buscando información del contribuyente</p>', timerProgressBar:true, didOpen:() => Swal.showLoading(), showConfirmButton:false });
      try {
        // TODO: Consumir API real: /api/contribuyentes/buscar?doc=...
        const res = await fetch(`/api/contribuyentes/buscar?doc=${this.searchDoc}`);
        const data = await res.json();
        Swal.close();
        if (!res.ok) {
          Swal.fire({ icon:'info', title:'Sin resultados', text: data.error || 'Contribuyente no encontrado', confirmButtonColor:'#19376D' });
          this.showResult = false;
          return;
        }
        this.contributor = data;
        this.deudasPendientes = data.pendientes || [];
        this.deudasPagadas = data.pagadas || [];
        this.pagePendientes = 1;
        this.pagePagadas = 1;
        this.deudaTab = 'pendientes';
        this.showResult = true;
      } catch (e) {
        Swal.close();
        Swal.fire({ icon:'error', title:'Error de conexión', text:'No se pudo conectar con el servidor.', confirmButtonColor:'#19376D' });
      }
    },

    pagarDeuda(deuda) {
      Swal.fire({
        title: 'Pagar deuda',
        html: `<div style="text-align:left;padding:8px 0">
          <p style="font-size:13px;color:#6b7280;margin-bottom:4px">Concepto</p>
          <p style="font-weight:700;color:#0B2447;font-size:15px">${deuda.concepto} – ${deuda.periodo}</p>
          <p style="font-size:13px;color:#6b7280;margin-top:12px;margin-bottom:4px">Monto a pagar</p>
          <p style="font-weight:900;color:#0B2447;font-size:24px">${deuda.monto}</p>
        </div>`,
        showCancelButton: true, confirmButtonColor:'#C9A84C', cancelButtonColor:'#9CA3AF',
        confirmButtonText:'<i class="fa-solid fa-credit-card" style="margin-right:6px"></i>Proceder al pago',
        cancelButtonText:'Cancelar',
      }).then(r => {
        if (r.isConfirmed) this.procesarPago(deuda.monto);
      });
    },

    pagarTodo() {
      const total = this.contributor?.total || 0;
      Swal.fire({
        title: 'Pagar deuda total',
        html: `<div style="text-align:center;padding:8px 0">
          <p style="font-size:13px;color:#6b7280">Pagarás el total de tu deuda:</p>
          <p style="font-weight:900;color:#B91C1C;font-size:32px;margin:8px 0">S/ ${total.toFixed(2)}</p>
          <p style="font-size:12px;color:#9CA3AF">Incluye ${this.deudasPendientes.length} conceptos pendientes</p>
        </div>`,
        showCancelButton: true, confirmButtonColor:'#C9A84C', cancelButtonColor:'#9CA3AF',
        confirmButtonText:'<i class="fa-solid fa-credit-card" style="margin-right:6px"></i>Pagar todo',
        cancelButtonText:'Cancelar',
      }).then(r => {
        if (r.isConfirmed) this.procesarPago('S/ ' + total.toFixed(2));
      });
    },

    procesarPago(monto) {
      Swal.fire({
        title:'Procesando pago...', html:'<p style="font-size:13px;color:#6b7280">Conectando con pasarela de pago segura</p>',
        timer:2000, timerProgressBar:true, didOpen:() => Swal.showLoading(), showConfirmButton:false,
      }).then(() => {
        Swal.fire({
          icon:'success', title:'¡Pago exitoso!',
          html:`<div style="text-align:center">
            <p style="font-size:13px;color:#6b7280">Se procesó el pago de</p>
            <p style="font-weight:900;color:#166534;font-size:28px">${monto}</p>
            <p style="font-size:12px;color:#9CA3AF;margin-top:8px">Recibirás un comprobante en tu correo</p>
          </div>`,
          confirmButtonColor:'#19376D', confirmButtonText:'Descargar comprobante',
        });
      });
    },
  }
}

function portalStats() {
  return {
    stats: [
      { value:'0', label:'Contribuyentes',  icon:'fa-solid fa-users',         bg:'#EEF4FB', color:'#19376D' },
      { value:'S/ 0', label:'Recaudado',    icon:'fa-solid fa-sack-dollar',   bg:'#FEF3C7', color:'#92400E' },
      { value:'0',    label:'Deudas total',  icon:'fa-solid fa-file-invoice-dollar', bg:'#DCFCE7', color:'#166534' },
      { value:'0',    label:'Deudas vencidas', icon:'fa-solid fa-triangle-exclamation', bg:'#FEE2E2', color:'#B91C1C' },
    ],
    async cargarStats() {
      try {
        // TODO: Consumir API real: /api/stats
        const res = await fetch('/api/stats');
        const data = await res.json();
        this.stats = [
          { value: data.contribuyentes.toLocaleString(), label:'Contribuyentes',    icon:'fa-solid fa-users',         bg:'#EEF4FB', color:'#19376D' },
          { value: 'S/ ' + (data.recaudado/1000).toFixed(1)+'K', label:'Recaudado', icon:'fa-solid fa-sack-dollar',   bg:'#FEF3C7', color:'#92400E' },
          { value: data.deudas_total.toLocaleString(),   label:'Deudas total',      icon:'fa-solid fa-file-invoice-dollar', bg:'#DCFCE7', color:'#166534' },
          { value: data.deudas_vencidas.toLocaleString(), label:'Deudas vencidas',  icon:'fa-solid fa-triangle-exclamation', bg:'#FEE2E2', color:'#B91C1C' },
        ];
      } catch (e) { /* silently fail */ }
    },
  }
}
</script>
@endsection
