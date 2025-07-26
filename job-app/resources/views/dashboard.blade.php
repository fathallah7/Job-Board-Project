<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="bg-gray-800 shadow-xl rounded-2xl p-8 max-w-7xl mx-auto">
            <h3 class="text-2xl font-bold text-white mb-8">Welcome back, {{auth()->user()->name}} !</h3>

            <!-- Search & Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <form action="{{ route('dashboard') }}" method="GET" class="flex w-full md:w-1/3">
                    <input name="search" value=" {{ request('search') }} " type="text" placeholder="Search for a job"
                        class=" text-white w-full p-2.5 rounded-l-lg border border-gray-600 bg-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2.5 rounded-r-lg hover:bg-indigo-700 transition">Search</button>

                    @if (request('filter'))
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                    @endif

                    @if (request('search'))
                        <a href="{{ route('dashboard', ['filter' => request('filter')]) }}"
                            class="text-indigo-300 px-4 py-2 rounded-lg hover:text-white transition">
                            Clear</a>
                    @endif

                </form>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('dashboard', ['filter' => 'Full-Time', 'search' => request('search')]) }}"
                        class="bg-indigo-700/20 text-indigo-300 px-4 py-2 rounded-lg hover:bg-indigo-700/30 transition">
                        Full-Time</a>
                    <a href="{{ route('dashboard', ['filter' => 'Remote', 'search' => request('search')]) }}"
                        class="bg-indigo-700/20 text-indigo-300 px-4 py-2 rounded-lg hover:bg-indigo-700/30 transition">
                        Remote</a>
                    <a href="{{ route('dashboard', ['filter' => 'Hybrid', 'search' => request('search')]) }}"
                        class="bg-indigo-700/20 text-indigo-300 px-4 py-2 rounded-lg hover:bg-indigo-700/30 transition">
                        Hybrid</a>
                    <a href="{{ route('dashboard', ['filter' => 'Contract', 'search' => request('search')]) }}"
                        class="bg-indigo-700/20 text-indigo-300 px-4 py-2 rounded-lg hover:bg-indigo-700/30 transition">
                        Contract</a>
                    @if (request('filter'))
                        <a href="{{ route('dashboard') }}"
                            class="text-indigo-300 px-4 py-2 rounded-lg hover:text-white transition">
                            Clear</a>
                    @endif
                </div>
            </div>

            <!-- Job Listings -->
            <div class="space-y-6">

                @forelse ($jobs as $job)
                    <div
                        class="p-6 bg-gray-700 border border-gray-600 rounded-xl shadow hover:shadow-md transition flex justify-between items-center">
                        <div>
                            <h4 class="text-lg font-semibold text-indigo-200">{{$job->title}}</h4>
                            <p class="text-sm text-gray-400">{{'@' . $job->company->name }}</p>
                            <p class="text-sm text-gray-400">{{$job->location}}</p>
                            <p class="text-sm text-gray-400">$ {{ number_format($job->salary) }} / Year</p>
                        </div>
                        <span class="bg-indigo-500 text-white text-sm px-4 py-1.5 rounded-full">{{$job->type}}</span>
                    </div>
                @empty
                    <p class="text-white text-2xl font-bold">No jobs found!</p>
                @endforelse
                <div class="mt-6">
                    {{$jobs->links()}}
                </div>

            </div>

        </div>
    </section>




</x-app-layout>