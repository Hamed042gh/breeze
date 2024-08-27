<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
        class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Online
        Users</button>
    <div x-show="open" @click.away="open = false"
        class="absolute bg-white border border-gray-300 shadow-md rounded-md mt-2 w-48">
        <ul class="py-2">
            @forelse ($onlineUsers as $user)
                <li class="px-4 py-2 flex items-center hover:bg-gray-100">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500 mr-2"></span>
                    {{ $user->name }}
                </li>
            @empty
                <li class="px-4 py-2 text-gray-500">No users online.</li>
            @endforelse
        </ul>
    </div>
</div>
