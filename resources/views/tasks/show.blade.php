@extends('tasks.layout')

@section('title', 'Task Details')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Task Details</h1>
            <a href="{{ route('tasks.index') }}" 
               class="text-surface/80 hover:text-surface transition-all duration-300 font-medium">
                Back to Tasks
            </a>
        </div>

        <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <span class="flex-shrink-0">
                        <input type="checkbox" 
                               class="form-checkbox h-5 w-5 rounded-lg border-2 border-surface/30 
                                      bg-transparent cursor-not-allowed checked:bg-success/90 
                                      focus:ring-0 transition-all duration-200"
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
                        <p class="text-surface/80 bg-background/20 p-4 rounded-xl backdrop-blur-sm">
                            {{ $task->description }}
                        </p>
                    </div>
                @endif

                <div class="mt-6 text-sm text-surface/60 bg-background/20 p-4 rounded-xl backdrop-blur-sm">
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
                       class="px-6 py-2 bg-warning/90 text-background rounded-xl font-medium shadow-lg
                              hover:bg-warning hover:scale-105 transition-all duration-300">
                        Edit Task
                    </a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-6 py-2 bg-danger/90 text-surface rounded-xl font-medium shadow-lg
                                       hover:bg-danger hover:scale-105 transition-all duration-300"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection