<!doctype html>
<head>
    <title>M&G BoardGames</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body style="font-family: Open Sans, sans-serif">
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>

    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.PNG" alt="Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    <x-dropdown>
                        <x-slot name="trigger">
                            <label class= "text-s font-bold uppercase rounded-xl p-2 "> Benvenuto, {{ auth()->user()->firstName }} {{ auth()->user()->lastName }}  </label>
                            <button class="text-s font-bold uppercase rounded-xl p-2 hover:bg-gray-200">
                                ☰ </button>
                        </x-slot>

                        @can('admin')
                        <x-dropdown-item href="/admin/boardgames/create"
                        :active="request()->is('admin/boardgames/create')">Aggiungi Gioco
                        </x-dropdown-item>
                            <x-dropdown-item href="/admin/boardgames" :active="request()->is('admin/boardgames')">
                                Gestisci Giochi
                            </x-dropdown-item>

                            <x-dropdown-item href="/admin/authors/create"
                                             :active="request()->is('admin/authors/create')">Aggiungi Autore
                            </x-dropdown-item>

                            <x-dropdown-item href="/admin/authors"
                                             :active="request()->is('admin/authors')">Gestisci Autori
                            </x-dropdown-item>

                            <x-dropdown-item href="/admin/categories/create"
                                             :active="request()->is('admin/categories/create')">Aggiungi Categoria
                            </x-dropdown-item>
                            
                            <x-dropdown-item href="/admin/categories"
                            :active="request()->is('admin/categories')">Gestisci Categorie
                            </x-dropdown-item>
                            <x-dropdown-item href="/admin/users"
                                             :active="request()->is('admin/users')">Gestisci Utenti
                            </x-dropdown-item>
                            <x-dropdown-item href="/admin/plays"
                                             :active="request()->is('admin/plays')">Gestisci Partite
                            </x-dropdown-item>
                        @endcan

                        @cannot('admin')
                            <x-dropdown-item href="/plays/create" :active="request()->is('plays/create')">
                                Aggiungi partita
                            </x-dropdown-item>
                            <x-dropdown-item href="/user/{{ auth()->user()->id }}/plays" :active="request()->is('user/{{ auth()->user()->id }}/plays')">
                                Le mie partite
                            </x-dropdown-item>
                            <x-dropdown-item href="/user/{{ auth()->user()->id }}/plays/winned" :active="request()->is('user/{{ auth()->user()->id }}/plays/winned')">
                                Le mie vittorie
                            </x-dropdown-item>
                            <x-dropdown-item href="/user/{{ auth()->user()->id }}/votes" :active="request()->is('user/{{ auth()->user()->id }}/votes')">
                                Vota i giochi
                            </x-dropdown-item>
                        @endcannot
                    </x-dropdown>

                    @cannot('admin')
                        <button class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" type="button" data-modal-toggle="search-modal">
                            Consigliami un gioco!
                        </button>
                    @endcannot
                    <form id="logout-form" method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                        class="bg-red-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300" type="button">
                            Logout
                        </button>
                    </form>

                @else
                <a href="/register" class="bg-red-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300" type="button">
                            Registrati
                </a>
                <a href="/login" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" type="button">
                            Log In
                </a>   
                @endauth
                <button class="bg-green-500 ml-3 rounded-full text-xs font-bold text-white uppercase py-3 px-5 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300" type="button" data-modal-toggle="help-modal">
                    ?
                </button>
            </div>
        </nav>

        {{ $slot }}

        <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-5 px-10 mt-10">
            <div class="relative inline-block mx-auto">
                Mirko Glisenti
            </div>
        </footer>
    </section>
    @if (auth()->user() != null)
        <x-randomGame/>
    @endif
    <x-help/>
    <x-flash/>
</body>
