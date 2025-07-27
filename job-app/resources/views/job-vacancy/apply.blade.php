<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="bg-gray-800 shadow-xl rounded-2xl p-8 max-w-7xl mx-auto">
            <h3 class="text-2xl font-bold text-white mb-8">Job Information - Apply</h3>


            <div class="space-y-6">

                <div
                    class="p-6 bg-gray-700 border border-gray-600 rounded-xl shadow hover:shadow-md transition flex flex-col gap-3">

                    <div class="flex justify-between items-center text-gray-400 text-sm mb-2">
                        <span>{{ $job->viewCount }} views</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <div>

                            <a href="{{ route('job-vacancies-show', $job->id) }}"
                                class="text-xl font-bold text-blue-400 hover:text-blue-300 hover:underline">
                                {{ $job->title }}
                            </a>

                            <p class="text-sm text-gray-300 mt-1">
                                @ {{ $job->company->name }} <span class="mx-1 text-gray-500">•</span>
                                {{ $job->location }}
                            </p>
                        </div>

                        <span class="bg-indigo-500 text-white text-sm px-4 py-1.5 rounded-full">
                            {{ $job->type }}
                        </span>
                    </div>

                    <div class="text-sm text-gray-300 leading-relaxed">
                        {{ $job->description }}
                    </div>

                    <div
                        class="flex flex-wrap items-center justify-between gap-4 text-sm text-gray-300 border-t border-gray-600 pt-4">
                        <div>
                            <span class="text-white font-semibold">$ {{ number_format($job->salary) }}</span>
                            <span class="text-gray-400">/ Year (Estimated total annual salary)</span>
                        </div>

                        <div>
                            <span class="text-gray-400">Posted on:</span>
                            <span class="text-white">{{ $job->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>



                <!-- Apply Form with Drag & Drop -->
                <div x-data="fileUpload()"
                    class="mt-10 bg-gray-700 border border-gray-600 rounded-xl p-6 shadow-lg text-white">

                    <h4 class="text-xl font-bold mb-4">Apply Now</h4>

                    <form action="{{ route('resume.upload', $job->id) }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <!-- Drag & Drop Zone -->
                        <div @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
                            @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                            :class="dragging ? 'border-indigo-500 bg-gray-600' : 'border-gray-500'"
                            class="flex flex-col items-center justify-center border-2 border-dashed rounded-xl p-6 cursor-pointer transition-all duration-300">
                            <input type="file" name="resume" x-ref="fileInput" class="hidden"
                                @change="handleFile($event)" accept=".pdf,.doc,.docx">
                            <template x-if="file">
                                <p class="text-sm text-green-400 font-medium mt-2">
                                    Uploaded: <span x-text="file.name"></span>
                                </p>
                            </template>
                            <template x-if="!file">
                                <p class="text-sm text-gray-300 font-medium">Drag & Drop your CV here or click to upload
                                </p>
                            </template>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 transition-colors duration-300 text-white px-5 py-2 rounded-xl font-medium shadow-md hover:shadow-lg">
                                Submit Application
                            </button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="mt-2 text-red-500 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Alpine.js -->
                <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                <script>
                    function fileUpload() {
                        return {
                            file: null,
                            dragging: false,
                            handleFile(e) {
                                this.file = e.target.files[0];
                            },
                            handleDrop(e) {
                                this.dragging = false;
                                const files = e.dataTransfer.files;
                                this.$refs.fileInput.files = files;
                                this.file = files[0];
                            },
                        }
                    }
                </script>

            </div>
    </section>


</x-app-layout>