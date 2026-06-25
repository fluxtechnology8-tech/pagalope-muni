<x-app-layout>
    <p>Form para crear información de contribuyente</p>

    <form action="{{ route('contribuyentes.store') }}" method="POST">
        @csrf

        <x-text-input name="nombres_razon_social" aria-placeholder="Ingresa tu nombre o razón social"/>
        <x-text-input name="dni_ruc" aria-placeholder="Ingresa tu dni o ruc"/>
        <x-text-input name="direccion_fiscal" aria-placeholder="Ingresa tu direccion fiscal"/>
        
        <x-primary-button>Enviar</x-primary-button>     

    </form>

</x-app-layout>