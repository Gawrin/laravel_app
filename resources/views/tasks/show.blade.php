<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold">Task Details</h1>
                <a href="{{ route('tasks.index') }}" 
                   class="text-surface/80 hover:text-surface transition-colors font-medium">
                    Back to Tasks
                </a>
            </div>

            <div class="bg-background border border-surface/10 rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <span class="flex-shrink-0">
                            <input type="checkbox" 
                                   class="h-5 w-5 rounded border-surface/30 bg-transparent
                                          checked:bg-success cursor-not-allowed"
                                   {{ $task->is_completed ? 'checked' : '' }} 
                                   disabled>
                        </span>
                        <h2 class="ml-3 text-2xl font-semibold">
                            {{ $task->title }}
                        </h2>
                    </div>

                    @if ($task->description)
                        <div class="mt-6">
                            <h3 class="text-lg font-medium mb-2">Description</h3>
                            <p class="text-surface/80">
                                {{ $task->description }}
                            </p>
                        </div>
                    @endif

                    <div class="mt-6 text-sm text-surface/60">
                        <div class="flex items-center space-x-4">
                            <span>Created: {{ $task->created_at->format('F j, Y g:i A') }}</span>
                            @if ($task->updated_at != $task->created_at)
                                <span>&bull;</span>
                                <span>Updated: {{ $task->updated_at->format('F j, Y g:i A') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        <a href="{{ route('tasks.edit', $task) }}" 
                           class="px-6 py-2 bg-warning text-background rounded-lg font-medium
                                  hover:bg-warning/90 transition-colors">
                            Edit Task
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-6 py-2 bg-danger text-surface rounded-lg font-medium
                                           hover:bg-danger/90 transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this task?')">
                                Delete Task
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>