<x-layout>
    <x-admin-setting heading="Gestisci Utenti">
        <div class="flex justify-center">
            <table class="table-auto divide-y divide-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg w-full">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cognome
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Admin ?
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Attivo ?
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->firstName }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->lastName }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->username }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->isAdmin ? 'Si' : 'No' }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->isActive ? 'Si' : 'No' }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($user->isActive)
                                                <a href="/admin/users/{{ $user->id }}/edit/deactivate" class="text-blue-500 hover:text-blue-500">Disattiva</a>
                                            @else
                                                <a href="/admin/users/{{ $user->id }}/edit/activate" class="text-blue-500 hover:text-blue-500">Attiva</a>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            @if ($user->isAdmin)
                                                <a href="/admin/users/{{ $user->id }}/edit/admin_deactivate" class="text-blue-500 hover:text-blue-500">Togli <br> Admin</a>
                                            @else
                                                <a href="/admin/users/{{ $user->id }}/edit/admin_activate" class="text-blue-500 hover:text-blue-500">Rendi <br>Admin</a>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="/admin/users/{{ $user->id }}/reset_password" class="text-green-500 hover:text-green-500">Reset <br>password</a>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/users/{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-red-400 show_confirm" data-toggle="tooltip">Elimina</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    </x-admin-setting>
</x-layout>

<script type="text/javascript">

    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: 'Sei sicuro di voler eliminare questo utente?',
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

</script>