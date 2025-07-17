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
                @php
                $icons = [
                    'Companies' => 'fa-building',
                    'Applications' => 'fa-file-lines',
                    'Vacancies' => 'fa-briefcase',
                    'Users' => 'fa-solid fa-user-tie',
                ];
                @endphp

                @foreach ([
                    ['title' => 'Companies', 'count' => 24, 'color' => 'indigo-500', ],
                    ['title' => 'Applications', 'count' => 76, 'color' => 'green-500', ],
                    ['title' => 'Vacancies', 'count' => 15, 'color' => 'yellow-500', ],
                    ['title' => 'Users', 'count' => 542, 'color' => 'pink-500', ],
                ] as $stat)
                    <div class="bg-white rounded-xl shadow p-5 hover:scale-105 transition transform duration-200 cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div class="text-3xl "> <i class="fa-solid text-{{ $stat['color'] }} {{ $icons[$stat['title']] }} "></i> </div>
                            
                            <div class="w-10 h-10 bg-{{ $stat['color'] }} rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr($stat['title'], 0, 1) }}
                            </div>
                        </div>
                        <p class="mt-4 text-gray-500 text-sm">{{ $stat['title'] }}</p>
                        <p class="text-2xl font-extrabold text-gray-800">{{ $stat['count'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Chart Example -->
            <div class="bg-white rounded-xl shadow p-8">
                <h4 class="font-semibold text-lg text-gray-700 mb-4">Site Activity</h4>
                <canvas id="chart" height="80"></canvas>
            </div>

            <!-- Table Example -->
            <div class="bg-white rounded-xl shadow p-8">
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
            </div>

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
