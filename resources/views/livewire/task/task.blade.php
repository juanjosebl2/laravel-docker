<div>
    <form class="p-4 " wire:submit.prevent="save">
        <div class="mb-4">
            <input wire:model="task.text" class="p-2 bg-gray-200 w-full" type="text" name="text" placeholder="Task...">
            @error('task.text')
                <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <label for="difficulty">Difficulty:</label>
        <select wire:model="task.difficulty" class="form-control" id="difficulty" name="difficulty">
            <option value=""></option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
        @error('task.difficulty')
            <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
        @enderror
        <br />
        <br />

        <button type="submit" class="bg-indigo-700 text-white font-bold w-full rounded shadow p-2">Save</button>
    </form>

    <table class="shadow-md ">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6 text-left">Difficulty</th>
                <th class="py-3 px-6 text-left">Made</th>
                <th class="py-3 px-6 text-left">Task</th>
                <th class="py-3 px-6 text-left">&nbsp;</th>
            </tr>
        </thead>

        <tbody class="text-gray-600">
            @forelse ($tasks as $task)
                <tr class="border-b border-gray-200 {{ $task->done ? 'bg-green-200' : '' }}">
                    <td class="px-4 py-2">
                        <p class="mt-4 text-lg text-gray-900">{{ $task->description }}</p>

                        @if ($task->difficulty == 'high')
                            <p class="mt-4 text-lg text-red-500">{{ strtoupper($task->difficulty) }}</p>
                        @elseif ($task->difficulty == 'medium')
                            <p class="mt-4 text-lg text-yellow-500">{{ strtoupper($task->difficulty) }}</p>
                        @else
                            <p class="mt-4 text-lg text-green-500">{{ strtoupper($task->difficulty) }}</p>
                        @endif
                    </td>
                    <td class="px-4 py-2"><input type="checkbox" wire:click="done({{ $task }})"
                            {{ $task->done ? 'checked' : '' }}></td>
                    <td class="px-4 py-2 {{ $task->done ? 'line-through' : '' }}">{{ $task->text }}</td>
                    <td class="px-4 py-2">
                        <button wire:click="edit({{ $task }})" type="button"
                            class="bg-indigo-400 px-2 py-1 text-white text-xs rounded">Edit</button>
                        <button wire:click="delete({{ $task->id }})" type="button"
                            class="bg-red-500 px-2 py-1 text-white text-xs rounded">Delete</button>
                    </td>
                </tr>
            @empty
                <h3>Dont exist</h3>
            @endforelse

        </tbody>
    </table>
</div>
