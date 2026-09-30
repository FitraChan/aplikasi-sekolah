
<div class="mb-5 space-y-3">

    {{-- Success --}}
    @if (session()->has('success'))
        <div
            id="alert-success"
            class="flex items-center justify-between gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm"
            role="alert"
        >
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                    <i data-lucide="check-circle" class="h-5 w-5 text-emerald-600"></i>
                </div>

                <div>
                    <div class="font-semibold">Berhasil</div>
                    <div class="mt-0.5">
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>

            <button
                type="button"
                onclick="closeAlert('alert-success')"
                class="shrink-0 rounded-lg p-1.5 text-emerald-500 transition hover:bg-emerald-100 hover:text-emerald-700"
                aria-label="Close"
            >
                <i data-lucide="x" class="h-4 w-4"></i>
            </button>
        </div>
    @endif


    {{-- Error --}}
    @if (session()->has('error'))
        <div
            id="alert-error"
            class="flex items-center justify-between gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 shadow-sm"
            role="alert"
        >
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100">
                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-600"></i>
                </div>

                <div>
                    <div class="font-semibold">Terjadi Kesalahan</div>
                    <div class="mt-0.5">
                        {{ session()->get('error') }}
                    </div>
                </div>
            </div>

            <button
                type="button"
                onclick="closeAlert('alert-error')"
                class="shrink-0 rounded-lg p-1.5 text-red-500 transition hover:bg-red-100 hover:text-red-700"
                aria-label="Close"
            >
                <i data-lucide="x" class="h-4 w-4"></i>
            </button>
        </div>
    @endif

</div>

<script>
    function closeAlert(id) {
        const alert = document.getElementById(id);

        if (alert) {
            alert.remove();
        }
    }
</script>

