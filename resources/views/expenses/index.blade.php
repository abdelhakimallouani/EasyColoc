<h1>Expenses - {{ $colocation->name }}</h1>

<a href="{{ route('expenses.create', $colocation) }}">
    Add New Expense
</a>

<hr>

@foreach($expenses as $expense)
    <div>
        {{ $expense->title }} -
        {{ $expense->amount }} DH -
        {{ $expense->category->name }} -
        Paid by {{ $expense->payer->name }} |
        {{ $expense->expense_date }}
    </div>
@endforeach