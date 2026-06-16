<div>
    <h1>Todo</h1>
    <ul>
        @foreach($todos as $todo)
            <li>{{ $todo->title }} ({{ $todo->status->label() }})</li>
        @endforeach
    </ul>
</div>
