<x-layout>

    <x-admin-setting heading="Crea nuovo gioco">
        <form method="POST" action="/admin/boardgames" enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" label="Nome"/>

            <x-form.input label="Numero minimo di giocatori" name="minPlayers" type="number" min=1/>

            <x-form.input label="Numero massimo di giocatori" name="maxPlayers" type="number" min=1/>

            <x-form.input label="Editore" name="editor"/>

            <x-form.textarea label="Descrizione" name="description"/>

            <x-form.field>
                <x-form.label name="authors" label="Autori"/>

                <div id="authorsList">
                    @foreach ($authors as $author)
                        <input type="checkbox" name="authors_id[]"
                               value={{ $author->id }} id="author_{{ $author->id }}">
                        <label for="author_{{ $author->id }}">{{ ucwords($author->firstName . " ". $author->lastName) }}</label>
                        <br>
                    @endforeach
                </div>

                <button class="mt-2 block text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-0 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" data-modal-toggle="author-modal">
                    +
                </button>

                <x-form.error name="authors_id"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="categories" label="Categorie"/>

                <div id="categoriesList">
                    @foreach ($categories as $category)
                        <input type="checkbox" name="categories_id[]"
                               value={{ $category->id }} id="category_{{ $category->id }}">
                        <label for="category_{{ $category->id }}">{{ ucwords($category->name) }}</label><br>
                    @endforeach
                </div>

                <button class="mt-2 block text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-0 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" data-modal-toggle="category-modal">
                    +
                </button>

                <x-form.error name="categories_id"/>
            </x-form.field>

            <x-form.input label="Immagine" name="thumbnail" type="file"/>

            <x-form.button>Crea</x-form.button>
        </form>
    </x-admin-setting>

    <div id="author-modal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button id="closeAuthorModal" type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="author-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Crea nuovo autore</h3>
                    <form method="POST" class="space-y-6" action="">
                        @csrf

                        <x-form.input name="firstName" label="Nome"/>

                        <x-form.input name="lastName" label="Cognome"/>

                        <x-form.field>
                            <button type="submit"
                                    class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"
                                    id="createAuthor">
                                Crea
                            </button>
                            <button data-modal-toggle="author-modal" type="button"
                                    class="bg-gray-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-600 mx-auto">
                                Chiudi
                            </button>
                        </x-form.field>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="category-modal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button id="closeCategoryModal" type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="category-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Crea nuova categoria</h3>
                    <form method="POST" class="space-y-6" action="">
                        @csrf

                        <x-form.input name="categoryName" label="Nome"/>

                        <x-form.input name="slug" label="Slug"/>

                        <x-form.field>
                            <button type="submit"
                                    class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"
                                    id="createCategory">
                                Crea
                            </button>
                            <button data-modal-toggle="category-modal" type="button"
                                    class="bg-gray-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-600 mx-auto">
                                Chiudi
                            </button>
                        </x-form.field>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script type="text/javascript">
    $(document).ready(function () {
        $("#minPlayers").on("input", function () {
            $('#maxPlayers').attr('min', $(this).val());
        });

        $("#categoryName").on("input", function () {
            $('#slug').val($(this).val().toLowerCase().replace(/ /g, '-'));
        });

        $('#createCategory').click(function (e) {

            e.preventDefault();

            var name = $('#categoryName').val();
            var slug = $('#slug').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/admin/categories/inline',
                data: {_token: CSRF_TOKEN, name: name, slug: slug},
                success: function (response) {
                    $('#categoryName').val('');
                    $('#slug').val('');
                    $('#closeCategoryModal').click();
                    $('#categoriesList').append("<input type='checkbox' name='categories_id[]' value=" + response.id + " id='category_" + response.id + "'><label for='category_" + response.id + "'>" + response.name.charAt(0).toUpperCase() + response.name.slice(1) + "</label><br>");
                }
            })
        });

        $('#createAuthor').click(function (e) {

            e.preventDefault();

            var firstName = $('#firstName').val();
            var lastName = $('#lastName').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/admin/authors/inline',
                data: {_token: CSRF_TOKEN, firstName: firstName, lastName: lastName},
                success: function (response) {
                    $('#firstName').val('');
                    $('#lastName').val('');
                    $('#closeAuthorModal').click();
                    $('#authorsList').append("<input type='checkbox' name='authors_id[]' value=" + response.id + " id='author_" + response.id + "'><label for='author_" + response.id + "'>" + response.firstName.charAt(0).toUpperCase() + response.firstName.slice(1) + " " + response.lastName.charAt(0).toUpperCase() + response.lastName.slice(1) + "</label><br>");
                }
            })
        });
    });

</script>