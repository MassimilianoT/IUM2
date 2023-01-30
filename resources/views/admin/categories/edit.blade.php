<x-layout>

    <x-admin-setting :heading="'Modifica Categoria: ' . $category->name">
        <form method="POST" action="/admin/categories/{{ $category->id }}">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name', $category->name)" />

            <x-form.input name="slug" :value="old('slug', $category->slug)"/>

            <x-form.field>
                <x-form.label name="boardgames"/>

                @foreach ($boardgames as $boardgame)
                    @php
                        $found = false;
                    @endphp
                    @foreach($category->boardgames as $category_board)
                        @if ($category_board->id == $boardgame->id)
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

<script type="text/javascript">
    $( document ).ready(function() {
        $("#name").on("input", function(){
            $('#slug').val($(this).val().toLowerCase().replace(/ /g,'-'));
        });
    });

</script>