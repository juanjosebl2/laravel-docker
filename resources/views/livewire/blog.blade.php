<form class="p-4 " wire:submit.prevent="save">
    <div class="mb-4">
        <input wire:model="blog.title" class="p-2 bg-gray-200 w-full" type="text" name="text" placeholder="Title...">
        @error('blog.title')
            <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="bg-indigo-700 text-white font-bold w-full rounded shadow p-2">Save</button>
</form>


