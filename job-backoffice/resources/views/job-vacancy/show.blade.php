<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Vacancies') }}
        </h2>
    </x-slot>

    <x-toast-notification />


    <div class="bg-gray-50 min-h-screen  flex items-center justify-center p-10">
        <div class="w-full max-w-4xl">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('job-vacancies.index') }}"
                    class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-md">← Back</a>
            </div>
            <div class="bg-white rounded-xl shadow-md border border-gray-200">

                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{$jobVacancy->title}}</h2>
                    <p class="text-sm text-gray-500"><b>{{'@' . $jobVacancy->company->name}} </b></p>
                    <p class="text-sm text-gray-500">Created at: {{$jobVacancy->created_at}}</p>
                </div>

                <div class="p-6 space-y-6">

                    @php
                        $items = [
                            ['label' => 'type', 'value' => $jobVacancy->type],
                            ['label' => 'description', 'value' => $jobVacancy->description],
                            ['label' => 'location', 'value' => $jobVacancy->location],
                            ['label' => 'salary', 'value' => '$ ' . $jobVacancy->salary],
                        ];
                    @endphp

                    @foreach ($items as $item)
                        <div>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">{{$item['label']}}</p>
                            <p class="text-base text-gray-700">{{$item['value']}}</p>
                        </div>
                    @endforeach


                    <div>
                        <div id="applications">
                            <table class="min-w-full bg-gray-50 rounded-lg shadow">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 text-left bg-gray-100 rounded-tl-lg">ApplicantName</th>
                                        <th class="py-2 px-4 text-left bg-gray-100">Job Title</th>
                                        <th class="py-2 px-4 text-left bg-gray-100 rounded-tr-lg">Status</th>
                                        <th class="py-2 px-4 text-left bg-gray-100 rounded-tr-lg">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jobVacancy->jobApplications as $application)
                                        <tr>
                                            <td class="py-2 px-4">{{ $application->user->name }}</td>
                                            <td class="py-2 px-4">{{ $application->aiGeneratedScore }}</td>

                                            @if ($application->status == 'accepted')
                                                <td class="py-2 px-4 text-green-700 font-bold">
                                                    {{ $application->status }}
                                                </td>
                                            @elseif ($application->status == 'pending')
                                                <td class="py-2 px-4 text-yellow-600 font-bold">
                                                    {{ $application->status }}
                                                </td>
                                            @else
                                                <td class="py-2 px-4 text-red-700 font-bold">
                                                    {{ $application->status }}
                                                </td>
                                            @endif

                                            <td class="py-2 px-4">
                                                <a href="{{ route('job-applications.show', $application->id) }}"
                                                    class="text-blue-500 hover:text-blue-700 ">View</a>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-2 px-4 text-center">No applications yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>


                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <a href="{{route('job-vacancies.edit', $jobVacancy->id)}}"
                                class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded hover:bg-gray-200">
                                Edit
                            </a>

                            <form method="POST" action="{{route('job-vacancies.destroy', $jobVacancy->id)}}">
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
        </div>




</x-app-layout>