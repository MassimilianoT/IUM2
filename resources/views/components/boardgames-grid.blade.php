@props(['boardgames'])

@if ($boardgames->count() > 0)
    <div class="lg:grid lg:grid-cols-6">
        @foreach($boardgames as $boardgame)
            <x-boardgame-card
                    :boardgame="$boardgame"
            />
        @endforeach
    </div>
@endif