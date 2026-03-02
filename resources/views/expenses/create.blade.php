<h1>Add Expense - {{ $colocation->name }}</h1>

<form action="{{ route('expenses.store', $colocation) }}" method="POST">
    @csrf

    <input type="text" name="title" placeholder="Title">

    <input type="number" step="0.01" name="amount" placeholder="Amount">

    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <input type="date" name="expense_date">

    <button type="submit">Create</button>
</form>