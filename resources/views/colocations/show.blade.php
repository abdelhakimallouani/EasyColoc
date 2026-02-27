<x-app-layout>
<div class="max-w-4xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">
        {{ $colocation->name }}
    </h2>

    <p class="text-gray-600 mb-6">
        {{ $colocation->description }}
    </p>

    <div class="bg-white shadow p-6 rounded">

        <h3 class="text-lg font-semibold mb-4">
            Ajouter un membre (Invitation)
        </h3>

        <form method="POST"
              action="{{ route('colocations.invite',$colocation->id) }}">

            @csrf

            <input type="email"
                   name="email"
                   placeholder="Email membre"
                   class="w-full border rounded p-2 mb-3"
                   required>

            <button class="bg-blue-600 text-black px-4 py-2 rounded">
                Envoyer invitation
            </button>

        </form>

    </div>

</div>
</x-app-layout>