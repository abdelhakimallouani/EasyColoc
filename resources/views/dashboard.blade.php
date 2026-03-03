<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        @include('layouts.sidebar')

        <main class="flex-1 p-6 lg:p-10 space-y-8 overflow-y-auto">

            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                    Welcome, {{ auth()->user()->name }} !
                </h1>
                <p class="text-slate-500 mt-1 font-medium">
                    Manage your colocations, expenses and settlements.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Total Colocations</p>
                    <h2 class="text-3xl font-black text-indigo-600 mt-2">
                        {{ auth()->user()->colocations->count() }}
                    </h2>
                </div>

                <div class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Total Expenses</p>
                    <h2 class="text-3xl font-black text-emerald-600 mt-2">
                        {{ \App\Models\Expense::whereIn('colocation_id', auth()->user()->colocations->pluck('id'))->count() }}
                    </h2>
                </div>

                <div class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Pending Settlements</p>
                    <h2 class="text-3xl font-black text-rose-500 mt-2">
                        {{ \App\Models\Settlement::where('status','pending')->whereIn('colocation_id', auth()->user()->colocations->pluck('id'))->count() }}
                    </h2>
                </div>

            </div>

            <div class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4 text-slate-800 tracking-tight">
                    Quick Actions
                </h3>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('colocations.create') }}"
                       class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                        + New Colocation
                    </a>

                    <a href="#"
                       class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
                        + Add Expense
                    </a>

                    <a href="#"
                       class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold shadow-lg shadow-slate-200 hover:bg-slate-800 transition">
                        View Settlements
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-slate-100 rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4 text-slate-800 tracking-tight">
                    Recent Expenses
                </h3>

                <div class="divide-y divide-slate-50">

                    @foreach(\App\Models\Expense::latest()->take(5)->get() as $expense)
                        <div class="py-4 flex justify-between items-center">
                            <div>
                                <p class="font-bold text-slate-800 tracking-tight">
                                    {{ $expense->title }}
                                </p>
                                <p class="text-xs font-bold text-slate-400 uppercase">
                                    {{ $expense->colocation->name }}
                                </p>
                            </div>
                            <span class="text-emerald-600 font-black">
                                {{ number_format($expense->amount, 2) }} DH
                            </span>
                        </div>
                    @endforeach

                </div>
            </div>

        </main>
    </div>
</x-app-layout>