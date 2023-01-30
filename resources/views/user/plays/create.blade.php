<x-layout>

    <x-setting heading="Registra nuova partita">
        <form method="POST" action="/plays" id="create_plays_form">
            @csrf

            <x-form.input label="Data" name="date" type="date" required="required"/>

            <x-form.field>
                <x-form.label name="boardgame"/>

                <select name="boardgame_id">
                    @foreach ($boardgames as $boardgame)
                        <option
                                value="{{ $boardgame->id }}"
                                {{ old('boardgame_id') == $boardgame->id ? 'selected' : ''}}
                        >{{ ucwords($boardgame->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="boardgame"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="players"/>

                    @foreach ($users as $user)
                        <input type="checkbox" name="players_id[]" value={{ $user->id }} id="player_{{ $user->id }}">
                        <label for="player_{{ $user->id }}">{{ ucwords($user->lastName . " ". $user->firstName) }}</label><br>
                    @endforeach

                <x-form.error name="players"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="winner"/>

                <select name="winner_id" id="winner_id">
                    <option value=-1 disabled="disabled">Seleziona il vincitore</option>
                </select>

                <x-form.error name="boardgame"/>
            </x-form.field>

            <x-form.button>Registra</x-form.button>

        </form>
    </x-setting>
</x-layout>

<script type="text/javascript">
    $(document).ready(function () {
        $("input[name='players_id[]']").change(function () {
            const checked = [];

            $.each($("input[name='players_id[]']:checked"), function(){
                const player = {};
                // console.log($(this).next().html());
                player['id'] = ($(this).val());
                player['name'] = ($(this).next().html());
                //console.log(player);
                checked.push(player);
            });

            //console.log(checked);

            $('#winner_id').empty();

            checked.forEach(function(player){
                //console.log(player);
                $('#winner_id').append('<option value="' + player.id + '">' + player.name + '</option>');
            });
        });
    });
</script>