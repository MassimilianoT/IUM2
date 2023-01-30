@props(['boardgame'])


<article
        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl col-span-2">
    <a href="/boardgames/{{ $boardgame->id }}">
        <div class="py-6 px-5">
            <div>
                <img src="{{ asset('storage/' . $boardgame->thumbnail) }}" alt="Illustration" class="rounded-xl">
            </div>

            <div class="mt-8 flex flex-col justify-between">
                <header>
                    <div class="mt-4">
                        <h1 class="text-3xl">
                            {{ $boardgame->name }}
                        </h1>
                    </div>
                </header>

                <div class="text-sm mt-4 space-y-4">
                    {{ $boardgame->description }}
                </div>
            </div>
        </div>
    </a>
</article>
