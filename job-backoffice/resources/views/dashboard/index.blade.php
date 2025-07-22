<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 px-2 sm:px-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <div
                    class="bg-white rounded-xl shadow p-4 sm:p-5 hover:scale-105 transition transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="text-2xl sm:text-3xl text-indigo-600">
                            <i class="fa-building fa-solid"></i>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                            C
                        </div>
                    </div>
                    <p class="mt-3 sm:mt-4 text-gray-500 text-xs sm:text-sm">Companies</p>
                    <p class="text-xl sm:text-2xl font-extrabold text-gray-800">{{$analytics['companies']}}</p>
                </div>

                <div
                    class="bg-white rounded-xl shadow p-4 sm:p-5 hover:scale-105 transition transform duration-200 cursor-pointer group relative">
                    <div class="flex items-center justify-between">
                        <div class="text-2xl sm:text-3xl text-green-500">
                            <i class="fa-file-lines fa-solid"></i>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                    <p class="mt-3 sm:mt-4 text-gray-500 text-xs sm:text-sm">Applications</p>
                    <p class="text-xl sm:text-2xl font-extrabold text-gray-800">{{$analytics['applications']}}</p>

                    <div
                        class="absolute bottom-1 right-2 sm:right-12 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-500 bg-white border rounded-lg shadow-lg p-2 sm:p-3 text-xs sm:text-sm w-28 sm:w-30 z-50">
                        <p><span class="font-semibold text-green-600">{{$analytics['acceptedApplications']}}</span>
                            Accepted</p>
                        <p><span class="font-semibold text-yellow-500">{{$analytics['pendingApplications']}}</span>
                            Pending</p>
                        <p><span class="font-semibold text-red-500">{{$analytics['rejectedApplications']}}</span>
                            Rejected</p>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow p-4 sm:p-5 hover:scale-105 transition transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="text-2xl sm:text-3xl text-yellow-500">
                            <i class="fa-briefcase fa-solid"></i>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold">
                            V
                        </div>
                    </div>
                    <p class="mt-3 sm:mt-4 text-gray-500 text-xs sm:text-sm">Vacancies</p>
                    <p class="text-xl sm:text-2xl font-extrabold text-gray-800">{{$analytics['jobs']}}</p>
                </div>

                <div
                    class="bg-white rounded-xl shadow p-4 sm:p-5 hover:scale-105 transition transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="text-2xl sm:text-3xl text-pink-500">
                            <i class="fa-user-tie fa-solid"></i>
                        </div>
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            U
                        </div>
                    </div>
                    <p class="mt-3 sm:mt-4 text-gray-500 text-xs sm:text-sm">Users</p>
                    <p class="text-xl sm:text-2xl font-extrabold text-gray-800">{{$analytics['users']}}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4 sm:p-5 transition transform duration-200">
                <div class="flex items-center justify-between">
                    <div class="text-2xl sm:text-3xl text-green-700">
                        <i class="fa-solid fa-user-clock"></i>
                    </div>
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 bg-green-700 rounded-full flex items-center justify-center text-white font-bold">
                        30d
                    </div>
                </div>
                <p class="mt-3 sm:mt-4 text-gray-500 text-xs sm:text-sm">Active Users (30 Days)</p>
                <p class="text-xl sm:text-2xl font-extrabold text-gray-800">{{$analytics['activeUsers']}}</p>
            </div>

            <!-- Chart -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-8 overflow-x-auto">
                <h4 class="font-semibold text-base sm:text-lg text-gray-700 mb-2 sm:mb-4">Site Activity</h4>
                <canvas id="chart" height="80"></canvas>
            </div>

            <!-- Most Applied Jobs -->
            <div class="bg-white rounded-xl shadow overflow-x-auto">
                <div class="p-4 sm:p-5 font-bold text-base sm:text-lg border-b bg-gray-50">Most Applied Jobs</div>
                <table class="min-w-full text-xs sm:text-sm text-gray-800">
                    <thead class="bg-gray-100 text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-2 sm:px-6 py-2 sm:py-3 text-left">Job Title</th>
                            <th class="px-2 sm:px-6 py-2 sm:py-3 text-left">Company</th>
                            <th class="px-2 sm:px-6 py-2 sm:py-3 text-right">Applications</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mostAppliedJobs as $job)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-2 sm:px-6 py-2 sm:py-4 font-medium">{{$job->title}}</td>
                                <td class="px-2 sm:px-6 py-2 sm:py-4">{{$job->Company->name}}</td>
                                <td class="px-2 sm:px-6 py-2 sm:py-4 text-right font-bold text-green-600">{{$job->count}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Conversion Rates -->
            <div class="bg-white rounded-xl shadow overflow-x-auto">
                <div class="p-4 sm:p-5 font-bold text-base sm:text-lg border-b bg-gray-50">Conversion Rates</div>
                <table class="min-w-full text-xs sm:text-sm text-gray-800">
                    <thead class="bg-gray-100 text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-2 sm:px-6 py-2 sm:py-3 text-left">Job Title</th>
                            <th class="px-2 sm:px-6 py-2 sm:py-3 text-right">Views</th>
                            <th class="px-2 sm:px-6 py-2 sm:py-3 text-right">Applications</th>
                            <th class="px-2 sm:px-6 py-2 sm:py-3 text-right">Conversion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conversionRates as $rate)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-2 sm:px-6 py-2 sm:py-4 font-medium">{{$rate->title}}</td>
                                <td class="px-2 sm:px-6 py-2 sm:py-4 text-right">{{$rate->viewCount}}</td>
                                <td class="px-2 sm:px-6 py-2 sm:py-4 text-right">{{$rate->count}}</td>
                                <td class="px-2 sm:px-6 py-2 sm:py-4 text-right font-bold text-indigo-600">
                                    {{$rate->conversionRate}}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Visitors',
                    data: [40, 60, 80, 75, 90, 120, 100],
                    fill: true,
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

</x-app-layout>