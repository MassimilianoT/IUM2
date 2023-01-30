<x-layout>

    <x-admin-setting :heading="'Modifica Autore: ' . $author->name">
        <form method="POST" action="/admin/authors/{{ $author->id }}">
            @csrf
            @method('PATCH')

            <x-form.input name="firstName" label="Nome" :value="old('firstName', $author->firstName)" />

            <x-form.input name="lastName" label="Cognome" :value="old('lastName', $author->lastName)"/>

            <x-form.field>
                <x-form.label name="boardgames" label="Giochi da tavolo"/>

                @foreach ($boardgames as $boardgame)
                    @php
                        $found = false;
                    @endphp
                    @foreach($author->boardgames as $author_board)
                        @if ($author_board->id == $boardgame->id)
                            @php
                                $found = true;
                            @endphp
                        @endif
                    @endforeach
                    <input type="checkbox" name="boardgames_id[]" value={{ $boardgame->id }} id="boardgame_{{ $boardgame->id }}" {{ $found == true ? 'checked' : '' }}>
                    <label for="boardgame_{{ $boardgame->id }}">{{ ucwords($boardgame->name) }}</label><br>
                @endforeach

                <x-form.error name="boardgames_id"/>
            </x-form.field>

            <x-form.button>Aggiorna</x-form.button>

        </form>
    </x-admin-setting>
</x-layout>