@props(['heading'])

<section class="py-8 max-w-7xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <ul>
                <li>
                    <a href="/plays/create" class="{{ request()->is('plays/create') ? 'text-blue-500' : ''}}">
                        Aggiungi partita
                    </a>
                </li>
                <li>
                    <a href="/user/{{ auth()->user()->id }}/plays" class="{{ request()->is('user/' . auth()->user()->id . '/plays') ? 'text-blue-500' : ''}}">
                        Le mie partite
                    </a>
                </li>
                <li>
                    <a href="/user/{{ auth()->user()->id }}/plays/winned" class="{{ request()->is('user/' . auth()->user()->id . '/plays/winned') ? 'text-blue-500' : ''}}">
                        Le mie vittorie
                    </a>
                </li>
                <li>
                    <a href="/user/{{ auth()->user()->id }}/votes" class="{{ request()->is('user/' . auth()->user()->id . '/votes') ? 'text-blue-500' : ''}}">
                        Vota i giochi
                    </a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>