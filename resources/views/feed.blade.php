<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ⚖️ {{ __('Julgar a galera') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @foreach ($merdas as $merda)
                    <div class="mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-bold text-gray-900 dark:text-white">{{ $merda->user->name }}</span>
                            <span class="text-sm text-gray-500">{{ $merda->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <h4 class="text-xl font-bold text-red-600 dark:text-red-400">{{ $merda->titulo }}</h4>
                        <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $merda->descricao }}</p>
                        <p class="text-sm font-semibold text-gray-500 mt-2">Nível de Estresse original: {{ $merda->nivel_estresse }}/10</p>
                        
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-2">Escala de Azar (Pontuar):</p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2">
                                    @php
                                        $opcoesVoto = [10, 20, 50, 100, 200, 300];
                                        $meuVoto = $merda->votos->where('user_id', auth()->id())->first();
                                    @endphp

                                    @foreach($opcoesVoto as $pontos)
                                        <form action="{{ route('merdas.votar', $merda->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="pontos" value="{{ $pontos }}">
                                            <button type="submit" 
                                                @if($merda->user_id === auth()->id() || ($meuVoto && $meuVoto->mudou_voto && $meuVoto->pontos != $pontos)) disabled @endif
                                                class="px-3 py-1 rounded text-sm font-bold transition-colors
                                                @if($merda->user_id === auth()->id()) 
                                                    bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-800 dark:text-gray-600
                                                @elseif($meuVoto && $meuVoto->pontos == $pontos) 
                                                    bg-red-600 text-white hover:bg-red-700
                                                @elseif($meuVoto && $meuVoto->mudou_voto)
                                                    bg-gray-100 text-gray-300 cursor-not-allowed dark:bg-gray-800 dark:text-gray-700
                                                @else 
                                                    bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 
                                                @endif">
                                                +{{ $pontos }}
                                            </button>
                                        </form>
                                    @endforeach
                                    {{ $merdas->links() }}
                                </div>
                                
                                <div class="bg-gray-900 dark:bg-gray-950 text-white px-4 py-2 rounded-lg text-sm font-black tracking-wider">
                                    TOTAL: {{ $merda->votos->sum('pontos') }} pts
                                </div>
<div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
    <h5 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">💬 Comentários (Cornetagem livre):</h5>
    
    <!-- Lista de Comentários -->
    <div class="space-y-3 mb-4 max-h-40 overflow-y-auto pr-2">
        @foreach($merda->comentarios as $comentario)
            <div class="bg-gray-50 dark:bg-gray-700/30 p-3 rounded-lg text-sm border border-gray-100 dark:border-gray-600">
                <div class="flex justify-between items-end mb-1">
                    <span class="font-bold text-gray-800 dark:text-gray-200">{{ $comentario->user->name }}</span>
                    <span class="text-xs text-gray-500">{{ $comentario->created_at->diffForHumans() }}</span>
                </div>
                <span class="text-gray-700 dark:text-gray-300">{{ $comentario->texto }}</span>
            </div>
        @endforeach

        @if($merda->comentarios->isEmpty())
            <p class="text-xs text-gray-500 dark:text-gray-400 italic">Ninguém cornetou ainda. Seja o primeiro a rir da desgraça!</p>
        @endif
    </div>

    <form action="{{ route('merdas.comentar', $merda->id) }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="texto" placeholder="Zoa aí..." required class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:outline-none focus:border-blue-500">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition">
            Enviar
        </button>
    </form>
</div>
                            </div>
                            
                            @if($meuVoto && !$meuVoto->mudou_voto)
                                <p class="text-xs text-orange-500 mt-2 italic">* Tens direito a alterar o teu voto apenas 1 vez.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                @if($merdas->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">Ninguém se deu mal ainda. Amém!</p>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>