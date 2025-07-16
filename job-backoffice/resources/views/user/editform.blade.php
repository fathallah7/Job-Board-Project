<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit user Information')}} ( {{$user->name}} )
        </h2>
    </x-slot>

    <x-toast-notification />

    <div class="p-12 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="grid sm:grid-cols-1 md:grid-cols-2  gap-6 bg-white p-10 rounded-lg shadow-lg">

                {{-- user Name --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                    <input disabled type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="bg-gray-100 block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none"
                        placeholder="e.g. Tech Solutions" required />
                </div>

                {{-- Owner Email --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input disabled type="text" id="name" name="email" value="{{ old('email', $user->email) }}"
                        class="bg-gray-100 block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none"
                        placeholder="e.g. Tech Solutions" required />
                </div>


                <!-- Owner Password -->
                <div class="mb-4">
                    <label for="owner_password" class="block text-sm font-medium text-gray-700">New
                        Password</label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <x-text-input id="owner_password" class="block mt-1 w-full"
                            x-bind:type="showPassword ? 'text' : 'password'" name="password"
                            autocomplete="current-password" />
                        <button type="button" class="absolute inset-y-0 right-2 flex items-center text-gray-500"
                            @click="showPassword = !showPassword">
                            <!-- Eye Icon Open -->
                            <svg x-show="showPassword" width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                                <path
                                    d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <!-- Eye Icon Closed -->
                            <svg x-show="!showPassword" width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                                <path
                                    d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>



                {{-- Buttons --}}
                <div class="flex justify-end items-center gap-4 mt-6">
                    <a href="{{ route('users.index') }}"
                        class="text-gray-700 hover:text-red-600 font-medium transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="rounded-md bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 text-sm font-semibold transition duration-200">
                        Save
                    </button>
                </div>

            </div>
        </form>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</x-app-layout>