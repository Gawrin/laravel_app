@extends('tasks.layout')

@section('title', 'Task Details')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-4xl font-bold tracking-tight">Task Details</h1>
            <a href="{{ route('tasks.index') }}" 
               class="inline-flex items-center text-surface/80 hover:text-surface 
                      transition-all duration-300 font-medium group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                     class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Tasks
            </a>
        </div>

        <div class="grid gap-6">
            <!-- Main Task Info Card -->
            <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-3xl shadow-lg p-8">
                <div class="flex items-center mb-6">
                    <span class="flex-shrink-0">
                        <input type="checkbox" 
                               class="form-checkbox h-6 w-6 rounded-lg border-2 border-surface/30 
                                      bg-transparent cursor-not-allowed checked:bg-success/90 
                                      focus:ring-0 transition-all duration-200"
                               {{ $task->is_completed ? 'checked' : '' }} 
                               disabled>
                    </span>
                    <h2 class="ml-4 text-2xl font-semibold">
                        {{ $task->title }}
                    </h2>
                </div>

                @if ($task->description)
                    <div class="mt-6">
                        <h3 class="flex items-center space-x-2 text-lg font-medium mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                            <span>Description</span>
                        </h3>
                        <div class="bg-background/20 backdrop-blur-sm rounded-2xl p-4">
                            <p class="text-surface/80 leading-relaxed">
                                {{ $task->description }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Timestamps Card -->
            <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-3xl shadow-lg p-6">
                <h3 class="flex items-center space-x-2 text-lg font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Timeline</span>
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-background/20 backdrop-blur-sm rounded-2xl p-4">
                        <div class="text-sm text-surface/60 mb-1">Created</div>
                        <div class="font-medium">{{ $task->created_at->format('F j, Y') }}</div>
                        <div class="text-xs text-surface/50">{{ $task->created_at->format('g:i A') }}</div>
                    </div>
                    @if ($task->updated_at != $task->created_at)
                        <div class="bg-background/20 backdrop-blur-sm rounded-2xl p-4">
                            <div class="text-sm text-surface/60 mb-1">Last Updated</div>
                            <div class="font-medium">{{ $task->updated_at->format('F j, Y') }}</div>
                            <div class="text-xs text-surface/50">{{ $task->updated_at->format('g:i A') }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions Card -->
            <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-3xl shadow-lg p-6">
                <h3 class="flex items-center space-x-2 text-lg font-medium mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span>Actions</span>
                </h3>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('tasks.edit', $task) }}" 
                       class="flex-1 inline-flex items-center justify-center space-x-2 bg-warning/90 text-background 
                              py-3 px-6 rounded-2xl font-medium shadow-lg hover:bg-warning 
                              hover:scale-105 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span>Edit Task</span>
                    </a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center space-x-2 bg-danger/90 text-surface 
                                       py-3 px-6 rounded-2xl font-medium shadow-lg hover:bg-danger 
                                       hover:scale-105 transition-all duration-300"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            <span>Delete Task</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection