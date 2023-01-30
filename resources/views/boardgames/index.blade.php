<x-layout>
    @include('boardgames._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($boardgames->count()>0)
            <x-boardgames-grid :boardgames="$boardgames"/>

            {{ $boardgames->links() }}
        @else
            <p class="text-center">Nessun gioco da tavolo ancora aggiunto</p>
        @endif
    </main>
</x-layout>
