<x-layout>
    <section class="px-6 py-8">
        <div class="lg:flex justify-between mb-4">
            <a href="/"
               class="transition-colors font-bold duration-300 relative inline-flex items-center text-blue-500 text-lg hover:text-blue-800">
                <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                    <g fill="none" fill-rule="evenodd">
                        <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                        </path>
                        <path class="fill-current"
                              d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                        </path>
                    </g>
                </svg>

                Torna alla collezione
            </a>

        </div>

        <h1 class="font-bold text-3xl lg:text-4xl mb-6 text-center">
            {{ $boardgame->name }}
        </h1>
        <main class="max-w-6xl mx-auto mt-10 lg:mt-10 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-3 lg:text-center lg:pt-14 mb-10">
                    <img src="{{ asset('storage/' . $boardgame->thumbnail) }}" alt="" class="rounded-xl">
                </div>

                <div class="col-span-4">


                    <div class="lg:text-lg leading-loose font-bold">
                        Autori:
                    </div>
                    <div class="space-y-4 lg:text-lg leading-loose">
                        @foreach ($boardgame->authors as $author)
                            {{ $author->firstName }} {{ $author->lastName }} {!! "<br>" !!}
                        @endforeach
                    </div>

                    <div class="mt-4 lg:text-lg leading-loose font-bold">
                        Editore:
                    </div>
                    <div class="space-y-4 lg:text-lg leading-loose">
                        {{ $boardgame->editor }}
                    </div>

                    <div class="mt-4 lg:text-lg leading-loose font-bold">
                        Giocatori Minimi:
                    </div>
                    <div class="space-y-4 lg:text-lg leading-loose">
                        {{ $boardgame->minPlayers }}
                    </div>

                    <div class="mt-4 lg:text-lg leading-loose font-bold">
                        Giocatori Massimi:
                    </div>
                    <div class="space-y-4 lg:text-lg leading-loose">
                        {{ $boardgame->maxPlayers }}
                    </div>

                    <div class="mt-4 lg:text-lg leading-loose font-bold">
                        Categorie:
                    </div>
                    <div class="space-y-4 lg:text-lg leading-loose">
                        <ul class="px-6 list-disc">
                            @foreach ($boardgame->categories as $category)
                                <li >{{ $category->name }}</li>
                            @endforeach 
                        </ul>
                    </div>
                    @if ($boardgame->votes->count()>0)
                        <div class="mt-4 lg:text-lg leading-loose font-bold">
                            Voto: (media di {{ $boardgame->votes->count() }} voti)
                        </div>
                        <div class="space-y-4 lg:text-lg leading-loose">
                            @php
                                $sum = 0
                            @endphp
                            @foreach($boardgame->votes as $vote)
                                @php
                                    $sum = $sum + $vote->vote
                                @endphp
                            @endforeach
                                {{ round($sum/$boardgame->votes->count(), 1) }}
                        </div>
                    @endif
                </div>
                <div class="col-span-5">
                    <div class="mt-4 lg:text-lg leading-loose font-bold">
                        Descrizione:
                    </div>
                    <div class="space-y-4 lg:text-lg leading-loose text-justify">
                        {{ $boardgame->description }}
                    </div>
                </div>
            </article>
        </main>
    </section>
</x-layout>