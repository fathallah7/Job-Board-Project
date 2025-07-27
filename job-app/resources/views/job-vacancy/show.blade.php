<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="bg-gray-800 shadow-xl rounded-2xl p-8 max-w-7xl mx-auto">
            <h3 class="text-2xl font-bold text-white mb-8">Job Information</h3>


            <div class="space-y-6">

<div
    class="p-6 bg-gray-700 border border-gray-600 rounded-xl shadow hover:shadow-md transition flex flex-col gap-3">
    
    <div class="flex justify-between items-center text-gray-400 text-sm mb-2">
        <span>{{ $job->viewCount }} views</span> 
    </div>

    <div class="flex justify-between items-center">
        <div>

            <a href="{{ route('job-vacancies-show', $job->id) }}"
                class="text-xl font-bold text-blue-400 hover:text-blue-300 hover:underline">
                {{ $job->title }}
            </a>

            <p class="text-sm text-gray-300 mt-1">
                @ {{ $job->company->name }} <span class="mx-1 text-gray-500">•</span> {{ $job->location }}
            </p>
        </div>

        <span class="bg-indigo-500 text-white text-sm px-4 py-1.5 rounded-full">
            {{ $job->type }}
        </span>
    </div>

    <div class="text-sm text-gray-300 leading-relaxed">
        {{ $job->description }}
    </div>

    <div
        class="flex flex-wrap items-center justify-between gap-4 text-sm text-gray-300 border-t border-gray-600 pt-4">
        <div>
            <span class="text-white font-semibold">$ {{ number_format($job->salary) }}</span>
            <span class="text-gray-400">/ Year (Estimated total annual salary)</span>
        </div>

        <div>
            <span class="text-gray-400">Posted on:</span>
            <span class="text-white">{{ $job->created_at->format('M d, Y') }}</span>
        </div>
    </div>
</div>


            <div class="flex justify-center mt-5">
                <a href=""
                    class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold text-sm px-6 py-2 rounded-full shadow-md hover:shadow-lg transition duration-300">
                    Apply Now
                </a>
            </div>

        </div>
    </section>


</x-app-layout>