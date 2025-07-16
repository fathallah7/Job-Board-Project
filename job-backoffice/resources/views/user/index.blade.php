<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>


    <x-toast-notification />

    <div class="container mx-auto px-12 py-8">
        <h1 class="text-3xl text-gray-800 font-bold text-center mb-8 mt-6">Users</h1>

        <!-- Search and Add User (Static) -->
        <div class="flex flex-col-reverse md:flex-row justify-between items-center mb-3 mt-5">
            <div class="w-full md:w-1/2 md:mb-0">
                <input type="text" placeholder="Search users..."
                    class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex flex-row space-x-4">
                @if (request()->archive)
                    <a href="{{route('users.index')}}"
                        class="bg-green-500 text-white px-4 py-2 my-3 rounded-md hover:bg-green-800 transition duration-300">
                        Active
                    </a>
                @else
                    <a href="{{route('users.index', ['archive' => true])}}"
                        class="bg-red-500 text-white px-4 py-2 my-3 rounded-md hover:bg-red-800 transition duration-300">
                        Archive
                    </a>
                @endif
                
            </div>

        </div>


        <!-- User Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->role }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-2">
                                    @if (request()->archive)
                                        <form action="{{route('users.restore', $user->id)}}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-green-500 hover:text-green-700">🔄
                                                Restore</button>
                                        </form>
                                    @else
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-blue-500 hover:scale-110">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:scale-110">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-3 px-6 text-center">No data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>