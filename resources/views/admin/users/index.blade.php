<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6 lg:p-10">
            <div class="mb-8">
                <h2 class="text-3xl font-medium text-slate-900 tracking-tight mb-2">Gestion des utilisateurs</h2>
                <p class="text-slate-500 font-medium">Administrez les membres de la plateforme et gérez les accès.</p>
            </div>

            <div class="bg-white shadow-sm border border-slate-100 rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-400">
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest">Nom</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest">Email</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-center">Rôle</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-center">Réputation</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-slate-800 tracking-tight">{{ $user->name }}</span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="text-slate-500 font-medium">{{ $user->email }}</span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 text-[10px] font-black uppercase bg-slate-100 text-slate-600 rounded-lg border border-slate-200">
                                            {{ $user->role }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="font-black {{ $user->reputation >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                            {{ $user->reputation > 0 ? '+' : '' }}{{ $user->reputation }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($user->is_banned)
                                            <span class="px-3 py-1 text-[10px] font-black uppercase bg-rose-50 text-rose-600 rounded-lg border border-rose-100">
                                                Banni
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-[10px] font-black uppercase bg-emerald-50 text-emerald-600 rounded-lg border border-emerald-100">
                                                Actif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        @if(auth()->id() !== $user->id)
                                            <form method="POST" action="{{ route('admin.users.toggleBan', $user) }}" class="inline-block">
                                                @csrf
                                                @method('PATCH')

                                                <button class="px-4 py-2 text-xs font-bold rounded-xl transition shadow-sm
                                                    {{ $user->is_banned 
                                                        ? 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-100' 
                                                        : 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-100' }}">
                                                    {{ $user->is_banned ? 'Débloquer' : 'Bannir' }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-slate-400 text-xs font-bold italic pr-4">C'est vous</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>