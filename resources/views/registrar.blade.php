<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">📝 {{ __('Registrar nova merda') }}</h2>
    </x-slot>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('merdas.store') }}" method="POST">
                @csrf
                <!-- Os campos de titulo, descrição, estresse e botão vão aqui (copia do form antigo) -->
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Título (O que rolou?)</label>
                    <input type="text" name="titulo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Descrição (Como foi essa proeza?)</label>
                    <textarea name="descricao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-900 dark:text-gray-300" required rows="3"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nível de Estresse (1 a 10)</label>
                    <input type="number" name="nivel_estresse" min="1" max="10" value="5" class="shadow appearance-none border rounded w-24 py-2 px-3 text-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                </div>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">Lançar no Sistema</button>
            </form>
        </div>
    </div>
</x-app-layout>