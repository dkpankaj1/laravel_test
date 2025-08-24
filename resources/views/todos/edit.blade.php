@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Todo</h1>
    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $todo->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $todo->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $todo->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="completed" class="form-label">Completed</label>
            <input type="checkbox" name="completed" id="completed" value="1" {{ $todo->completed ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
