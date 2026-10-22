<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🏠 {{ __('Menu Principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Botão Registrar -->
                <a href="{{ route('merdas.create') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex flex-col items-center justify-center border-b-4 border-red-500">
                    <span class="text-4xl mb-3">📝</span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Registrar Merda</h3>
                    <p class="text-gray-500 text-sm mt-2 text-center">Deu ruim hoje? Conta pra galera.</p>
                </a>

                <!-- Botão Votar (Feed) -->
                <a href="{{ route('merdas.feed') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex flex-col items-center justify-center relative border-b-4 border-blue-500">
                    @if($pendentes > 0)
                        <!-- A bolinha vermelha de notificação -->
                        <span class="absolute top-4 right-4 flex h-6 w-6">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-6 w-6 bg-red-600 text-white text-xs font-bold items-center justify-center">{{ $pendentes }}</span>
                        </span>
                    @endif
                    <span class="text-4xl mb-3">⚖️</span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Votar (Feed)</h3>
                    <p class="text-gray-500 text-sm mt-2 text-center">Julgue o azar alheio.</p>
                </a>

                <!-- Botão Histórico -->
                <a href="{{ route('meu-historico') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex flex-col items-center justify-center border-b-4 border-green-500">
                    <span class="text-4xl mb-3">📖</span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Meu Histórico</h3>
                    <p class="text-gray-500 text-sm mt-2 text-center">O seu mural de lamentações.</p>
                </a>

                <!-- Botão Ranking -->
                <a href="{{ route('ranking') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex flex-col items-center justify-center border-b-4 border-yellow-500">
                    <span class="text-4xl mb-3">🏆</span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Ranking Geral</h3>
                    <p class="text-gray-500 text-sm mt-2 text-center">Quem é o mais fodido?</p>
                </a>

                <!-- Botão Conta -->
                <a href="{{ route('profile.edit') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 hover:bg-gray-50 dark:hover:bg-gray-700 transition flex flex-col items-center justify-center md:col-span-2 border-b-4 border-gray-400">
                    <span class="text-3xl mb-2">⚙️</span>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Minha Conta</h3>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>