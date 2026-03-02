<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6 lg:p-10">

            <div class="max-w-3xl mx-auto">
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl flex items-center gap-3 text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <form method="POST" action="{{ route('colocations.store') }}" class="p-8 space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nom de la colocation</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a11 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       placeholder="ex: Appartement" 
                                       class="w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 p-4 pl-12 text-slate-800 transition shadow-sm"
                                       required>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-bold text-slate-700 mb-2 ml-1">Description (Optionnel)</label>
                            <textarea name="description" 
                                      id="description"
                                      rows="4" 
                                      placeholder="Précisez l'adresse ou les règles de base..."
                                      class="w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 p-4 text-slate-800 transition shadow-sm"></textarea>
                        </div>

                        <div class="pt-4 flex items-center justify-between gap-4">
                            <a href="{{ route('colocations.index') }}" class="text-slate-600 bg-slate-100 hover:bg-slate-200 px-5 py-4 rounded-xl hover:text-slate-600 font-bold text-sm transition">
                                Annuler
                            </a>
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-4 rounded-xl font-bold transition  flex items-center gap-2">
                                <span>Créer</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>