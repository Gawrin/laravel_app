@extends('tasks.layout')

@section('title', 'Tasks')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold tracking-tight">Tasks</h1>
            <a href="{{ route('tasks.create') }}" 
               class="inline-flex items-center bg-surface/90 text-background hover:bg-surface px-4 py-2 
                      rounded-2xl shadow-lg transition-all duration-300 hover:scale-105 space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="font-medium">New Task</span>
            </a>
        </div>

        @if (session('success'))
            <div id="notification" class="mb-6 rounded-2xl p-4 text-background font-medium backdrop-blur-lg flex items-center space-x-2
                {{ str_contains(session('success'), 'deleted') ? 'bg-danger/90' : 
                   (str_contains(session('success'), 'updated') ? 'bg-warning/90' : 'bg-success/90') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('notification').style.display = 'none';
                }, 3000);
            </script>
        @endif

        @if ($tasks->isEmpty())
            <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-3xl shadow-lg p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto mb-4 text-surface/40">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V19.5a2.25 2.25 0 0 0 2.25 2.25h.75m0-3H21" />
                </svg>
                <p class="text-surface/70 text-lg">No tasks found. Create your first task to get started!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tasks as $task)
                    <div class="group bg-background/40 backdrop-blur-xl border border-surface/10 rounded-3xl 
                              shadow-lg overflow-hidden transition-all duration-300 hover:scale-[1.02] 
                              hover:shadow-xl hover:bg-background/50">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start space-x-3 flex-1">
                                    <div class="pt-1">
                                        <input type="checkbox" 
                                               class="form-checkbox h-5 w-5 rounded-lg border-2 border-surface/30 
                                                      bg-transparent cursor-pointer checked:bg-success checked:border-0 
                                                      hover:border-surface/50 focus:ring-2 focus:ring-success/20 
                                                      transition-all duration-200"
                                               {{ $task->is_completed ? 'checked' : '' }}
                                               data-task-id="{{ $task->id }}"
                                               data-url="{{ route('tasks.toggle-complete', $task) }}">
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-lg font-semibold leading-tight mb-2 group-hover:text-surface">
                                            {{ $task->title }}
                                        </h2>
                                        @if ($task->description)
                                            <p class="text-surface/70 text-sm group-hover:text-surface/90 line-clamp-2">
                                                {{ $task->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between mt-6 pt-4 border-t border-surface/10">
                                <div class="text-xs text-surface/60">
                                    <div class="flex items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <span>{{ $task->created_at->format('M j, Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('tasks.edit', $task) }}" 
                                       class="p-2 rounded-xl bg-warning/20 text-warning hover:bg-warning/30 
                                              transition-colors"
                                       title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-xl bg-danger/20 text-danger hover:bg-danger/30 
                                                       transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this task?')"
                                                title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('scripts')
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
                const notification = $('<div>')
                    .addClass('fixed top-4 right-4 bg-success/90 backdrop-blur-lg text-background px-4 py-2 rounded-2xl shadow-lg flex items-center space-x-2')
                    .html(`
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Task status updated</span>
                    `)
                    .appendTo('body');

                setTimeout(() => {
                    notification.fadeOut('fast', function() {
                        $(this).remove();
                    });
                }, 2000);
            },
            error: function() {
                checkbox.prop('checked', !checkbox.prop('checked'));
                const notification = $('<div>')
                    .addClass('fixed top-4 right-4 bg-danger/90 backdrop-blur-lg text-surface px-4 py-2 rounded-2xl shadow-lg flex items-center space-x-2')
                    .html(`
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <span>Error updating task status</span>
                    `)
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
@endpush