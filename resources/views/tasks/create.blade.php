@extends('layouts.app')

@section('content')
<!-- Bootstrap & Quill Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.snow.css">

<style>
    /* Premium Card Styling */
    .card-custom {
        background: #ffffff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease-in-out;
    }

    .card-custom:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    /* Input & Select Animations */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
        background: #fff;
    }

    .form-control:hover, .form-select:hover {
        border-color: #007bff;
        transform: scale(1.02);
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 12px rgba(0, 123, 255, 0.3);
    }

    /* Button Styling */
    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        font-weight: bold;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #003f7f);
        transform: scale(1.05);
    }

    .btn-secondary {
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .btn-secondary:hover {
        background: #6c757d;
        color: white;
        transform: scale(1.05);
    }

    /* Quill Editor */
    #editor {
        border-radius: 8px;
        min-height: 150px;
        border: 1px solid rgba(0, 0, 0, 0.15);
        padding: 10px;
        background: white;
        transition: 0.3s ease-in-out;
    }

    #editor:hover {
        border-color: #007bff;
        transform: scale(1.01);
    }
</style>

<div class="container mt-4">
    <div class="card card-custom">
        <h3 class="text-center mb-3 text-primary">🚀 Create a New Task</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">📌 Task Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Enter task title" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📝 Description:</label>
                <div id="editor"></div>
                <input type="hidden" name="description" id="description">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📅 Due Date:</label>
                <input type="date" name="due_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">⚡ Task Status:</label>
                <select name="status" class="form-select" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">🔙 Back</a>
                <button type="submit" class="btn btn-primary">💾 Save Task</button>
            </div>
        </form>
    </div>
</div>

<!-- Load Quill editor -->
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var quill = new Quill('#editor', { theme: 'snow' });
        quill.on('text-change', function () {
            document.getElementById('description').value = quill.root.innerHTML;
        });
    });
</script>
@endsection
