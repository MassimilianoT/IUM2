<x-layout>

    <x-admin-setting heading="Crea nuova categoria">
        <form method="POST" action="/admin/categories">
            @csrf

            <x-form.input label="Nome" name="name" id="category_name"/>

            <x-form.input label="Slug" name="slug" id="slug"/>

            <x-form.field>
                <x-form.label name="boardgames"/>

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

<script type="text/javascript">
    $( document ).ready(function() {
        $("#name").on("input", function(){
            $('#slug').val($(this).val().toLowerCase().replace(/ /g,'-'));
        });
    });

</script>