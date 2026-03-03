<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="flex items-center justify-center gap-2 mb-4">
            <span class="text-2xl font-bold text-slate-800 tracking-tight">Escy<span class="text-indigo-600">Coloc</span></span>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-xs font-medium uppercase tracking-widest text-slate-500 mb-2 ml-1">Nom complet</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <input id="name" 
                       class="block w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-1 outline-none focus:border-indigo-500 p-4 pl-12 text-slate-800 transition" 
                       type="text" 
                       name="name" 
                       :value="old('name')" 
                       required 
                       autofocus 
                       placeholder="Jean Dupont" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold" />
        </div>

        <div>
            <label for="email" class="block text-xs font-medium uppercase tracking-widest text-slate-500 mb-2 ml-1">Adresse Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                </div>
                <input id="email" 
                       class="block w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-1 outline-none oultli focus:border-indigo-500 p-4 pl-12 text-slate-800 transition 
                       type="email" 
                       name="email" 
                       :value="old('email')" 
                       required 
                       placeholder="votre@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
        </div>

        <div>
            <label for="password" class="block text-xs font-medium uppercase tracking-widest text-slate-500 mb-2 ml-1">Mot de passe</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="password" 
                       class="block w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-1 outline-none oultli focus:border-indigo-500 p-4 pl-12 text-slate-800 transition"
                       type="password"
                       name="password"
                       required 
                       placeholder="Minimum 8 caractères" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-medium uppercase tracking-widest text-slate-500 mb-2 ml-1">Confirmer le mot de passe</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <input id="password_confirmation" 
                       class="block w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-1 outline-none oultli focus:border-indigo-500 p-4 pl-12 text-slate-800 transition"
                       type="password"
                       name="password_confirmation" 
                       required 
                       placeholder="Répétez le mot de passe" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="pt-4 space-y-4">
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2 group">
                <span>Créer mon compte</span>
            </button>

            <div class="text-center">
                <a class="text-sm text-slate-500 hover:text-indigo-600 font-semibold transition" href="{{ route('login') }}">
                    Déjà inscrit ? <span class="text-indigo-600 font-bold underline">Se connecter</span>
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>