@extends('layouts.app')

@section('content')
    <h3>Edit Task</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="mb-3">
            <label for="editor">Description:</label>
            <div id="editor" style="height: 150px; color:white;"></div>
            <textarea name="description" id="description" class="d-none">{{ $task->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Due Date:</label>
            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}" required>
        </div>

        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize the Quill editor
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Sync the Quill editor content to the hidden textarea on text change
        quill.on('text-change', function () {
            document.getElementById('description').value = quill.root.innerHTML;
        });

        // Optionally, pre-populate the editor with existing content if there is any
        quill.root.innerHTML = document.getElementById('description').value;
    });
</script>
