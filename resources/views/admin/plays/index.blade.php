<x-layout>
    <x-admin-setting heading="Gestisci Partite">
        <div class="flex justify-center">
            <table class="table-auto divide-y divide-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg w-full">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Gioco
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Giocatori
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vincitore
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Valida ?
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($plays as $play)
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $play->date }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $play->boardgame->name }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    @foreach($play->players as $player)
                                                        {{ $player->firstName }} {{$player->lastName}}<br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $play->winner->firstName }} {{$play->winner->lastName}}<br>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $play->valid ? 'Si' : 'No' }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($play->valid)
                                                <a href="/admin/plays/{{ $play->id }}/edit/invalidate" class="text-red-500 hover:text-red-500">Invalida</a>
                                            @else
                                                <a href="/admin/plays/{{ $play->id }}/edit/validate" class="text-blue-500 hover:text-blue-500">Valida</a>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/admin/plays/{{ $play->id }}/edit" class="text-blue-500 hover:text-blue-500">Modifica</a>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/plays/{{ $play->id }}">
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