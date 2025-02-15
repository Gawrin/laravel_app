<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
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
                <h1 class="text-3xl font-bold">Edit Task</h1>
                <a href="{{ route('tasks.index') }}" 
                   class="text-surface/80 hover:text-surface transition-colors font-medium">
                    Back to Tasks
                </a>
            </div>

            <div class="bg-background border border-surface/10 rounded-lg shadow p-6">
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="title" class="block font-medium mb-2">Title</label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $task->title) }}"
                               class="w-full bg-background border border-surface/30 rounded-lg px-4 py-2
                                      focus:border-surface focus:ring focus:ring-surface/20
                                      text-surface placeholder-surface/50"
                               required>
                        @error('title')
                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block font-medium mb-2">Description</label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full bg-background border border-surface/30 rounded-lg px-4 py-2
                                         focus:border-surface focus:ring focus:ring-surface/20
                                         text-surface placeholder-surface/50">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="is_completed" 
                                   value="1"
                                   class="h-5 w-5 rounded border-surface/30 bg-transparent
                                          checked:bg-success hover:checked:bg-success/80 transition-colors"
                                   {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
                            <span class="ml-2">Mark as completed</span>
                        </label>
                        @error('is_completed')
                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-warning text-background hover:bg-warning/90 
                                       font-semibold py-2 px-6 rounded-lg transition-colors">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>