<x-layout>
    <x-setting heading="Gestisci partite">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        @if ($votables->count()>0)
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Gioco
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($votables as $votable)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $votable->name }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form method="POST" action="/user/{{ $user->id }}/votes/{{ $votable->id }}">
                                                    @csrf

                                                    <x-form.field>
                                                        <x-form.label name="vote"/>

                                                        <select name="vote" required>
                                                            <option value=-1 disabled selected>Seleziona un voto da 1 a 10</option>
                                                            <option value=1>1</option>
                                                            <option value=2>2</option>
                                                            <option value=3>3</option>
                                                            <option value=4>4</option>
                                                            <option value=5>5</option>
                                                            <option value=6>6</option>
                                                            <option value=7>7</option>
                                                            <option value=8>8</option>
                                                            <option value=9>9</option>
                                                            <option value=10>10</option>
                                                        </select>

                                                        <x-form.error name="vote"/>
                                                    </x-form.field>

                                                    <x-form.button>Vota</x-form.button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            Hai già votato tutti i giochi a cui hai giocato e le cui partite sono state convalidate!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>