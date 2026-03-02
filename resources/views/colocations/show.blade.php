<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        @include('layouts.sidebar')

        <main class="flex-1 p-6 lg:p-10 space-y-8 overflow-y-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $colocation->name }}</h2>
                    <p class="text-slate-500 mt-1">{{ $colocation->description ?? 'Aucune description disponible' }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <form action="{{ route('settlements.generate', $colocation) }}" method="POST">
                        @csrf
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-2xl font-bold transition shadow-lg shadow-indigo-100 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Générer Bilans
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-slate-800">
                <div class="lg:col-span-2 space-y-8">

                    <section class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                            <h3 class="font-bold text-slate-800 uppercase tracking-widest text-xs">Membres de la
                                colocation</h3>
                            <span
                                class="px-3 py-1 bg-white border border-slate-200 rounded-full text-[10px] font-bold text-slate-500">{{ count($members) }}
                                Utilisateurs</span>
                        </div>
                        <div class="p-6 divide-y divide-slate-100">
                            @foreach ($members as $member)
                                <div class="py-4 flex items-center justify-between first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 leading-none">{{ $member->name }}</p>
                                            <p class="text-xs text-slate-400 mt-1">{{ $member->email }}</p>
                                        </div>
                                    </div>
                                    <span
                                        class="px-3 py-1 {{ $member->pivot->role == 'owner' ? 'bg-amber-50 text-amber-600' : 'bg-slate-100 text-slate-600' }} text-[10px] font-bold rounded-full uppercase">
                                        {{ $member->pivot->role }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-6 border-b border-slate-50 bg-slate-50/30">
                            <h3 class="font-bold text-slate-800 uppercase tracking-widest text-xs">Règlements en attente
                            </h3>
                        </div>
                        <div class="p-6">
                            @forelse ($colocation->settlements as $settlement)
                                <div
                                    class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-slate-50 rounded-2xl mb-3 border border-slate-100 gap-4">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="font-semibold text-slate-700">{{ $settlement->fromUser->name }}</span>
                                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                        <span
                                            class="font-semibold text-slate-700">{{ $settlement->toUser->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-4 justify-between sm:justify-end">
                                        <div class="text-lg font-black text-indigo-600">{{ $settlement->amount }} DH
                                        </div>
                                        @if ($settlement->status == 'pending')
                                            <form action="{{ route('settlements.paid', $settlement) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button
                                                    class="bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-600 px-4 py-2 rounded-xl text-xs font-bold transition">
                                                    Marquer payé
                                                </button>
                                            </form>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full uppercase italic">Payé</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p
                                    class="text-center py-6 text-slate-400 text-sm italic border-2 border-dashed border-slate-100 rounded-2xl">
                                    Aucun règlement à effectuer pour le moment.</p>
                            @endforelse
                        </div>
                    </section>
                </div>

                <div class="space-y-8 text-slate-800">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-slate-800 mb-4 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Inviter un membre
                        </h3>
                        <form method="POST" action="{{ route('colocations.invite', $colocation->id) }}"
                            class="space-y-4">
                            @csrf
                            <input type="email" name="email" placeholder="Email du futur colocataire"
                                class="w-full bg-slate-50 border-slate-100 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-3 text-sm"
                                required>
                            <button
                                class="w-full bg-slate-900 text-white px-4 py-3 rounded-xl font-bold text-sm hover:bg-slate-800 transition">
                                Envoyer l'invitation
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-slate-800 mb-4 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01" />
                            </svg>
                            Catégories de dépense
                        </h3>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($colocation->categories as $category)
                                <span
                                    class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-lg text-xs font-semibold border border-emerald-100 uppercase tracking-tight">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        <form action="{{ route('categories.store', $colocation) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="name" placeholder="Nouvelle cat."
                                class="flex-1 bg-slate-50 border-slate-100 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 p-3 text-sm"
                                required>
                            <button type="submit"
                                class="bg-emerald-600 text-white p-3 rounded-xl hover:bg-emerald-700 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>
