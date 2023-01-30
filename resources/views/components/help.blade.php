<div id="help-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="closeHelpModal" type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="help-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="py-6 px-6 lg:px-8">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Hai bisogno di aiuto?</h3>
                <h6 class="mb-4 text-xs font-medium text-gray-900 dark:text-white">Qui sotto trovi la descrizione delle
                    funzionalità principali del sito</h6>
                @auth
                    @can('admin')
                        <p class="mb-4">Ciao utente admin</p>
                    @endcan

                    @cannot('admin')
                        <p class="mb-4">Ciao utente registrato</p>
                    @endcannot
                @else
                    <p class="mb-4 text-sm text-gray-700 dark:text-gray-300 text-justify">
                        Benvenuto visitatore.
                        La pagina home che hai davanti presenta una lista di immagini che corrispondo a diversi giochi
                        da tavolo. Da utente visitatore premendo sulle immagini puoi vedere i dettagli del gioco scelto.
                        Inoltre puoi in alto a destra registrarti alla piattaforma oppure accedere con il tuo account.
                    </p>
                @endauth
                <button data-modal-toggle="help-modal" type="button"
                        class="bg-gray-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-600 mx-auto">
                    Chiudi
                </button>
            </div>

        </div>
    </div>
</div>