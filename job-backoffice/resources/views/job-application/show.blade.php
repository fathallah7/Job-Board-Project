<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Application') }}
        </h2>
    </x-slot>

    <x-toast-notification />


<div class="bg-gray-50 min-h-screen flex items-center justify-center p-10">
    <div class="w-full max-w-4xl">

        <div class="mb-6">
            <a href="{{ route('job-applications.index') }}"
                class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-md">
                ← Back
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-8 space-y-6">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="text-xl font-semibold text-gray-900">{{$jobApplication->user->name}}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Job Position</p>
                    <p class="text-xl font-semibold text-gray-900">{{$jobApplication->JobVacancy->title}}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Company</p>
                    <p class="text-xl font-semibold text-gray-900">{{$jobApplication->JobVacancy->Company->name}}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Job Status</p>
                    @if ($jobApplication->status == 'accepted')
                        <span class="inline-block px-3 py-1 text-sm font-medium bg-green-100 text-green-700 rounded-full">
                            {{$jobApplication->status}}
                        </span>
                    @elseif ($jobApplication->status == 'pending')
                        <span class="inline-block px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-700 rounded-full">
                            {{$jobApplication->status}}
                        </span>
                    @else
                        <span class="inline-block px-3 py-1 text-sm font-medium bg-red-100 text-red-700 rounded-full">
                            {{$jobApplication->status}}
                        </span>
                    @endif
                </div>

                <div>
                    <p class="text-sm text-gray-500">Created At</p>
                    <p class="text-sm text-gray-700">{{$jobApplication->created_at}}</p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-4">
                <nav class="-mb-px flex space-x-8">
                    <a href="{{ route('job-applications.show', [$jobApplication->id, 'tab' => 'resume']) }}"
                        class="whitespace-nowrap pb-4 px-1 border-b-2 text-sm font-medium {{ request('tab') == 'resume' || request('tab') == '' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Resume
                    </a>
                    <a href="{{ route('job-applications.show', [$jobApplication->id, 'tab' => 'AIfeedback']) }}"
                        class="whitespace-nowrap pb-4 px-1 border-b-2 text-sm font-medium {{ request('tab') == 'AIfeedback' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        AI Feedback
                    </a>
                </nav>
            </div>

            <!-- Tabs Content -->
            <div>
                <!-- Resume Tab -->
                <div class="{{ request('tab') == 'resume' || request('tab') == '' ? 'block' : 'hidden' }}">
                    <a href="{{$jobApplication->Resume->fileUrl}}" class="p-6 text-blue-600 underline font-bold hover:text-blue-800 transition">{{$jobApplication->Resume->fileUrl}}</a>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-lg shadow-sm">
                        <div>
                            <p class="text-sm text-gray-500 mb-1 font-medium">Summary</p>
                            <p class="text-gray-700">{{ $jobApplication->resume->summary }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1 font-medium">Skills</p>
                            <p class="text-gray-700">{{ $jobApplication->resume->skills }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1 font-medium">Experience</p>
                            <p class="text-gray-700">{{ $jobApplication->resume->experience }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1 font-medium">Education</p>
                            <p class="text-gray-700">{{ $jobApplication->resume->education }}</p>
                        </div>
                    </div>
                </div>

                <!-- AI Feedback Tab -->
                <div class="{{ request('tab') == 'AIfeedback' ? 'block' : 'hidden' }}">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1 font-medium">AI Score</p>
                            <p class="text-gray-700">{{ $jobApplication->aiGeneratedScore }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1 font-medium">AI Feedback</p>
                            <p class="text-gray-700">{{ $jobApplication->aiGeneratedFeedback }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8 border-t pt-6">
                <a href="{{route('job-applications.edit', $jobApplication->id)}}"
                    class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded hover:bg-gray-200">
                    Edit
                </a>

                <form method="POST" action="{{route('job-applications.destroy', $jobApplication->id)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 rounded hover:bg-red-100">
                        Archive
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>






</x-app-layout>