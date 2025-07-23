<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Vacancies') }}
        </h2>
    </x-slot>


    <x-toast-notification />

    <div class="container mx-auto px-12 py-8">
        <h1 class="text-3xl text-gray-800 font-bold text-center mb-8 mt-6">Job Vacancies</h1>

        <!-- Search and Add User (Static) -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-5 mt-8 space-y-4 md:space-y-0">

            <!-- Search Input -->
            <div class="w-full md:w-1/2">
                <input type="text" placeholder="Search job-vacancies..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-2 focus:ring-blue-200 focus:outline-none transition">
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-row flex-wrap justify-end space-x-3">

                @if (request()->archive)
                    <a href="{{ route('job-vacancies.index') }}"
                        class="inline-block px-5 py-2 border border-green-600 text-green-600 rounded-md font-medium hover:bg-green-50 transition">
                        Active
                    </a>
                @else
                    <a href="{{ route('job-vacancies.index', ['archive' => true]) }}"
                        class="inline-block px-5 py-2 border border-red-600 text-red-600 rounded-md font-medium hover:bg-red-50 transition">
                        Archive
                    </a>
                @endif

                <a href="{{ route('job-vacancies.create') }}"
                    class="inline-block px-5 py-2 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 transition">
                    + Add vacancy
                </a>

            </div>

        </div>



        <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
            <table class="w-full table-fixed text-sm text-gray-700 hidden md:table">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr class="uppercase text-xs tracking-wider text-gray-600">
                        <th class="py-3 px-4 text-left">Title</th>
                        @if (auth()->user()->role == 'admin')
                            <th class="py-3 px-4 text-left">Company</th>
                        @endif
                        <th class="py-3 px-4 text-left">Location</th>
                        <th class="py-3 px-4 text-left">Type</th>
                        <th class="py-3 px-4 text-left">Salary</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vacancies as $vacancy)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration">
                            <td class="py-3 px-4 font-medium">
                                @if (request()->archive)
                                    <span>{{ $vacancy->title }}</span>
                                @else
                                    <a href="{{ route('job-vacancies.show', $vacancy->id) }}"
                                        class="text-blue-700 hover:underline">
                                        {{ $vacancy->title }}
                                    </a>
                                @endif
                            </td>
                            @if (auth()->user()->role == 'admin')
                                <td class="py-3 px-4">{{ $vacancy->company->name }}</td>
                            @endif
                            <td class="py-3 px-4">{{ $vacancy->location }}</td>
                            <td class="py-3 px-4">{{ $vacancy->type }}</td>
                            <td class="py-3 px-4">{{ $vacancy->salary }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    @if(request()->archive)
                                        <form action="{{ route('vacancies.restore', $vacancy->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="px-3 py-1 border border-green-600 text-green-600 rounded hover:bg-green-50 transition text-xs">
                                                Restore
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('job-vacancies.edit', $vacancy->id) }}"
                                            class="px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition text-xs">
                                            Edit
                                        </a>
                                        <form action="{{ route('job-vacancies.destroy', $vacancy->id) }}" method="POST"
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
                            <td colspan="6" class="py-3 px-4 text-center text-gray-500">
                                No vacancies found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Mobile View -->
            <div class="md:hidden space-y-4 p-4">
                @forelse ($vacancies as $vacancy)
                    <div class="border rounded-lg p-4 shadow-sm bg-gray-50">
                        <div class="mb-2">
                            <strong>Title:</strong>
                            @if (request()->archive)
                                <span>{{ $vacancy->title }}</span>
                            @else
                                <a href="{{ route('job-vacancies.show', $vacancy->id) }}" class="text-blue-700 hover:underline">
                                    {{ $vacancy->title }}
                                </a>
                            @endif
                        </div>
                        @if (auth()->user()->role == 'admin')
                            <div class="mb-2">
                                <strong>Company:</strong> {{ $vacancy->company->name }}
                            </div>
                        @endif
                        <div class="mb-2">
                            <strong>Location:</strong> {{ $vacancy->location }}
                        </div>
                        <div class="mb-2">
                            <strong>Type:</strong> {{ $vacancy->type }}
                        </div>
                        <div class="mb-2">
                            <strong>Salary:</strong> {{ $vacancy->salary }}
                        </div>
                        <div class="flex justify-start space-x-2 mt-3">
                            @if(request()->archive)
                                <form action="{{ route('vacancies.restore', $vacancy->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-3 py-1 border border-green-600 text-green-600 rounded hover:bg-green-50 transition text-xs">
                                        Restore
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('job-vacancies.edit', $vacancy->id) }}"
                                    class="px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('job-vacancies.destroy', $vacancy->id) }}" method="POST"
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
                    </div>
                @empty
                    <div class="text-center text-gray-500">No vacancies found.</div>
                @endforelse
            </div>
        </div>


    </div>

</x-app-layout>