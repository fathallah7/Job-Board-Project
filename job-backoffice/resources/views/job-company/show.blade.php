<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Companies') }}
        </h2>
    </x-slot>

    <x-toast-notification />


    <div class="bg-gray-50 min-h-screen  flex items-center justify-center p-10">
        <div class="w-full max-w-4xl">

            <!-- Back Button -->
            @if (auth()->user()->role == 'admin')
                <div class="mb-6">
                    <a href="{{ route('companies.index') }}"
                        class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-md">← Back</a>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-md border border-gray-200">

                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{$company->name}}</h2>
                    <p class="text-sm text-gray-500">Created at: {{$company->created_at}}</p>
                    <p class="text-sm text-gray-500">Owner: {{$company->owner->name}}</p>
                    <p class="text-sm text-blue-400">{{$company->owner->email}}</p>
                </div>

                <div class="p-6 space-y-6">

                    @php
                        $items = [
                            ['label' => 'Industry', 'value' => $company->industry],
                            ['label' => 'Address', 'value' => $company->address],
                            ['label' => 'Website', 'value' => $company->website, 'link' => true],
                        ];
                    @endphp

                    @foreach ($items as $item)
                        <div>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">{{$item['label']}}</p>
                            @if(isset($item['link']))
                                <a href="{{$item['value']}}" target="_blank"
                                    class="text-base font-medium text-blue-600 hover:underline break-all">{{$item['value']}}</a>
                            @else
                                <p class="text-base text-gray-700">{{$item['value']}}</p>
                            @endif
                        </div>
                    @endforeach

                    <!-- Tabs Navigation -->
                    @if (auth()->user()->role == 'admin')
                        <div class="mb-6">
                            <ul class="flex space-x-4">
                                <li>
                                    <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'jobs']) }}"
                                        class="px-4 py-2 text-gray-800 font-semibold {{ request('tab') == 'jobs' || request('tab') == '' ? 'border-b-2 border-blue-500' : '' }}">Jobs</a>
                                </li>
                                <li>
                                    <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'applications']) }}"
                                        class="px-4 py-2 text-gray-800 font-semibold {{ request('tab') == 'applications' ? 'border-b-2 border-blue-500' : '' }}">Applications</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div>
                            <!-- Jobs Tab -->
                            <div id="jobs"
                                class="{{ request('tab') == 'jobs' || request('tab') == '' ? 'block' : 'hidden' }}">
                                <table class="min-w-full bg-gray-50 rounded-lg shadow">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 text-left bg-gray-100 rounded-tl-lg">Title</th>
                                            <th class="py-2 px-4 text-left bg-gray-100">Type</th>
                                            <th class="py-2 px-4 text-left bg-gray-100">Location</th>
                                            <th class="py-2 px-4 text-left bg-gray-100 rounded-tr-lg">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($company->jobVacancy as $job)
                                            <tr>
                                                <td class="py-2 px-4">{{ $job->title }}</td>
                                                <td class="py-2 px-4">{{ $job->type }}</td>
                                                <td class="py-2 px-4">{{ $job->location }}</td>
                                                <td class="py-2 px-4">
                                                    <a href="{{ route('job-vacancies.show', $job->id) }}"
                                                        class="text-blue-500 hover:text-blue-700 underline">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Applications Tab -->
                            <div id="applications" class="{{ request('tab') == 'applications' ? 'block' : 'hidden' }}">
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
                                        @foreach ($company->jobApplication as $application)
                                            <tr>
                                                <td class="py-2 px-4">{{ $application->user->name }}</td>
                                                <td class="py-2 px-4">{{ $application->jobVacancy->title }}</td>
                                                <td class="py-2 px-4">{{ $application->status }}</td>
                                                <td class="py-2 px-4">
                                                    <a href="{{ route('job-applications.show', $application->id) }}"
                                                        class="text-blue-500 hover:text-blue-700 underline">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                        @if (auth()->user()->role == 'admin')
                            <a href="{{route('companies.edit', $company->id)}}"
                                class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded hover:bg-gray-200">
                                Edit
                            </a>
                        @else
                            <a href="{{route('my-company.edit', $company->id)}}"
                                class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded hover:bg-gray-200">
                                Edit
                            </a>
                        @endif

                        @if (auth()->user()->role == 'admin')
                            <form method="POST" action="{{route('companies.destroy', $company->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 rounded hover:bg-red-100">
                                    Archive
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>




</x-app-layout>