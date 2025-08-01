<!-- Mobile Navigation -->
<div x-data="{ open: false }" class="block md:block lg:hidden">
    <nav class="fixed top-0 left-0 w-full bg-white border-b border-gray-300 shadow-sm z-50">
        <div class="flex items-center justify-between px-4 py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
                <span class="text-xl font-bold text-gray-800">Back Office</span>
            </a>
            <button @click="open = !open" class="text-gray-700 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </div>
        <div x-show="open" class="px-4 py-2 border-t border-gray-300 bg-white">
            <ul class="flex flex-col space-y-1 text-sm font-medium text-gray-700">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="fa-solid fa-chart-line mr-2"></i>
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.index')">
                    <i class="fa-solid fa-building mr-2"></i>
                    {{ __('Companies') }}
                </x-nav-link>
                <x-nav-link :href="route('job-applications.index')"
                    :active="request()->routeIs('job-applications.index')">
                    <i class="fa-solid fa-file-lines mr-2"></i>
                    {{ __('Applications') }}
                </x-nav-link>
                <x-nav-link :href="route('job-vacancies.index')" :active="request()->routeIs('job-vacancies.index')">
                    <i class="fa-solid fa-briefcase mr-2"></i>
                    {{ __('Job Vacancies') }}
                </x-nav-link>
                <x-nav-link :href="route('job-categories.index')" :active="request()->routeIs('job-categories.index')">
                    <i class="fa-solid fa-layer-group mr-2"></i>
                    {{ __('Categories') }}
                </x-nav-link>
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    <i class="fa-solid fa-users mr-2"></i>
                    {{ __('Users') }}
                </x-nav-link>
                <hr class="my-4 border-gray-300">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link class="text-red-600 hover:bg-red-50 hover:text-red-700" :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </ul>
        </div>
    </nav>
    <div class="pt-16"></div>
</div>

<!-- Desktop Navigation -->
<nav class="hidden md:hidden lg:block w-64 bg-white h-screen border-r border-gray-300 shadow-sm fixed">
    <!-- Logo Section -->
    <div class="flex items-center px-6 border-b border-gray-300 py-5">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
            <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
            @if (auth()->user()->role == 'admin')
                <span class="text-xl font-bold text-gray-800">Back Office</span>
            @else
                <span class="text-xl font-bold text-gray-800">Back Office (Owner)</span>
            @endif
        </a>
    </div>
    <!-- Navigation Links -->
    <ul class="flex flex-col px-4 py-6 space-y-1 text-sm font-medium text-gray-700">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fa-solid fa-chart-line mr-2"></i> {{ __('Dashboard') }}
        </x-nav-link>

        @if (auth()->user()->role == 'admin')
            <x-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.index')">
                <i class="fa-solid fa-building mr-2"></i> {{ __('Companies') }}
            </x-nav-link>
        @else
            <x-nav-link :href="route('my-company.show')" :active="request()->routeIs('companies.index')">
                <i class="fa-solid fa-building mr-2"></i> {{ __('My Company') }}
            </x-nav-link>
        @endif

        <x-nav-link :href="route('job-applications.index')" :active="request()->routeIs('job-applications.index')">
            <i class="fa-solid fa-file-lines mr-2"></i> {{ __('Applications') }}
        </x-nav-link>

        <x-nav-link :href="route('job-vacancies.index')" :active="request()->routeIs('job-vacancies.index')">
            <i class="fa-solid fa-briefcase mr-2"></i> {{ __('Job Vacancies') }}
        </x-nav-link>

        @if (auth()->user()->role == 'admin')
            <x-nav-link :href="route('job-categories.index')" :active="request()->routeIs('job-categories.index')">
                <i class="fa-solid fa-layer-group mr-2"></i> {{ __('Categories') }}
            </x-nav-link>
        @endif

        @if (auth()->user()->role == 'admin')
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                <i class="fa-solid fa-users mr-2"></i> {{ __('Users') }}
            </x-nav-link>
        @endif

        <hr class="my-4 border-gray-300">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-nav-link class="text-red-600 hover:bg-red-50 hover:text-red-700" :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                {{ __('Log Out') }}
            </x-nav-link>
        </form>

    </ul>
</nav>