<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📖 {{ __('Meu Diário de Tragédias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Tudo que já deu errado pra mim</h3>

                <div class="space-y-6">
                    @forelse ($minhasMerdas as $merda)
                        <div class="border-l-4 border-red-500 pl-4 py-2 bg-gray-50 dark:bg-gray-700/30 rounded-r-lg">
                            <div class="flex justify-between items-center mb-1">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $merda->titulo }}</h4>
                                <span class="text-sm font-semibold text-gray-500 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">
                                    {{ $merda->created_at->format('d/m/Y \à\s H:i') }}
                                </span>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 mb-3">{{ $merda->descricao }}</p>
                            
                            <div class="flex space-x-4 text-sm font-bold text-gray-600 dark:text-gray-400">
                                <span>Estresse original: <span class="text-red-500">{{ $merda->nivel_estresse }}/10</span></span>
                                <span>Pontos de azar acumulados: <span class="text-red-500">{{ $merda->votos->sum('pontos') }} pts</span></span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Você ainda não relatou nenhuma desgraça. Tá com sorte!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>