<x-app-layout>

    @if ($deudas->isEmpty())
        <p>No tienes deudas</p>
    @endif

</x-app-layout>