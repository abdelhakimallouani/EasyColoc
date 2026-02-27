<x-app-layout>

<div class="max-w-6xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-6">
        Liste des Colocations
    </h2>
    
    <a href="{{ route('colocations.create') }}" class="inline-block mb-4 bg-green-600 text-black px-4 py-2 rounded">
        Créer une colocation
    </a>

    <div class="grid md:grid-cols-2 gap-4">

    @foreach($colocations as $colocation)

        <div class="bg-white shadow rounded-xl p-5">

            <h3 class="text-xl font-semibold">
                {{ $colocation->name }}
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                {{ $colocation->description }}
            </p>

            <div class="mt-3 text-sm text-gray-600">
                👥 Members :
                {{-- {{ $colocation->members->count() }} --}}
            </div>

            <a href="{{ route('colocations.show',$colocation->id) }}"
               class="inline-block mt-4 bg-blue-600 text-black px-4 py-2 rounded">
                Voir détail
            </a>

        </div>

    @endforeach

    </div>

</div>

</x-app-layout>