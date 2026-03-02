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

            <form method="POST" action="{{ route('colocations.invite', $colocation->id) }}">

                @csrf

                <input type="email" name="email" placeholder="Email membre" class="w-full border rounded p-2 mb-3"
                    required>

                <button class="bg-blue-600 text-black px-4 py-2 rounded">
                    Envoyer invitation
                </button>

            </form>

        </div>


        <h3>Members</h3>

        @foreach ($members as $member)
            <div>
                {{ $member->name }} - {{ $member->pivot->role }}
            </div>
        @endforeach

        <form action="{{ route('categories.store', $colocation) }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Category name">
            <button type="submit">Add</button>
        </form>

        <h3>Categories</h3>

        @foreach ($colocation->categories as $category)
            <div>{{ $category->name }}</div>
        @endforeach

        <a href="{{ route('expenses.index', $colocation) }}">voir expenses</a>

        <form action="{{ route('settlements.generate', $colocation) }}" method="POST">
            @csrf
            <button class="btn btn-primary">
                Generate Settlements
            </button>
        </form>

        <h4>Settlements</h4>

        @foreach ($colocation->settlements as $settlement)
            <div>
                {{ $settlement->fromUser->name }}
                owes
                {{ $settlement->toUser->name }}
                :
                {{ $settlement->amount }} DH
                ({{ $settlement->status }})
                @if ($settlement->status == 'pending')
                    <form action="{{ route('settlements.paid', $settlement) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">
                            Mark as Paid
                        </button>
                    </form>
                @endif
            
            </div>
        @endforeach
    </div>
</x-app-layout>
