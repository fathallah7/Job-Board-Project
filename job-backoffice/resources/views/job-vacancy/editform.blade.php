<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit jobVacancy Information')}} ( {{$jobVacancy->title}} )
        </h2>
    </x-slot>

    <div class="p-12 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('job-vacancies.update' , $jobVacancy->id) }}">
            @csrf
            @method('PUT')
            <div class="grid sm:grid-cols-1 md:grid-cols-2  gap-6 bg-white p-10 rounded-lg shadow-lg">

                {{-- Title --}}
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title' , $jobVacancy->title)  }}"
                        class="block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none"
                        placeholder="e.g. Front-End Developer" required />
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- location --}}
                <div>
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-700">location</label>
                    <input type="text" id="location" name="location" value="{{ old('location' , $jobVacancy->location) }}"
                        class="block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none"
                        placeholder="e.g. 123 Business Street, City" required />
                    @error('location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Salary --}}
                <div>
                    <label for="salary" class="block mb-2 text-sm font-medium text-gray-700">Salary ($)</label>
                    <input type="text" id="salary" name="salary" value="{{ old('salary' , $jobVacancy->salary) }}"
                        class="block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none"
                        placeholder="200" required />
                    @error('salary')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Type --}}
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-700">type</label>
                    <select name="type"
                        class="block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none">
                        <option value="Full-Time" {{ old('type' , $jobVacancy->type) == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="Contract" {{ old('type' , $jobVacancy->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Remote" {{ old('type' , $jobVacancy->type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                        <option value="Hybrid" {{ old('type' , $jobVacancy->type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id"
                        class="block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none">
                        @foreach ($categories as $category)
                            <option {{ old('category_id' , $jobVacancy->category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </select>
                </div>

                {{-- Company --}}
                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-700">company</label>
                    <select name="company_id"
                        class="block w-full rounded-md border border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500 focus:outline-none">
                        @foreach ($companies as $company)
                            <option {{ old('company_id' , $jobVacancy->company_id) == $company->id ? 'selected' : '' }} value="{{ $company->id }}">
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="md:col-span-2">
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="" rows="3"
                        class=" w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description' , $jobVacancy->description)}}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Buttons --}}
<div>

</div>
                <div class="flex justify-end items-center gap-4 mt-6">
                    <a href="{{ route('job-vacancies.index') }}"
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