<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('welcome'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('welcome') }}
                    </div>
                    @php
                        session()->forget('welcome');
                    @endphp
                @endif

                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="p-6">
                    <a href="{{ route('posts.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create New Post') }}
                    </a>
                    <a href="{{ route('posts.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                        {{ __('View All Posts') }}
                    </a>

                    <a href="{{ route('profile.posts.show', ['id' => Auth::id()]) }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
                        {{ __('My Posts') }}
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
