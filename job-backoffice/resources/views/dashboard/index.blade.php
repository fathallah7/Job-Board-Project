<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-10 px-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-10">


            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="bg-white rounded-xl shadow p-5 hover:scale-105 transition transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl text-indigo-600">
                            <i class="fa-building fa-solid"></i>
                        </div>
                        <div
                            class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                            C
                        </div>
                    </div>
                    <p class="mt-4 text-gray-500 text-sm">Companies</p>
                    <p class="text-2xl font-extrabold text-gray-800">{{$analytics['companies']}}</p>
                </div>

                <div
                    class="bg-white rounded-xl shadow p-5 hover:scale-105 transition transform duration-200 cursor-pointer group relative">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl text-green-500">
                            <i class="fa-file-lines fa-solid"></i>
                        </div>
                        <div
                            class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                    <p class="mt-4 text-gray-500 text-sm">Applications</p>
                    <p class="text-2xl font-extrabold text-gray-800">{{$analytics['applications']}}</p>

                    <!-- Tooltip -->
                    <div
                        class="absolute bottom-1 right-12 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all duration-500 bg-white border rounded-lg shadow-lg p-3 text-sm w-30 z-50">
                        <p><span class="font-semibold text-green-600">{{$analytics['acceptedApplications']}}</span>
                            Accepted</p>
                        <p><span class="font-semibold text-yellow-500">{{$analytics['pendingApplications']}}</span>
                            Pending</p>
                        <p><span class="font-semibold text-red-500">{{$analytics['rejectedApplications']}}</span>
                            Rejected</p>
                    </div>
                </div>


                <div
                    class="bg-white rounded-xl shadow p-5 hover:scale-105 transition transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl text-yellow-500">
                            <i class="fa-briefcase fa-solid"></i>
                        </div>
                        <div
                            class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold">
                            V
                        </div>
                    </div>
                    <p class="mt-4 text-gray-500 text-sm">Vacancies</p>
                    <p class="text-2xl font-extrabold text-gray-800">{{$analytics['jobs']}}</p>
                </div>

                <div
                    class="bg-white rounded-xl shadow p-5 hover:scale-105 transition transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl text-pink-500">
                            <i class="fa-user-tie fa-solid"></i>
                        </div>
                        <div
                            class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            U
                        </div>
                    </div>
                    <p class="mt-4 text-gray-500 text-sm">Users</p>
                    <p class="text-2xl font-extrabold text-gray-800">{{$analytics['users']}}</p>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow p-5 transition transform duration-200">
                <div class="flex items-center justify-between">
                    <div class="text-3xl text-green-700">
                        <i class="fa-solid fa-user-clock"></i>
                    </div>
                    <div
                        class="w-10 h-10 bg-green-700 rounded-full flex items-center justify-center text-white font-bold">
                        30d
                    </div>
                </div>
                <p class="mt-4 text-gray-500 text-sm">Active Users (30 Days)</p>
                <p class="text-2xl font-extrabold text-gray-800">{{$analytics['activeUsers']}}</p>
            </div>

            <div class="bg-white rounded-xl shadow mb-10 overflow-hidden">
                <div class="p-5 font-bold text-lg border-b bg-gray-50">Most Applied Jobs</div>
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-gray-100 text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-6 py-3 text-left">Job Title</th>
                            <th class="px-6 py-3 text-left">Company</th>
                            <th class="px-6 py-3 text-right">Applications</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mostAppliedJobs as $job)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-6 py-4 font-medium">{{$job->title}}</td>
                                <td class="px-6 py-4">{{$job->Company->name}}</td>
                                <td class="px-6 py-4 text-right font-bold text-green-600">{{$job->count}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="p-5 font-bold text-lg border-b bg-gray-50">Conversion Rates</div>
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-gray-100 text-xs uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-6 py-3 text-left">Job Title</th>
                            <th class="px-6 py-3 text-right">Views</th>
                            <th class="px-6 py-3 text-right">Applications</th>
                            <th class="px-6 py-3 text-right">Conversion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conversionRates as $rate)

                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-6 py-4 font-medium">{{$rate->title}}</td>
                                <td class="px-6 py-4 text-right">{{$rate->viewCount}}</td>
                                <td class="px-6 py-4 text-right">{{$rate->count}}</td>
                                <td class="px-6 py-4 text-right font-bold text-indigo-600">{{$rate->conversionRate}}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            <!-- Chart Example -->
            {{-- <div class="bg-white rounded-xl shadow p-8">
                <h4 class="font-semibold text-lg text-gray-700 mb-4">Site Activity</h4>
                <canvas id="chart" height="80"></canvas>
            </div> --}}

            <!-- Table Example -->
            {{-- <div class="bg-white rounded-xl shadow p-8">
                <h4 class="font-semibold text-lg text-gray-700 mb-4">Latest Users</h4>
                <table class="min-w-full text-sm text-left">
                    <thead>
                        <tr class="border-b text-gray-500 uppercase tracking-wider text-xs">
                            <th class="py-2">#</th>
                            <th class="py-2">Name</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-gray-700">
                        <tr>
                            <td class="py-2">1</td>
                            <td class="py-2">John Doe</td>
                            <td class="py-2">john@example.com</td>
                            <td class="py-2">2 days ago</td>
                        </tr>
                        <tr>
                            <td class="py-2">2</td>
                            <td class="py-2">Sarah Smith</td>
                            <td class="py-2">sarah@example.com</td>
                            <td class="py-2">5 days ago</td>
                        </tr>
                        <tr>
                            <td class="py-2">3</td>
                            <td class="py-2">Mike Johnson</td>
                            <td class="py-2">mike@example.com</td>
                            <td class="py-2">1 week ago</td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}

        </div>
    </div>

    <!-- Chart.js -->
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