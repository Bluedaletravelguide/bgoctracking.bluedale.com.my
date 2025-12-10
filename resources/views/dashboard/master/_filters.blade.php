{{-- resources/views/dashboard/master/_filters.blade.php --}}
@php
    // Normalize current values from the request
    $currentMonth = (int) request('month', 0); // 0 = All
    $query = trim((string) request('q', ''));
@endphp

<form method="GET" action="{{ $action ?? url()->current() }}" class="mb-4">
    <div class="border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-end">
            {{-- Month selector --}}
            <div class="w-full sm:w-auto">
                <label class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                <select name="month"
                    class="block w-full sm:w-48 rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="0" {{ $currentMonth === 0 ? 'selected' : '' }}>All months</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $currentMonth === $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create(null, $m, 1)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- Global search --}}
            <div class="flex-1 min-w-[240px] w-full">
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="q" value="{{ $query }}" placeholder="Type any keyword…"
                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            {{-- Actions --}}
            <div class="flex gap-2 flex-shrink-0">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Apply
                </button>
                {{-- Keep route but clear params --}}
                <a href="{{ $clearUrl ?? url()->current() }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Reset
                </a>
            </div>
        </div>
    </div>
</form>
<style>
    /* Fix for select arrow color in Tailwind */
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='gray'%3E%3Cpath fill-rule='evenodd' d='M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z' clip-rule='evenodd'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1em;
        padding-right: 2rem;
        /* Space for the arrow */
    }
</style>
