<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🏆 {{ __('Ranking da Desgraça') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Ranking do Mês -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-red-500">
                <h3 class="text-xl font-black text-gray-900 dark:text-gray-100 mb-6 text-center">🔥 Fudido do Mês</h3>
                
                <div class="space-y-4">
                    @foreach ($rankingMes as $index => $user)
                        <div class="flex items-center justify-between p-3 rounded-lg {{ $index === 0 ? 'bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800' : 'bg-gray-50 dark:bg-gray-700/50' }}">
                            <div class="flex items-center space-x-3">
                                <span class="text-lg font-bold text-gray-500 dark:text-gray-400">#{{ $index + 1 }}</span>
                                <span class="font-bold text-gray-900 dark:text-white {{ $index === 0 ? 'text-red-600 dark:text-red-400' : '' }}">{{ $user->name }}</span>
                            </div>
                            <span class="font-black text-gray-700 dark:text-gray-300">{{ $user->votos_recebidos_sum_pontos ?? 0 }} pts</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Ranking Geral -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-gray-800 dark:border-gray-500">
                <h3 class="text-xl font-black text-gray-900 dark:text-gray-100 mb-6 text-center">💀 Azarado de Todos os Tempos</h3>
                
                <div class="space-y-4">
                    @foreach ($rankingGeral as $index => $user)
                        <div class="flex items-center justify-between p-3 rounded-lg {{ $index === 0 ? 'bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600' : 'bg-gray-50 dark:bg-gray-700/50' }}">
                            <div class="flex items-center space-x-3">
                                <span class="text-lg font-bold text-gray-500 dark:text-gray-400">#{{ $index + 1 }}</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $user->name }}</span>
                            </div>
                            <span class="font-black text-gray-700 dark:text-gray-300">{{ $user->votos_recebidos_sum_pontos ?? 0 }} pts</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>