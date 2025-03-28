@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary">Task List</h3>
        <a href="{{ route('tasks.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Add Task</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filter Dropdown --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('tasks.index') }}">
                <label for="status" class="form-label fw-bold">Filter by Status:</label>
                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="task-table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="task-list">
                {{-- Initial set of tasks --}}
                @foreach ($tasks as $index => $task)
                    <tr id="task-row-{{ $task->id }}" class="task-row">
                        <td class="fw-bold">{{ $index + 1 }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            <div class="ql-editor">{!! $task->description !!}</div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</td>
                        <td>
                            <select class="form-select status-change" data-task-id="{{ $task->id }}">
                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                            <button class="btn btn-danger btn-sm delete-task" data-task-id="{{ $task->id }}"><i class="bi bi-trash"></i> Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Loader --}}
    <div id="loader" class="text-center" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

{{-- Bootstrap & jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let page = 1;  // Start from the first page

        // Infinite scroll functionality
        $(window).on('scroll', function() {
            let scrollHeight = $(document).height();
            let scrollPosition = $(window).height() + $(window).scrollTop();

            if (scrollHeight - scrollPosition <= 100) {
                loadMoreTasks();  // Load more tasks when the user scrolls to the bottom
            }
        });

        // Function to load more tasks via AJAX
        function loadMoreTasks() {
            // Prevent multiple requests while loading
            if ($('#loader').is(':visible')) {
                return;
            }

            $('#loader').show(); // Show the loader

            page++;  // Increment the page number

            $.ajax({
                url: '{{ route('tasks.index') }}',  // Send an AJAX request to the controller
                data: { page: page, status: '{{ request('status') }}' }, // Include the status filter
                success: function(response) {
                    $('#loader').hide();  // Hide the loader

                    if (response.tasks.length > 0) {
                        response.tasks.forEach(function(task, index) {
                            let taskRow = `
                                <tr id="task-row-${task.id}" class="task-row">
                                    <td class="fw-bold">${(index + 1) + (page - 1) * 4}</td>
                                    <td>${task.title}</td>
                                    <td>
                                        <div class="ql-editor">${task.description}</div>
                                    </td>
                                    <td>${task.due_date}</td>
                                    <td>
                                        <select class="form-select status-change" data-task-id="${task.id}">
                                            <option value="pending" ${task.status == 'pending' ? 'selected' : ''}>Pending</option>
                                            <option value="in_progress" ${task.status == 'in_progress' ? 'selected' : ''}>In Progress</option>
                                            <option value="completed" ${task.status == 'completed' ? 'selected' : ''}>Completed</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <a href="/tasks/${task.id}/edit" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                                        <button class="btn btn-danger btn-sm delete-task" data-task-id="${task.id}"><i class="bi bi-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            `;
                            $('#task-list').append(taskRow);
                        });
                    } else {
                        // No more tasks to load
                        $(window).off('scroll');
                    }
                },
                error: function(xhr) {
                    alert('Failed to load tasks.');
                    $('#loader').hide();
                }
            });
        }

        // Task deletion with event delegation
        $('#task-list').on('click', '.delete-task', function(event) {
            event.preventDefault();
            let taskId = $(this).data('task-id');
            let taskRow = $('#task-row-' + taskId);

            if (confirm('Are you sure you want to delete this task?')) {
                $.ajax({
                    url: `/tasks/${taskId}`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        taskRow.fadeOut(500, function() {
                            $(this).remove();  // Remove the task row after fade out
                        });
                        alert('Task deleted successfully');
                    },
                    error: function(xhr) {
                        alert('Failed to delete task.');
                    }
                });
            }
        });

        // Status change handling with event delegation
        $('#task-list').on('change', '.status-change', function() {
            let taskId = $(this).data('task-id');
            let newStatus = $(this).val();

            $.ajax({
                url: `/tasks/${taskId}`,
                type: 'PATCH',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "status": newStatus,
                },
                success: function(response) {
                    alert('Task status updated successfully');
                },
                error: function(xhr) {
                    alert('Failed to update task status.');
                }
            });
        });
    });
</script>
@endsection
