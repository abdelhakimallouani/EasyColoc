<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6 lg:p-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div>
                    <nav class="flex text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-2">
                        <ol class="flex items-center space-x-2">
                            <li><a href="{{ route('colocations.show', $colocation) }}" class="hover:text-indigo-600 transition">{{ $colocation->name }}</a></li>
                            <li><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                            <li class="text-slate-800">Dépenses</li>
                        </ol>
                    </nav>
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Historique des dépenses</h2>
                </div>

                <a href="{{ route('expenses.create', $colocation) }}" 
                   class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition shadow-lg shadow-indigo-100 group">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Nouvelle dépense
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-400">
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest">Désignation</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest">Catégorie</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest">Payé par</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-right">Montant</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($expenses as $expense)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 group-hover:bg-white group-hover:shadow-sm transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                            </div>
                                            <span class="font-bold text-slate-700 tracking-tight">{{ $expense->title }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg uppercase border border-emerald-100">
                                            {{ $expense->category->name }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 text-slate-600">
                                            <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-bold text-indigo-700">
                                                {{ strtoupper(substr($expense->payer->name, 0, 1)) }}
                                            </div>
                                            <span class="text-sm font-medium">{{ $expense->payer->name }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-right font-black text-slate-900">
                                        {{ number_format($expense->amount, 2) }} <span class="text-xs text-slate-400 font-bold ml-1 text-black">DH</span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="text-xs font-bold text-slate-400">
                                            {{ \Carbon\Carbon::parse($expense->expense_date)->translatedFormat('d M Y') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="bg-slate-50 p-4 rounded-full mb-4">
                                                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                            </div>
                                            <p class="text-slate-400 font-bold tracking-tight">Aucune dépense enregistrée</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>