<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 space-y-6">

            {{-- Alert & Create Button --}}
            <div
                class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-gray-800 shadow p-6 rounded-lg">
               {{-- Add Category Button --}}
                <a href="{{ route('category.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg shadow-md transition-all duration-200 border border-green-600 hover:border-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Category
                </a>
                <div class="space-y-1 w-full md:w-auto">
                    @if (session('success'))
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                            class="text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </p>
                    @endif
                    @if (session('danger'))
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                            class="text-sm text-red-600 dark:text-red-400">
                            {{ session('danger') }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Categories Table --}}
            <div class="bg-white dark:bg-gray-800 shadow p-6 rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Todo</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('category.edit', $category) }}"
                                        class="font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                        {{ $category->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->todos_count }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('category.edit', $category) }}"
                                            class="px-4 py-2 text-xs font-semibold text-yellow-700 bg-yellow-100 border border-yellow-400 hover:bg-yellow-200 hover:border-yellow-500 rounded transition">
                                            Edit
                                        </a>
                                       {{-- Delete Button --}}
                                        <form action="{{ route('category.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 text-xs font-semibold text-white bg-red-600 border border-red-700 hover:bg-red-700 hover:border-red-800 rounded transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No categories found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>