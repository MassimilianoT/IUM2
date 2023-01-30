@props(['heading'])

<section class="py-8 max-w-7xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <ul>
                <li>
                    <a href="/admin/boardgames/create" class="{{ request()->is('admin/boardgames/create') ? 'text-blue-500' : ''}}">Aggiungi Gioco</a>
                </li>
                <li>
                    <a href="/admin/boardgames" class="{{ request()->is('admin/boardgames') ? 'text-blue-500' : ''}}">Gestisci Giochi</a>
                </li>
                <hr class="w-36 h-1 mx-auto my-2 bg-gray-100 border-0 rounded dark:bg-gray-700">

                <li>
                    <a href="/admin/authors/create" class="{{ request()->is('admin/authors/create') ? 'text-blue-500' : ''}}">Aggiungi Autore</a>
                </li>
                                <li>
                    <a href="/admin/authors" class="{{ request()->is('admin/authors') ? 'text-blue-500' : ''}}">Gestisci Autori</a>
                </li>
                <hr class="w-36 h-1 mx-auto my-2 bg-gray-100 border-0 rounded dark:bg-gray-700">

                <li>
                    <a href="/admin/categories" class="{{ request()->is('admin/categories') ? 'text-blue-500' : ''}}">Gestisci Categorie</a>
                </li>
                <li>
                    <a href="/admin/categories/create" class="{{ request()->is('admin/categories/create') ? 'text-blue-500' : ''}}">Aggiungi Categoria</a>
                </li>
                <hr class="w-36 h-1 mx-auto my-2 bg-gray-100 border-0 rounded dark:bg-gray-700">

                <li>
                    <a href="/admin/users" class="{{ request()->is('admin/users') ? 'text-blue-500' : ''}}">Gestisci Utenti</a>
                </li>
                <li>
                    <a href="/admin/plays" class="{{ request()->is('admin/plays') ? 'text-blue-500' : ''}}">Gestisci Partite</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel class="">
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>