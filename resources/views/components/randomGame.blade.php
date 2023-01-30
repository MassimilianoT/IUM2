<div id="search-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="closeSearchModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-toggle="search-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Fatti consigliare un gioco!</h3>
                <h6 class="mb-4 text-xs font-medium text-gray-900 dark:text-white">Se vuoi, inserisci qui sotto dei
                    filtri per consigliarti un gioco adatto!</h6>
                <form method="POST" class="space-y-6" action="/boardgames/random">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />

                    <x-form.field>
                        <x-form.label name="category" />

                        <select name="category_id">
                            <option value=-1 selected>Seleziona una categoria</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                            @endforeach
                        </select>

                        <x-form.error name="category" />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label name="author" />

                        <select name="author_id">
                            <option value=-1 selected>Seleziona un autore</option>
                            @foreach (\App\Models\Author::all() as $author)
                                <option value="{{ $author->id }}">
                                    {{ ucwords($author->firstName . ' ' . $author->lastName) }}</option>
                            @endforeach
                        </select>

                        <x-form.error name="author" />
                    </x-form.field>

                    <x-form.input label="Giocatori" name="players" type="number" min=1 />

                    <x-form.field>
                        <button type="submit"
                            class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"
                            id="Cerca">
                            Cerca
                        </button>
                        <button data-modal-toggle="search-modal" type="button"
                            class="bg-gray-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-600 mx-auto">
                            Chiudi
                        </button>
                    </x-form.field>

                </form>
            </div>
        </div>
    </div>
</div>
