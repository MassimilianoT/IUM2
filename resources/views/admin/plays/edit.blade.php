<x-layout>

    <x-admin-setting heading="Modifica partita">
        <form method="POST" action="/admin/plays/{{ $play->id }}" id="modify_plays_form">
            @csrf
            @method('PATCH')

            <x-form.input name="date" type="date" required="required" :value="old('date', $play->date)"/>

            <x-form.field>
                <x-form.label name="boardgame"/>

                <select name="boardgame_id">
                    @foreach ($boardgames as $boardgame)
                        <option
                                value="{{ $boardgame->id }}"
                                {{ old('boardgame_id', $play->boardgame_id) == $boardgame->id ? 'selected' : ''}}
                        >{{ ucwords($boardgame->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="boardgame"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="players"/>

                @foreach ($users as $user)
                    @php
                        $found = false;
                    @endphp
                    @foreach($play->players as $player)
                        @if ($user->id == $player->id)
                            @php
                                $found = true;
                            @endphp
                        @endif
                    @endforeach
                    <input type="checkbox" name="players_id[]" value={{ $user->id }} id="player_{{ $user->id }}" {{ $found ? 'checked' : '' }}>
                    <label for="player_{{ $user->id }}">{{ ucwords($user->lastName . " ". $user->firstName) }}</label><br>
                @endforeach

                <x-form.error name="players"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="winner"/>

                <select name="winner_id" id="winner_id">
                    <option value=-1 disabled="disabled">Seleziona il vincitore</option>
                    @foreach($play->players as $player)
                        <option value={{ $player->id }} {{ $player->id == $play->winner_id ? 'selected' : '' }}>{{ $player->lastName }} {{ $player->firstName }}</option>
                    @endforeach
                </select>

                <x-form.error name="boardgame"/>
            </x-form.field>

            <x-form.button>Registra</x-form.button>



        </form>
    </x-admin-setting>
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