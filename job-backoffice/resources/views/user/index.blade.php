<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>


    <x-toast-notification />


    <div class="container mx-auto px-12 py-8">
        <h1 class="text-3xl text-gray-800 font-bold text-center mb-8 mt-6">Job users</h1>

        <!-- Search and Add User (Static) -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-5 mt-8 space-y-4 md:space-y-0">

            <!-- Search Input -->
            <div class="w-full md:w-1/2">
                <input type="text" placeholder="Search users..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-blue-200 focus:outline-none transition">
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-row flex-wrap justify-end space-x-3">

                @if (request()->archive)
                    <a href="{{ route('users.index') }}"
                        class="inline-block px-5 py-2 border border-green-600 text-green-600 rounded-md font-medium hover:bg-green-50 transition">
                        Active
                    </a>
                @else
                    <a href="{{ route('users.index', ['archive' => true]) }}"
                        class="inline-block px-5 py-2 border border-red-600 text-red-600 rounded-md font-medium hover:bg-red-50 transition">
                        Archive
                    </a>
                @endif

            </div>

        </div>



        <!-- User Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
            <table class="w-full table-fixed text-sm text-gray-700">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr class="uppercase text-xs tracking-wider text-gray-600">
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">email</th>
                        <th class="py-3 px-4 text-left">role</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration">
                            <td class="py-3 px-4 font-medium">
                                <span>{{ $user->name }}</span>
                            </td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">{{ $user->role }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">

                                    @if(request()->archive)
                                        <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="px-3 py-1 border border-green-600 text-green-600 rounded hover:bg-green-50 transition text-xs">
                                                Restore
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition text-xs">
                                            Edit
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 border border-red-600 text-red-600 rounded hover:bg-red-50 transition text-xs">
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 px-4 text-center text-gray-500">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>