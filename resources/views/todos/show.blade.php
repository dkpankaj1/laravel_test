@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Todo Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $todo->title }}</h5>
            <p class="card-text">{{ $todo->description }}</p>
            <p class="card-text"><strong>Completed:</strong> {{ $todo->completed ? 'Yes' : 'No' }}</p>
            <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
