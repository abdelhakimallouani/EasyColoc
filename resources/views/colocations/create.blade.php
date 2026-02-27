<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">

        <h2 class="text-2xl font-bold mb-6">
            Ajouter Colocation
        </h2>

        <form method="POST" action="{{ route('colocations.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Nom Colocation</label>
                <input type="text"
                       name="name"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="description"
                          class="w-full border rounded p-2"></textarea>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Ajouter
            </button>

        </form>

    </div>
</x-app-layout>