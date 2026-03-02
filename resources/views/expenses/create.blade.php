<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6 lg:p-10">
            <div class="">
                <nav class="flex text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-4">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('colocations.show', $colocation) }}" class="hover:text-indigo-600 transition">{{ $colocation->name }}</a></li>
                        <li><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                        <li class="text-slate-800">Nouvelle dépense</li>
                    </ol>
                </nav>

            </div>

            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <form action="{{ route('expenses.store', $colocation) }}" method="POST" class="p-8 lg:p-10 space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Qu'avez-vous acheté ?</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </div>
                                <input type="text" name="title" placeholder="ex: Courses hebdomadaires, Facture Internet..." 
                                    class="w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-2 focus:border-indigo-500 p-4 pl-12 text-slate-800 transition shadow-sm font-medium outline-none" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Montant (DH)</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none font-bold text-slate-400 group-focus-within:text-indigo-500 outline-none">
                                        DH
                                    </div>
                                    <input type="number" step="0.01" name="amount" placeholder="0.00" 
                                        class="w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-2 focus:border-indigo-500 p-4 pl-12 text-slate-800 transition shadow-sm font-black outline-none" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Date de l'achat</label>
                                <input type="date" name="expense_date" value="{{ date('Y-m-d') }}"
                                    class="w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-2 focus:border-indigo-500 p-4 text-slate-800 transition shadow-sm font-medium outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Catégorie</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"/></svg>
                                </div>
                                <select name="category_id" class="w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-2 focus:border-indigo-500 p-4 pl-12 text-slate-800 transition shadow-sm font-medium appearance-none outline-none" required>
                                    <option value="" disabled selected>Choisir une catégorie...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                             <a href="{{ route('expenses.index', $colocation) }}" class="text-slate-600 bg-slate-100 hover:bg-slate-200 px-5 py-4 rounded-xl hover:text-slate-600 font-bold text-sm transition">
                                Annuler
                            </a>
                            <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition shadow-lg shadow-indigo-200 flex items-center gap-2 group">
                                <span>Confirmer la dépense</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>