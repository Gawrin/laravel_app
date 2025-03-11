@extends('tasks.layout')

@section('title', 'Tasks')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Tasks</h1>
        <a href="{{ route('tasks.create') }}" 
           class="bg-surface/90 text-background hover:bg-surface font-semibold py-2 px-4 rounded-xl 
                  shadow-lg transition-all duration-300 hover:scale-105">
            Create New Task
        </a>
    </div>

    @if (session('success'))
        <div id="notification" class="mb-6 rounded-xl p-4 text-background font-medium backdrop-blur-lg
            {{ str_contains(session('success'), 'deleted') ? 'bg-danger/90' : 
               (str_contains(session('success'), 'updated') ? 'bg-warning/90' : 'bg-success/90') }}">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('notification').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-2xl shadow-lg overflow-hidden">
        @if ($tasks->isEmpty())
            <p class="p-6 text-surface/70 text-center">No tasks found.</p>
        @else
            <ul class="divide-y divide-surface/10">
                @foreach ($tasks as $task)
                    <li class="p-6 hover:bg-surface/10 transition-all duration-300 ease-in-out transform hover:scale-[1.01]">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center flex-1 mr-4">
                                <input type="checkbox" 
                                       class="form-checkbox h-5 w-5 rounded-lg border-2 border-surface/30 
                                              bg-transparent cursor-pointer checked:bg-success checked:border-0 
                                              hover:border-surface/50 focus:ring-2 focus:ring-success/20 
                                              transition-all duration-200"
                                       {{ $task->is_completed ? 'checked' : '' }}
                                       data-task-id="{{ $task->id }}"
                                       data-url="{{ route('tasks.toggle-complete', $task) }}">
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold group-hover:text-surface">
                                        {{ $task->title }}
                                    </h2>
                                    @if ($task->description)
                                        <p class="text-surface/70 mt-1 group-hover:text-surface/90">
                                            {{ $task->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('tasks.edit', $task) }}" 
                                   class="px-4 py-2 rounded-xl bg-warning/90 text-background font-medium 
                                          shadow-lg hover:bg-warning hover:scale-105 transition-all duration-300">
                                    Edit
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 rounded-xl bg-danger/90 text-surface font-medium 
                                                   shadow-lg hover:bg-danger hover:scale-105 transition-all duration-300"
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
                    .addClass('fixed top-4 right-4 bg-success/90 backdrop-blur-lg text-background px-4 py-2 rounded-xl shadow-lg')
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
                const notification = $('<div>')
                    .addClass('fixed top-4 right-4 bg-danger/90 backdrop-blur-lg text-surface px-4 py-2 rounded-xl shadow-lg')
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
@endpush