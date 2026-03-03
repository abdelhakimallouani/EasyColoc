<x-guest-layout>
    <div class="mb-10 text-center">
        <div class="flex items-center justify-center gap-2 mb-4">
            <span class="text-2xl font-medium text-slate-800 tracking-tight">Escy<span class="text-indigo-600">Coloc</span></span>
        </div>
    </div>

    <x-auth-session-status class="mb-6 p-4 bg-indigo-50 text-indigo-700 rounded-2xl text-sm font-medium border border-indigo-100" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-medium uppercase tracking-widest text-slate-500 mb-2 ml-1">Adresse Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                </div>
                <input id="email" 
                       class="block w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-1 outline-none focus:border-indigo-500 p-4 pl-12 text-slate-800 transition" 
                       type="email" 
                       name="email" 
                       :value="old('email')" 
                       required 
                       autofocus 
                       placeholder="votre@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-2 ml-1">
                <label for="password" class="block text-xs font-medium uppercase tracking-widest text-slate-500">Mot de passe</label>
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-bold text-indigo-600 hover:text-indigo-700 transition" href="{{ route('password.request') }}">
                        {{ __('Oublié ?') }}
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="password" 
                       class="block w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-1 outline-none focus:border-indigo-500 p-4 pl-12 text-slate-800 transition"
                       type="password"
                       name="password"
                       required 
                       placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-lg border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-slate-500 font-semibold group-hover:text-slate-700 transition">{{ __('Rester connecté') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2 group">
                <span>{{ __('Se connecter') }}</span>
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-slate-500">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Créer un profil</a>
            </p>
        </div>
    </form>
</x-guest-layout>