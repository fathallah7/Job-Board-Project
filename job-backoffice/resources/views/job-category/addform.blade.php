<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Category') }}
        </h2>
    </x-slot>

    <div class="p-12 max-w-3xl mx-auto">
        <form method="POST" action="{{route('job-categories.store')}}">
            @csrf
            <div class="flex flex-col gap-6 bg-white p-10 rounded-lg shadow-lg">

                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
                        Category Name
                    </label>
                    <input type="text" id="name" name="name" value="{{old('name')}}"
                        class="block w-full rounded-md border border-slate-300 bg-white px-4 py-3 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                        placeholder="e.g. Software Engineering" required />
                </div>

                <div class="flex justify-end items-center gap-4 mt-6">
                    <a href="{{route('job-categories.index')}}" class="text-gray-700 hover:text-red-600 font-medium transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="rounded-md bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 text-sm font-semibold transition duration-200">
                        Add
                    </button>
                </div>
            </div>
        </form>
        @if ($errors->any())
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>


</x-app-layout>