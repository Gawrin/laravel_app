<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#0A0A0A',
                        surface: '#FAFAFF',
                        success: '#22c55e',
                        warning: '#eab308',
                        danger: '#ef4444'
                    },
                    fontFamily: {
                        montserrat: ['Montserrat', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="bg-background text-surface min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Tasks</h1>
            <a href="{{ route('tasks.create') }}" 
               class="bg-surface text-background hover:bg-opacity-90 font-semibold py-2 px-4 rounded-lg transition-colors">
                Create New Task
            </a>
        </div>

        @if (session('success'))
            <div id="notification" class="mb-6 rounded-lg p-4 text-background font-medium 
                {{ str_contains(session('success'), 'deleted') ? 'bg-danger' : 
                   (str_contains(session('success'), 'updated') ? 'bg-warning' : 'bg-success') }}">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('notification').style.display = 'none';
                }, 3000);
            </script>
        @endif

        <div class="bg-background border border-surface/10 rounded-lg shadow overflow-hidden">
            @if ($tasks->isEmpty())
                <p class="p-6 text-surface/70 text-center">No tasks found.</p>
            @else
                <ul class="divide-y divide-surface/10">
                    @foreach ($tasks as $task)
                        <li class="p-6 hover:bg-surface/5 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center flex-1 mr-4">
                                    <input type="checkbox" 
                                           class="h-5 w-5 rounded border-surface/30 bg-transparent cursor-pointer
                                                  checked:bg-success hover:checked:bg-success/80 transition-colors"
                                           {{ $task->is_completed ? 'checked' : '' }}
                                           data-task-id="{{ $task->id }}"
                                           data-url="{{ route('tasks.toggle-complete', $task) }}">
                                    <div class="ml-4">
                                        <h2 class="text-lg font-semibold">
                                            {{ $task->title }}
                                        </h2>
                                        @if ($task->description)
                                            <p class="text-surface/70 mt-1">
                                                {{ $task->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('tasks.edit', $task) }}" 
                                       class="px-4 py-2 rounded-lg bg-warning text-background font-medium 
                                              hover:bg-warning/80 transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 rounded-lg bg-danger text-surface font-medium 
                                                       hover:bg-danger/80 transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this task?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('input[type="checkbox"]').change(function() {
            const checkbox = $(this);
            const url = checkbox.data('url');
            
            $.ajax({
                url: url,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Show a brief feedback message
                    const notification = $('<div>')
                        .addClass('fixed top-4 right-4 bg-success text-background px-4 py-2 rounded-lg')
                        .text('Task status updated')
                        .appendTo('body');

                    setTimeout(() => {
                        notification.fadeOut('fast', function() {
                            $(this).remove();
                        });
                    }, 2000);
                },
                error: function() {
                    checkbox.prop('checked', !checkbox.prop('checked'));
                    // Show error message
                    const notification = $('<div>')
                        .addClass('fixed top-4 right-4 bg-danger text-surface px-4 py-2 rounded-lg')
                        .text('Error updating task status')
                        .appendTo('body');

                    setTimeout(() => {
                        notification.fadeOut('fast', function() {
                            $(this).remove();
                        });
                    }, 2000);
                }
            });
        });
    });
    </script>
</body>
</html>