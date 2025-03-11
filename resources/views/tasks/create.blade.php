@extends('tasks.layout')

@section('title', 'Create Task')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-4xl font-bold tracking-tight">Create Task</h1>
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

        <div class="bg-background/40 backdrop-blur-xl border border-surface/10 rounded-3xl shadow-lg p-8">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="title" class="flex items-center space-x-2 text-lg font-medium mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span>Title</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               class="w-full bg-background/60 border-2 border-surface/30 rounded-2xl px-4 py-3
                                      focus:border-surface focus:ring-2 focus:ring-surface/20
                                      text-surface placeholder-surface/50 transition-all duration-300"
                               required>
                    </div>
                    @error('title')
                        <p class="flex items-center space-x-1 text-danger text-sm mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="flex items-center space-x-2 text-lg font-medium mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                        </svg>
                        <span>Description</span>
                    </label>
                    <div class="relative">
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full bg-background/60 border-2 border-surface/30 rounded-2xl px-4 py-3
                                         focus:border-surface focus:ring-2 focus:ring-surface/20
                                         text-surface placeholder-surface/50 transition-all duration-300">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="flex items-center space-x-1 text-danger text-sm mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="flex items-center group cursor-pointer">
                        <input type="checkbox" 
                               name="is_completed" 
                               value="1"
                               class="form-checkbox h-5 w-5 rounded-lg border-2 border-surface/30 
                                      bg-transparent cursor-pointer checked:bg-success checked:border-0 
                                      hover:border-surface/50 focus:ring-2 focus:ring-success/20 
                                      transition-all duration-200"
                               {{ old('is_completed') ? 'checked' : '' }}>
                        <div class="ml-2 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                                 stroke="currentColor" class="w-5 h-5 text-surface/70 group-hover:text-surface transition-colors">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="text-surface/70 group-hover:text-surface transition-colors">Mark as completed</span>
                        </div>
                    </label>
                    @error('is_completed')
                        <p class="flex items-center space-x-1 text-danger text-sm mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex items-center space-x-2 bg-surface/90 text-background hover:bg-surface 
                                   shadow-lg font-medium py-3 px-6 rounded-2xl transition-all duration-300 
                                   hover:scale-105 focus:ring-2 focus:ring-surface/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Create Task</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection