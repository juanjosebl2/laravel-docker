<div>
    <form class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8" wire:submit.prevent="save">
        <div class="mb-4">
            <input wire:model="blog.title" class="p-2 bg-gray-200 w-full" type="text" name="text" placeholder="Title...">
            @error('blog.title')
                <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <textarea wire:model="blog.description" name="message" placeholder="Description..."
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
            @error('blog.description')
                <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="bg-indigo-700 text-white font-bold w-full rounded shadow p-2">Save</button>
    </form>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @foreach ($blogs as $blog)
            <div class="p-6 flex space-x-2" style="background-color: rgb(215, 237, 243);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ $blog->user->name }}</span>
                            <small
                                class="ml-2 text-sm text-gray-600">{{ $blog->created_at->format('j M Y, g:i a') }}</small>
                        </div>
                    </div>
                    <p class="mt-4 text-lg text-gray-900">Title: {{ $blog->title }}</p>
                    <p class="mt-4 text-lg text-gray-900">Description: {{ $blog->description }}</p>
                </div>
                @if ($blog->user->is(auth()->user()))
                    <button wire:click="edit({{ $blog }})" type="button"
                        class="bg-indigo-400 px-2 py-1 text-white text-xs rounded">Edit</button>
                    <button wire:click="delete({{ $blog->id }})" type="button"
                        class="bg-red-500 px-2 py-1 text-white text-xs rounded">Delete</button>
                @endif
            </div>
        @endforeach
    </div>
</div>
