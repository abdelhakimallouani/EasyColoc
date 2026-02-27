<x-app-layout>
<div class="max-w-xl mx-auto p-6">

    <h2 class="text-xl font-bold mb-4">
        Invitation to {{ $invitation->colocation->name }}
    </h2>

    <form method="POST"
          action="/invitations/{{ $invitation->token }}/accept">
        @csrf
        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Accept
        </button>
    </form>

    <form method="POST"
          action="/invitations/{{ $invitation->token }}/reject"
          class="mt-3">
        @csrf
        <button class="bg-red-600 text-white px-4 py-2 rounded">
            Reject
        </button>
    </form>

</div>
</x-app-layout>