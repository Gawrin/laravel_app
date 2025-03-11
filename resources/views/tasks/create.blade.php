@extends('tasks.layout')

@section('title', 'Create Task')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Create Task</h1>
            <a href="{{ route('tasks.index') }}" 
               class="text-surface/80 hover:text-surface transition-all duration-300 font-medium">
                Back to Tasks
            </a>
        </div>

        <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-2xl shadow-lg p-6">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block font-medium mb-2">Title</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           class="w-full bg-background/60 border-2 border-surface/30 rounded-xl px-4 py-2
                                  focus:border-surface focus:ring-2 focus:ring-surface/20
                                  text-surface placeholder-surface/50 transition-all duration-300"
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
                              class="w-full bg-background/60 border-2 border-surface/30 rounded-xl px-4 py-2
                                     focus:border-surface focus:ring-2 focus:ring-surface/20
                                     text-surface placeholder-surface/50 transition-all duration-300">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_completed" 
                               value="1"
                               class="form-checkbox h-5 w-5 rounded-lg border-2 border-surface/30 
                                      bg-transparent cursor-pointer checked:bg-success checked:border-0 
                                      hover:border-surface/50 focus:ring-2 focus:ring-success/20 
                                      transition-all duration-200"
                               {{ old('is_completed') ? 'checked' : '' }}>
                        <span class="ml-2">Mark as completed</span>
                    </label>
                    @error('is_completed')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-surface/90 text-background hover:bg-surface hover:scale-105
                                   shadow-lg font-semibold py-2 px-6 rounded-xl transition-all duration-300">
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection