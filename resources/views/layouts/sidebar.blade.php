<aside class="w-full md:w-64 bg-white border-r border-slate-200 p-6 space-y-2">

    @php
        $active = 'bg-indigo-50 text-indigo-700 font-semibold';
        $normal = 'text-slate-600 hover:bg-slate-50';
    @endphp

    <a href="{{ route('dashboard') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
       {{ request()->routeIs('dashboard') ? $active : $normal }}">

        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h7v7H3V3zM14 3h7v7h-7V3zM14 14h7v7h-7v-7zM3 14h7v7H3v-7z" />
        </svg>

        Dashboard
    </a>

    <a href="{{ route('colocations.index') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
       {{ request()->routeIs('colocations.*') ? $active : $normal }}">

        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

        Mes Colocations
    </a>

    @if (auth()->user()->isAdmin())
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition
           {{ request()->routeIs('admin.users.*') ? $active : $normal }}">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>

            Membres
        </a>
    @endif

</aside>
