<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Application - Update') }}
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
                        <p class="text-xl font-semibold text-gray-900">{{$jobApplication->JobVacancy->Company->name}}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Job Status</p>
                        @if ($jobApplication->status == 'accepted')
                            <span
                                class="inline-block px-3 py-1 text-sm font-medium bg-green-100 text-green-700 rounded-full">
                                {{$jobApplication->status}}
                            </span>
                        @elseif ($jobApplication->status == 'pending')
                            <span
                                class="inline-block px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-700 rounded-full">
                                {{$jobApplication->status}}
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 text-sm font-medium bg-red-100 text-red-700 rounded-full">
                                {{$jobApplication->status}}
                            </span>
                        @endif
                    </div>


                    <form method="POST" action="{{route('job-applications.update', $jobApplication->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ $errors->has('status') ? 'outline-red-500 outline outline-1' : '' }}">
                                <option value="pending" {{ old('status', $jobApplication->status) == 'pending' ? 'selected' : '' }}>Pending - Under Review
                                </option>
                                <option value="rejected" {{ old('status', $jobApplication->status) == 'rejected' ? 'selected' : '' }}>Rejected - Disqualified
                                </option>
                                <option value="accepted" {{ old('status', $jobApplication->status) == 'accepted' ? 'selected' : '' }}>Accepted - Qualified
                                </option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Buttons --}}
                        <div class="flex justify-end items-center gap-4 mt-6">
                            <a href="{{ route('job-applications.index') }}"
                                class="text-gray-700 hover:text-red-600 font-medium transition duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                class="rounded-md bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 text-sm font-semibold transition duration-200">
                                Save
                            </button>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>






</x-app-layout>