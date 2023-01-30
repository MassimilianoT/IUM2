<x-layout>

    <x-admin-setting :heading="'Modifica Gioco: ' . $boardgame->name">
        <form method="POST" action="/admin/boardgames/{{ $boardgame->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name', $boardgame->name)"/>

            <x-form.input name="minPlayers" type="number" min=1 :value="old('minPlayers', $boardgame->minPlayers)" />

            <x-form.input name="maxPlayers" type="number" min=1 :value="old('maxPlayers', $boardgame->maxPlayers)" />

            <x-form.input name="editor" :value="old('editor', $boardgame->editor)" />

            <x-form.textarea name="description">{{ old('description', $boardgame->description) }}</x-form.textarea>

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $boardgame->thumbnail)"/>
                </div>
                <img src="{{ asset('storage/' . $boardgame->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>

            <x-form.field>
                <x-form.label name="authors"/>

                @foreach ($authors as $author)
                    @php
                        $found = false;
                    @endphp
                    @foreach($boardgame->authors as $board_author)
                        @if ($board_author->id == $author->id)
                            @php
                                $found = true;
                            @endphp
                        @endif
                    @endforeach
                    <input type="checkbox" name="authors_id[]" value={{ $author->id }} id="author_{{ $author->id }}" {{ $found == true ? 'checked' : '' }}>
                    <label for="author_{{ $author->id }}">{{ ucwords($author->firstName . " ". $author->lastName) }}</label><br>
                @endforeach

                <x-form.error name="authors_id"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="categories"/>

                @foreach ($categories as $category)
                    @php
                        $found = false;
                    @endphp
                    @foreach($boardgame->categories as $board_category)
                        @if ($board_category->id == $category->id)
                            @php
                                $found = true;
                            @endphp
                        @endif
                    @endforeach
                    <input type="checkbox" name="categories_id[]" value={{ $category->id }} id="category_{{ $category->id }}" {{ $found ? 'checked' : '' }}>
                    <label for="category_{{ $category->id }}">{{ ucwords($category->name) }}</label><br>
                @endforeach

                <x-form.error name="categories_id"/>
            </x-form.field>


            <x-form.button>Aggiorna</x-form.button>

        </form>
    </x-admin-setting>
</x-layout>