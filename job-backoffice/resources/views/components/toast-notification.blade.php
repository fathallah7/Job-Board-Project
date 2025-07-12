    @if (session('success'))
        <div id="successAlert"
            class="fixed bottom-5 right-5 bg-green-100 border border-green-500 text-green-700 px-5 py-3 rounded shadow-lg z-50 flex items-start gap-3">
            <svg class="w-6 h-6 text-green-500 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <div class="flex-1">
                <strong class="block mb-1">Success</strong>
                <p>{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('successAlert').remove()"
                class="ml-4 text-green-700 hover:text-green-900 text-lg">&times;</button>
        </div>
    @endif

    @if (session('danger'))
        <div id="dangerAlert"
            class="fixed bottom-5 right-5 bg-red-100 border border-red-500 text-red-700 px-5 py-3 rounded shadow-lg z-50 flex items-start gap-3 mt-3">
            <svg class="w-6 h-6 text-red-500 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <strong class="block mb-1">Deleted</strong>
                <p>{{ session('danger') }}</p>
            </div>
            <button onclick="document.getElementById('dangerAlert').remove()"
                class="ml-4 text-red-700 hover:text-red-900 text-lg">&times;</button>
        </div>
    @endif


    <script>
        setTimeout(() => {
            const successAlert = document.getElementById('successAlert');
            const dangerAlert = document.getElementById('dangerAlert');

            if (successAlert) successAlert.remove();
            if (dangerAlert) dangerAlert.remove();
        }, 5000);
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElList = [].slice.call(document.querySelectorAll('.toast'));
        toastElList.forEach(toastEl => {
            new bootstrap.Toast(toastEl).show();
        });
    });
</script>