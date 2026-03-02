<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6 lg:p-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Mes Colocations</h2>
                    <p class="text-slate-500 mt-1">Gérez vos espaces partagés et suivez vos dépenses communes.</p>
                </div>

                <a href="{{ route('colocations.create') }}"
                    class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition shadow-lg shadow-indigo-100 group">
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer une colocation
                </a>
            </div>

            @if (session('error'))
                <div
                    class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl flex items-center gap-3 text-sm font-medium">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse($colocations as $colocation)
                    <div
                        class="group bg-white rounded-2xl p-2 border border-slate-100 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300">
                        <div class="p-4">

                            <div class="flex items-center h-full justify-between">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                        {{ $colocation->name }}
                                    </h3>
    
                                    <p class="text-slate-500 text-sm mt-2 line-clamp-2 min-h-[40px]">
                                        {{ $colocation->description ?? 'Aucune description fournie pour cet espace.' }}
                                    </p>

                                </div>

                                <div class="flex justify-between items-start mb-2">
                                    <span
                                        class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-lg">Actif</span>
                                </div>
                            </div>

                            <div class=" pt-6 border-t border-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-2 text-slate-600">
                                    <div class="flex -space-x-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-[10px] font-bold">
                                            JS</div>
                                        <div
                                            class="w-7 h-7 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-indigo-600">
                                            MC</div>
                                        <div
                                            class="w-7 h-7 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-slate-400">
                                            +{{ $colocation->members->count() }}</div>
                                    </div>
                                    <span class="text-xs font-semibold text-slate-400">Membres</span>
                                </div>
                            </div>

                            <a href="{{ route('colocations.show', $colocation->id) }}"
                                class="mt-2 w-full inline-flex items-center justify-center px-4 py-3 bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 font-bold text-sm rounded-2xl transition-colors">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 bg-white rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-center p-6">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Aucune colocation</h3>
                        <p class="text-slate-500 max-w-xs mx-auto mt-2">Vous n'avez pas encore créé ou rejoint de
                            colocation. Commencez par en créer une !</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</x-app-layout>
