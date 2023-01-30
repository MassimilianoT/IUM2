<x-layout>
    <x-admin-setting heading="Crea nuovo autore">
        <form method="POST" action="/admin/authors" id="create_author">
            @csrf

            <x-form.input name="firstName" label="Nome"/>

            <x-form.input name="lastName" label="Cognome"/>

            <x-form.field>
                <x-form.label name="boardgames" label="Giochi da Tavolo"/>

                @foreach ($boardgames as $boardgame)
                    <input type="checkbox" name="boardgames_id[]" value={{ $boardgame->id }} id="boardgame_{{ $boardgame->id }}">
                    <label for="boardgame_{{ $boardgame->id }}">{{ ucwords($boardgame->name) }}</label><br>
                @endforeach

                <x-form.error name="boardgames_id"/>
            </x-form.field>

            <x-form.button>Crea</x-form.button>

        </form>
    </x-admin-setting>
</x-layout>

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\StoreAuthorRequest', '#create_author'); !!}