<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-12 text-white text-center">My Job Applications</h1>

        @forelse ($applications as $application)
            <div
                class="bg-gradient-to-r from-gray-900 to-gray-800 p-6 rounded-2xl shadow-lg mb-6 border border-gray-700 transition transform hover:scale-[1.02]">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <a href="{{ route('job-vacancies-show' , $application->JobVacancy->id) }}" class="text-xl font-semibold text-blue-400">
                            {{ $application->jobVacancy->title ?? 'Untitled Job' }}
                        </a>
                        <p class="text-sm text-gray-400">
                            Applied on {{ $application->created_at->format('M d, Y • h:i A') }}
                        </p>
                    </div>

                    <div class="text-right flex flex-col space-y-2">
                        <span class="inline-block px-4 py-1 text-sm rounded-full
                                    @if($application->status === 'pending')
                                        bg-yellow-500/10 text-yellow-400 border border-yellow-400
                                    @elseif($application->status === 'accepted')
                                        bg-green-500/10 text-green-400 border border-green-400
                                    @elseif($application->status === 'rejected')
                                        bg-red-500/10 text-red-400 border border-red-400
                                    @else
                                        bg-gray-500/10 text-gray-300 border border-gray-300
                                    @endif
                                ">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-white">
                    <div>
                        <p><strong>AI Score:</strong> {{ $application->aiGeneratedScore ?? 'Not available' }}</p>
                    </div>

                </div>
                <div class="items-center text-center">
                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-2 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 transition-all duration-300 px-5 py-2 rounded-full shadow-md hover:shadow-lg border border-red-500/50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel Request
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-400 text-lg">
                You haven’t applied to any jobs yet.
            </div>
        @endforelse
    </div>



</x-app-layout>