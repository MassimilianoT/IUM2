<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        La nostra collezione di giochi da tavolo
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <form method="GET" action="/">
        <div class="relative flex inline-flex bg-gray-100 rounded-xl px-3 py-2 mt-2">
            
                <input
                        type="text"
                        name="search"
                        placeholder="Cerca per titolo..."
                        class="bg-transparent placeholder-black font-semibold text-sm"
                        value="{{ request('search') }}"
                >
                
                @if (request('search')!='')
                    <a class='text font-bold pl-3' href="/" class="text-black">X</a>
                @endif  
            
        </div>
        <div class="relative flex inline-flex bg-blue-100 rounded-xl px-3 py-2 mt-2">
            <button class='text font-bold' type="submit">Cerca</button>
        </div>
    </form>
    </div>
</header>