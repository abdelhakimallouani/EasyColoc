{{-- <x-app-layout>
<div class="max-w-xl mx-auto p-6">

    <h2 class="text-xl font-bold mb-4">
        Invitation to {{ $invitation->colocation->name }}
    </h2>

    <form method="POST"
          action="{{ route('invitations.accept',$invitation->token) }}">
        @csrf
        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Accept
        </button>
    </form>

    <form method="POST"
          action="{{ route('invitations.reject',$invitation->token) }}"
          class="mt-3">
        @csrf
        <button class="bg-red-600 text-white px-4 py-2 rounded">
            Reject
        </button>
    </form>

</div>
</x-app-layout> --}}

<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="p-8 lg:p-12 text-center">

                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-500 mb-2">Invitation Reçue</h2>
                <h1 class="text-2xl font-black text-slate-900 leading-tight mb-4">
                    Rejoindre <span class="text-indigo-600">{{ $invitation->colocation->name }}</span> ?
                </h1>
                
                <p class="text-slate-500 text-sm leading-relaxed mb-10">
                    Vous avez été invité à partager cet espace. En acceptant, vous pourrez suivre les dépenses communes et gérer votre budget avec les autres membres.
                </p>

                <div class="space-y-4">
                    <form method="POST" action="{{ route('invitations.accept', $invitation->token) }}">
                        @csrf
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition shadow-lg shadow-indigo-100 flex items-center justify-center gap-2 group">
                            <span>Accepter l'invitation</span>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('invitations.reject', $invitation->token) }}">
                        @csrf
                        <button class="w-full bg-white hover:bg-red-50 text-slate-400 hover:text-red-600 px-8 py-4 rounded-2xl font-bold transition border border-transparent hover:border-red-100 italic text-sm">
                            Refuser l'invitation
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>