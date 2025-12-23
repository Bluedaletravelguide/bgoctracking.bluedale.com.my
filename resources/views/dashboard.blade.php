<x-app-shell title="Master Proposal Confirmation">

    @push('head')
        <link rel="icon" type="image/x-icon" href="{{ asset('images/bluedale_logo_1.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600&display=swap"
            rel="stylesheet">

        <style>
            :root {
                --paper-bg: #F7F7F9;
                --surface: #FFFFFF;
                --ink: #1C1E26;
                --hairline: #EAEAEA;
                --brand-dark: #22255b;
                --brand-light: #4bbbed;
                --destructive: #d33831;
            }

            body {
                font-family: 'Inter', sans-serif;
                background-color: var(--paper-bg);
                color: var(--ink);
            }

            .font-serif {
                font-family: 'Playfair Display', serif;
            }

            .ink {
                color: var(--ink);
            }

            .hairline {
                border-color: var(--hairline);
            }

            .hairline-bottom {
                border-bottom: 1px solid var(--hairline);
            }

            .small-caps {
                font-variant: small-caps;
                letter-spacing: 0.06em;
                text-transform: uppercase;
                font-size: 12px;
                font-weight: 500;
            }

            .tabular-nums {
                font-variant-numeric: tabular-nums;
            }

            .btn-primary {
                background-color: var(--brand-dark);
                color: white;
                transition: all 150ms ease;
            }

            .btn-primary:hover {
                opacity: 0.9;
            }

            .btn-primary:focus {
                ring: 2px;
                ring-color: var(--brand-light);
                ring-opacity: 0.5;
            }

            .btn-secondary {
                border: 1px solid var(--hairline);
                background-color: transparent;
                color: var(--ink);
                transition: all 150ms ease;
            }

            .btn-secondary:hover {
                background-color: rgba(75, 187, 237, 0.05);
                border-color: var(--brand-light);
            }

            .btn-ghost {
                border: 1px solid #d1d5db;
                background-color: transparent;
                color: #6b7280;
                transition: all 150ms ease;
            }

            .btn-ghost:hover {
                background-color: #f9fafb;
            }

            .btn-destructive {
                background-color: var(--destructive);
                color: white;
                transition: all 150ms ease;
            }

            .btn-destructive:hover {
                opacity: 0.9;
            }

            .card {
                background-color: var(--surface);
                border-radius: 1rem;
                border: 1px solid rgba(229, 231, 235, 0.7);
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            }

            .filter-chip {
                background-color: #f3f4f6;
                color: #374151;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 12px;
                font-weight: 500;
            }

            .table-row:hover {
                background-color: #e2e9ff;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                transform: translateY(-1px);
                transition: all 150ms ease;
            }

            .nav-card {
                transition: all 200ms ease;
                position: relative;
            }

            .nav-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.1);
            }

            .nav-card:hover::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 3px;
                background-color: var(--brand-dark);
                border-radius: 0 1rem 1rem 0;
            }

            .tab-button {
                position: relative;
                padding: 0.75rem 0;
                color: #6b7280;
                border-bottom: 2px solid transparent;
                transition: all 150ms ease;
            }

            .tab-button.active {
                color: var(--ink);
                border-bottom-color: var(--brand-dark);
            }

            @media (max-width: 768px) {
                .table-mobile-card {
                    background: white;
                    border-radius: 0.75rem;
                    border: 1px solid var(--hairline);
                    padding: 1rem;
                    margin-bottom: 0.75rem;
                    font-size: 20px;
                }
            }

            .table-cell-border {
                position: relative;
            }

            .table-cell-border:not(:last-child)::after {
                content: '';
                position: absolute;
                right: 0;
                top: 0;
                bottom: 0;
                width: 1px;
                background-color: var(--ink);
            }

            /* Ensure sticky columns maintain their background over scrolled content */
            .sticky.left-0 {
                background-clip: padding-box;
                position: sticky !important;
                z-index: 40;
                /* Higher than other content but below header */
            }

            /* Ensure modal appears on top of everything */
            #preview-modal {
                z-index: 9999 !important;
            }

            #preview-modal .bg-white {
                z-index: 9999 !important;
                position: relative;
            }

            /* Ensure table scrolls horizontally on small screens */
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                scrollbar-color: #e5e7eb #f9fafb;
            }

            .overflow-x-auto::-webkit-scrollbar {
                height: 6px;
            }

            .overflow-x-auto::-webkit-scrollbar-thumb {
                background-color: #e5e7eb;
                border-radius: 4px;
            }

            .overflow-x-auto::-webkit-scrollbar-track {
                background-color: #f9fafb;
            }

            /* Compact padding for dense tables */
            .table-auto th,
            .table-auto td {
                padding: 0.375rem 0.5rem;
                /* px-2 py-1.5 */
                font-size: 0.75rem;
                /* text-xs */
            }

            /* Sticky header stays visible */
            .thead-sticky {
                position: sticky;
                top: 0;
                z-index: 50;
                background: #2563eb;
                /* bg-blue-600 */
                color: white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush

    <!-- Page Header -->
    <header class="mb-8">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-6">
            <!-- Title Section -->
            <div class="flex-1">
                <h1 class="font-serif text-3xl lg:text-4xl font-medium ink mb-2">Master Proposal Confirmation</h1>
                <p class="text-sm text-gray-600">
                    @if (isset($masterFiles) && $masterFiles->count() > 0)
                        Showing {{ $masterFiles->count() }} records
                    @else
                        No records found
                    @endif
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                <!-- Add New - Primary -->
                @can('masterfile.create')
                    <a href="{{ route('masterfile.create') }}"
                        class="btn-primary inline-flex items-center px-5 py-2.5 rounded-full text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New
                    </a>
                @endcan

                <!-- Calendar View - Secondary -->
                @can('dashboard.view')
                    <a href="{{ route('calendar.index') }}"
                        class="btn-secondary inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Calendar View
                    </a>
                @endcan

                <!-- Import Data - Ghost -->
                @can('masterfile.import')
                    <button type="button" onclick="testImportModal()"
                        class="btn-ghost inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3"></path>
                        </svg>
                        Import Data
                    </button>
                @endcan

                <!-- Export All Data - Ghost -->
                @can('export.run')
                    <a href="{{ route('masterfile.exportXlsx', request()->query()) }}"
                        class="btn-ghost inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l2-2m0 0l2-2m-2 2H6"></path>
                        </svg>
                        Export All Data
                    </a>
                @endcan

                <!-- Preview Export Button -->
                @can('export.run')
                    <button type="button" onclick="showExportPreview()"
                        class="btn-ghost inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        Preview Export
                    </button>
                @endcan

                <!-- Preview Modal -->
                <div id="preview-modal" class="fixed inset-0 z-50 hidden">
                    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
                    <div class="fixed inset-0 flex items-center justify-center p-4">
                        <!-- Changed from max-w-6xl to max-w-4xl (reduced size) -->
                        <div
                            class="bg-white rounded-lg w-full max-w-4xl max-h-[70vh] overflow-hidden shadow-xl flex flex-col z-50">
                            <!-- Header -->
                            <div class="flex items-center justify-between p-4 border-b">
                                <h3 class="text-lg font-semibold text-gray-900">Export Preview</h3>
                                <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Content -->
                            <div class="p-4 flex-grow overflow-y-auto">
                                <div id="preview-content" class="text-sm">
                                    <!-- Loading State -->
                                    <div class="text-center py-8">
                                        <div
                                            class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-4">
                                        </div>
                                        <p class="text-gray-600">Loading preview...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="flex justify-end p-4 border-t bg-gray-50">
                                <button onclick="closePreviewModal()"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 mr-2">
                                    Close
                                </button>
                                <a id="export-link" href="{{ route('masterfile.exportXlsx', request()->query()) }}"
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    Go to Export
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function showExportPreview() {
                        document.getElementById('preview-content').innerHTML = `
                            <div class="text-center py-8">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-4"></div>
                                <p class="text-gray-600">Loading preview...</p>
                            </div>
                        `;
                        document.getElementById('preview-modal').classList.remove('hidden');

                        fetch('{{ route('masterfile.exportPreview', request()->query()) }}')
                            .then(response => response.json())
                            .then(data => {
                                renderPreviewTable(data);
                            })
                            .catch(error => {
                                document.getElementById('preview-content').innerHTML = `
                                <div class="text-center py-8">
                                    <svg class="w-12 h-12 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    <p class="text-red-600">Error loading preview</p>
                                </div>
                            `;
                            });
                    }

                    function renderPreviewTable(data) {
                        let html = `
        <div class="mb-4 text-sm text-gray-600">
            Showing first ${data.data.length} records of ${data.total_records} total records
        </div>
        <div class="border border-gray-300 rounded overflow-hidden">
            <div class="max-h-72 overflow-y-auto">
                <!-- 👇 This container enables horizontal scroll -->
                <div class="overflow-x-auto px-1">
                    <table class="min-w-full divide-y divide-gray-200 table-auto text-xs">
                        <thead class="bg-blue-600 text-white thead-sticky">
                            <tr>
    `;

                        data.headings.forEach(heading => {
                            html +=
                                `<th class="px-2 py-1.5 text-left font-bold uppercase tracking-wider text-white border-b border-r border-blue-700 last:border-r-0 whitespace-nowrap">${heading}</th>`;
                        });

                        html += `
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
    `;

                        data.data.forEach((row, index) => {
                            html += '<tr class="hover:bg-gray-50">';
                            row.forEach(cell => {
                                html +=
                                    `<td class="px-2 py-1.5 text-sm text-gray-900 border-b border-r border-gray-300 last:border-r-0 whitespace-nowrap">${cell || ''}</td>`;
                            });
                            html += '</tr>';
                        });

                        html += `
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    `;

                        document.getElementById('preview-content').innerHTML = html;
                        document.getElementById('export-link').href = '{{ route('masterfile.exportXlsx', request()->query()) }}';
                    }

                    function closePreviewModal() {
                        document.getElementById('preview-modal').classList.add('hidden');
                    }
                </script>

                <!-- Information Booth -->
                @can('information.booth.view')
                    <a href="{{ route('information.booth.index') }}"
                        class="btn-secondary inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Information Hub
                    </a>
                @endcan

                <a href="{{ route('report.summary', ['year' => request('year', now()->year), 'month' => request('month'), 'status' => request('status')]) }}"
                    class="inline-flex items-center px-3 py-2 rounded-lg text-white" style="background:#22255b">
                    Print All (Summary)
                </a>

                <a href="{{ route('calendar.coordinators.index') }}"
                    class="inline-flex items-center px-3 py-2 rounded-full text-white" style="background:#22255b">
                    Coordinator Calendar
                </a>

                <a href="{{ route('calendar.coordinators.monthlyongoingjobs.page') }}"
                    class="inline-flex items-center px-3 py-2 rounded-full text-white" style="background:#22255b">
                    Monthly Ongoing Jobs
                </a>

                <!-- show role | email -->
                @csrf
                <div
                    class="btn-destructive inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                    <span class="text-sm font-medium">{{ Auth::user()->role }} | {{ Auth::user()->email }}</span>
                </div>


                <!-- Logout - Destructive (Always visible) -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="btn-destructive inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Filters Card -->
    <div class="card p-6 mb-8">
        <form method="GET" action="{{ route('dashboard') }}" class="space-y-6" id="filterForm">
            <!-- Filter Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter Results
                </h3>
                <button type="button" id="toggleFilters" class="sm:hidden text-gray-600 hover:text-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <!-- Filter Fields in Single Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3" id="filterFields">
                <!-- Search with Clear Button -->
                <div>
                    <label for="search"
                        class="small-caps text-gray-600 block mb-2 text-xs font-medium uppercase tracking-wide">
                        SEARCH
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Search by company, product, client..."
                            class="w-full h-10 pl-10 pr-10 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-all shadow-sm">
                        @if (request('search'))
                            <button type="button"
                                onclick="document.getElementById('search').value=''; this.closest('form').submit();"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Status with Icon -->
                <div>
                    <label for="status"
                        class="small-caps text-gray-600 block mb-2 text-xs font-medium uppercase tracking-wide">
                        STATUS
                    </label>
                    <div class="relative">
                        <select name="status" id="status"
                            class="w-full h-10 pl-3 pr-10 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm appearance-none transition-all shadow-sm">
                            <option value="">All Status</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✓
                                Completed</option>
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>⟳ Ongoing
                            </option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>○ Pending
                            </option>
                            <option value="deleted" {{ request('status') == 'deleted' ? 'selected' : '' }}>x Deleted
                            </option>
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Month -->
                <div>
                    <label for="month"
                        class="small-caps text-gray-600 block mb-2 text-xs font-medium uppercase tracking-wide">
                        MONTH
                    </label>
                    <div class="relative">
                        <select name="month" id="month"
                            class="w-full h-10 pl-3 pr-10 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm appearance-none transition-all shadow-sm">
                            <option value="">All Months</option>
                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $m)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ $m }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label for="product_category"
                        class="small-caps text-gray-600 block mb-2 text-xs font-medium uppercase tracking-wide">
                        CATEGORY
                    </label>
                    <div class="relative">
                        <select name="product_category" id="product_category"
                            class="w-full h-10 pl-3 pr-10 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm appearance-none transition-all shadow-sm">
                            <option value="">All Categories</option>
                            <option value="Outdoor" {{ request('product_category') == 'Outdoor' ? 'selected' : '' }}>
                                Outdoor</option>
                            <option value="Media" {{ request('product_category') == 'Media' ? 'selected' : '' }}>
                                Media</option>
                            <option value="KLTG" {{ request('product_category') == 'KLTG' ? 'selected' : '' }}>KLTG
                            </option>
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Year -->
                <div>
                    <label for="year"
                        class="small-caps text-gray-600 block mb-2 text-xs font-medium uppercase tracking-wide">
                        YEAR
                    </label>
                    <div class="relative">
                        <select name="year" id="year"
                            class="w-full h-10 pl-3 pr-10 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm appearance-none transition-all shadow-sm">
                            <option value="">All Year</option>
                            @foreach (['2024', '2025', '2026', '2027', '2028', '2029', '2030'] as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                    {{ $y }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                {{-- <button type="submit"
                    class="btn-primary inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg text-sm font-medium shadow-sm hover:shadow-md transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Apply Filters
                </button> --}}

                @if (request('search') || request('status') || request('month') || request('product_category') || request('year'))
                    <a href="{{ route('dashboard') }}"
                        class="btn-ghost inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-100 border border-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear All
                    </a>

                    <!-- Results Count -->
                    <div class="sm:ml-auto text-sm text-gray-600 flex items-center gap-2 px-3">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        <span class="font-medium">{{ $masterFiles->count() ?? 0 }} results</span>
                    </div>
                @endif
            </div>

            <!-- Active Filter Chips -->
            @if (request('search') || request('status') || request('month') || request('product_category') || request('year'))
                <div class="pt-4 border-t border-gray-100">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Active Filters:</span>

                        @if (request('search'))
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-100 text-blue-800 text-xs font-medium border border-blue-200 shadow-sm">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                "{{ request('search') }}"
                                <button type="button"
                                    onclick="document.getElementById('search').value=''; document.getElementById('filterForm').submit();"
                                    class="ml-1 hover:text-blue-900 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif

                        @if (request('status'))
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-purple-100 text-purple-800 text-xs font-medium border border-purple-200 shadow-sm">
                                Status: {{ ucfirst(request('status')) }}
                                <button type="button"
                                    onclick="document.getElementById('status').value=''; document.getElementById('filterForm').submit();"
                                    class="ml-1 hover:text-purple-900 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif

                        @if (request('month'))
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-100 text-green-800 text-xs font-medium border border-green-200 shadow-sm">
                                Month: {{ request('month') }}
                                <button type="button"
                                    onclick="document.getElementById('month').value=''; document.getElementById('filterForm').submit();"
                                    class="ml-1 hover:text-green-900 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif

                        @if (request('product_category'))
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-100 text-amber-800 text-xs font-medium border border-amber-200 shadow-sm">
                                Category: {{ request('product_category') }}
                                <button type="button"
                                    onclick="document.getElementById('product_category').value=''; document.getElementById('filterForm').submit();"
                                    class="ml-1 hover:text-amber-900 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif

                        @if (request('year'))
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-100 text-red-800 text-xs font-medium border border-red-200 shadow-sm">
                                Year: {{ request('year') }}
                                <button type="button"
                                    onclick="document.getElementById('year').value=''; document.getElementById('filterForm').submit();"
                                    class="ml-1 hover:text-red-900 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filterForm');
            const searchInput = document.getElementById('search');
            const statusSelect = document.getElementById('status');
            const monthSelect = document.getElementById('month');
            const categorySelect = document.getElementById('product_category');
            const yearSelect = document.getElementById('year');

            // Debounce function
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Auto-submit function
            function autoSubmit() {
                const url = new URL(form.action);
                const params = new URLSearchParams();

                // Get all form values
                const search = searchInput.value.trim();
                const status = statusSelect.value;
                const month = monthSelect.value;
                const category = categorySelect.value;
                const year = yearSelect.value;

                // Only add non-empty values
                if (search) params.set('search', search);
                if (status) params.set('status', status);
                if (month) params.set('month', month);
                if (category) params.set('product_category', category);
                if (year) params.set('year', year);

                // Update URL without page parameter to reset pagination
                const newUrl = url.pathname + '?' + params.toString();
                window.location.href = newUrl;
            }

            // Create debounced version
            const debouncedAutoSubmit = debounce(autoSubmit, 300);

            // Add event listeners for auto-submit
            if (searchInput) {
                searchInput.addEventListener('input', debouncedAutoSubmit);
            }

            if (statusSelect) {
                statusSelect.addEventListener('change', autoSubmit);
            }

            if (monthSelect) {
                monthSelect.addEventListener('change', autoSubmit);
            }

            if (categorySelect) {
                categorySelect.addEventListener('change', autoSubmit);
            }

            if (yearSelect) {
                yearSelect.addEventListener('change', autoSubmit);
            }

            // Prevent form submission from triggering page reload for auto-submit
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                autoSubmit();
            });
        });
    </script>



    <!-- Tab Navigation -->
    @include('dashboard.master._tabs', ['active' => $active ?? ''])

    <!-- Data Table -->
    <div class="card overflow-hidden mb-8">
        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <div style="max-height: 600px; overflow-y: auto;">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-blue-600 text-white thead-sticky border-b-2 border-gray-900">
                        <tr>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                No
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Date Created
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 min-w-[200px] bg-white/80 backdrop-blur-sm sticky left-0 z-50 table-cell-border">
                                Company Name
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Product
                            </th>
                            <th
                                class="px-6 py-5 text-right text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Amount
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Month
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Start Date
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                End Date
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Duration
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[100px] bg-white/80 backdrop-blur-sm">
                                JO #
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Status
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Artwork
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Traffic
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Invoice Date
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Invoice Number
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Sales Person
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Person In Charge
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[220px] bg-white/80 backdrop-blur-sm">
                                Email
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 table-cell-border min-w-[50px] bg-white/80 backdrop-blur-sm">
                                Contact Number
                            </th>
                            <th
                                class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-800 min-w-[200px] whitespace-nowrap bg-white/80 backdrop-blur-sm">
                                Remarks
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-00">
                        @if (isset($masterFiles) && $masterFiles->count() > 0)
                            @foreach ($masterFiles as $file)
                                <tr
                                    class="table-row border-b border-gray-800 hover:bg-blue-50/30 transition-colors duration-150 {{ $loop->iteration % 2 === 0 ? 'bg-white' : 'bg-gray-50/50' }}">
                                    <td class="px-6 py-4 text-sm ink font-semibold table-cell-border">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-sm table-cell-border">
                                        {{ $file->created_at ? $file->created_at->format('d/m/y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm table-cell-border sticky left-0 bg-white">
                                        @can('masterfile.show')
                                            <a href="{{ route('masterfile.show', $file->id) }}"
                                                class="ink hover:text-blue-600 font-medium transition-colors duration-150 hover:underline">
                                                <div class="max-w-[200px] truncate"
                                                    title="{{ $file->clientCompany->name ?? 'No Company' }}">
                                                    {{ $file->clientCompany->name ?? 'No Company' }}
                                                </div>
                                            </a>
                                        @else
                                            <div class="max-w-[200px] truncate ink"
                                                title="{{ $file->clientCompany->name ?? 'No Company' }}">
                                                {{ $file->clientCompany->name ?? 'No Company' }}
                                            </div>
                                        @endcan
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->product ?? '-' }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm ink text-right tabular-nums font-semibold table-cell-border">
                                        {{ $file->amount ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->month ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->date ? \Carbon\Carbon::parse($file->date)->format('d/m/y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->date_finish ? \Carbon\Carbon::parse($file->date_finish)->format('d/m/y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->duration ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->job_number ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm table-cell-border">
                                        <span
                                            class="inline-flex px-3 py-1.5 text-xs font-bold rounded-full {{ $file->status === 'completed' ? 'bg-green-100 text-green-800 border border-green-200' : ($file->status === 'ongoing' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : ($file->status === 'deleted' ? 'bg-gray-100 text-gray-600 border border-gray-200' : 'bg-red-100 text-red-800 border border-red-200')) }}">
                                            {{ ucfirst($file->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->artwork ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->traffic ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->invoice_date ? \Carbon\Carbon::parse($file->invoice_date)->format('d/m/y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->invoice_number ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->sales_person ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->client->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 table-cell-border">
                                        <a href="mailto:{{ $file->email }}"
                                            class="hover:text-blue-600 transition-colors">
                                            {{ $file->email ?? '-' }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm ink table-cell-border">
                                        {{ $file->contact_number ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm ink cursor-pointer hover:text-blue-600 transition-colors"
                                        onclick="showRemarksModal('{{ addslashes($file->remarks ?? '-') }}')"
                                        title="Click to view full remarks">
                                        <div class="max-w-[150px] truncate">
                                            {{ $file->remarks ?? '-' }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="20" class="px-6 py-16 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-6" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <h3 class="font-serif text-lg font-medium ink mb-2">No records found</h3>
                                        <p class="text-gray-600 mb-4">Get started by adding your first record.</p>
                                        @can('masterfile.create')
                                            <a href="{{ route('masterfile.create') }}"
                                                class="btn-primary px-4 py-2 rounded-xl text-sm inline-flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                                Add New Record
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Table -->
        <div class="md:hidden p-4">
            @if (isset($masterFiles) && $masterFiles->count() > 0)
                @foreach ($masterFiles as $file)
                    <div class="table-mobile-card mb-4 border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
                        <div class="flex justify-between items-start mb-3 pb-3 border-b border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Company
                                </div>
                                @can('masterfile.show')
                                    <a href="{{ route('masterfile.show', $file->id) }}"
                                        class="text-sm font-semibold ink hover:text-blue-600">
                                        {{ $file->clientCompany->name ?? 'No Company' }}
                                    </a>
                                @else
                                    <div class="text-sm font-semibold ink">
                                        {{ $file->clientCompany->name ?? 'No Company' }}
                                    </div>
                                @endcan
                            </div>
                            <span
                                class="inline-flex px-2.5 py-1 text-xs font-bold rounded-full
                            {{ $file->status === 'completed' ? 'bg-green-100 text-green-800' : ($file->status === 'ongoing' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($file->status ?? 'pending') }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <div class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Sales
                                    Person</div>
                                <div class="ink">{{ $file->sales_person ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Amount
                                </div>
                                <div class="ink font-semibold">{{ $file->amount ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Product
                                </div>
                                <div class="ink">{{ $file->product ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Month</div>
                                <div class="ink">{{ $file->month ?? '-' }}</div>
                            </div>
                            <div class="col-span-2">
                                <div class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Contact
                                </div>
                                <div class="ink text-xs">{{ $file->email ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-base font-medium ink mb-2">No records found</h3>
                    <p class="text-sm text-gray-600 mb-4">Get started by adding your first record.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    @if (isset($masterFiles) && method_exists($masterFiles, 'links'))
        <div class="mb-8">
            {{ $masterFiles->links() }}
        </div>
    @endif

    <!-- Import Modal -->
    @can('masterfile.import')
        <div id="importModal"
            class="fixed inset-0 z-50 hidden bg-black bg-opacity-25 flex items-center justify-center p-4">
            <div class="card max-w-lg w-full p-8 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="font-serif text-xl font-medium ink">Import Master File Data</h3>
                        <p class="text-sm text-gray-600 mt-1">Upload your master file data</p>
                    </div>
                    <button onclick="closeImportModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Display any validation errors -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="text-sm text-red-800">
                                <h4 class="font-semibold mb-2">Import Error:</h4>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('masterfile.import') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6" id="importForm">
                    @csrf
                    <!-- File Upload Area -->
                    <div>
                        <label class="small-caps text-gray-600 block mb-3">Choose File</label>
                        <div class="border-2 border-dashed hairline rounded-xl p-8 text-center hover:border-blue-300 transition-colors"
                            ondrop="handleDrop(event)" ondragover="handleDragOver(event)"
                            ondragenter="handleDragEnter(event)" ondragleave="handleDragLeave(event)">
                            <svg class="w-10 h-10 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3"></path>
                            </svg>
                            <div class="text-sm">
                                <label for="importFile"
                                    class="text-blue-600 hover:text-blue-500 cursor-pointer font-medium">
                                    Choose a file
                                    <input id="importFile" name="file" type="file" class="sr-only"
                                        accept=".csv,.xlsx,.xls" required>
                                </label>
                                <span class="text-gray-600"> or drag and drop</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">CSV, XLSX, XLS up to 10MB</p>
                        </div>
                        <div id="selectedFileName" class="mt-2 text-sm text-gray-600 hidden"></div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3 pt-4">
                        <button type="button" onclick="closeImportModal()"
                            class="btn-ghost flex-1 px-4 py-2.5 rounded-xl text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit" id="importSubmitBtn"
                            class="btn-primary flex-1 px-4 py-2.5 rounded-xl text-sm font-medium">
                            Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    <!-- Modal for Remarks -->
    <div id="remarks-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-opacity-30 backdrop-blur-sm"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-96 overflow-hidden shadow-xl">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Remarks</h3>
                    <button id="close-remarks-modal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <div id="remarks-content" class="text-gray-700 whitespace-pre-wrap"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showRemarksModal(remarks) {
                document.getElementById('remarks-content').textContent = remarks;
                document.getElementById('remarks-modal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeRemarksModal() {
                document.getElementById('remarks-modal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Close modal when clicking outside
            document.getElementById('remarks-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRemarksModal();
                }
            });

            // Close modal with close button
            document.getElementById('close-remarks-modal').addEventListener('click', closeRemarksModal);

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('remarks-modal').classList.contains('hidden')) {
                    closeRemarksModal();
                }
            });
        </script>
        <script>
            // Mobile filter toggle
            const toggleBtn = document.getElementById('toggleFilters');
            const filterFields = document.getElementById('filterFields');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    filterFields.classList.toggle('hidden');
                    toggleBtn.querySelector('svg').classList.toggle('rotate-180');
                });
            }
            // Import modal functions
            function testImportModal() {
                console.log('🔵 testImportModal called');
                const modal = document.getElementById('importModal');
                console.log('🔵 Modal element:', modal);

                if (modal) {
                    console.log('🟢 Modal found, showing modal');
                    modal.classList.remove('hidden');
                    modal.style.display = 'flex';
                } else {
                    console.log('🔴 Modal NOT found!');
                    alert('Error: Modal element not found in DOM');
                }
            }

            function closeImportModal() {
                console.log('🔵 closeImportModal called');
                const modal = document.getElementById('importModal');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.style.display = 'none';
                    // Reset the form
                    const form = document.getElementById('importForm');
                    if (form) {
                        form.reset();
                        const fileLabel = document.getElementById('selectedFileName');
                        if (fileLabel) {
                            fileLabel.classList.add('hidden');
                            fileLabel.textContent = '';
                        }
                        // Reset submit button
                        const submitBtn = document.getElementById('importSubmitBtn');
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Import Data';
                            submitBtn.classList.remove('opacity-75');
                        }
                    }
                }
            }

            // File selection handler
            function handleFileSelect(input) {
                const fileName = input.files[0]?.name;
                const fileLabel = document.getElementById('selectedFileName');
                if (fileName && fileLabel) {
                    fileLabel.classList.remove('hidden');
                    fileLabel.textContent = `Selected file: ${fileName}`;

                    // Validate file type
                    const allowedTypes = ['.csv', '.xlsx', '.xls'];
                    const fileExtension = '.' + fileName.split('.').pop().toLowerCase();

                    if (!allowedTypes.includes(fileExtension)) {
                        alert('Please select a valid file type: CSV, XLSX, or XLS');
                        input.value = '';
                        fileLabel.classList.add('hidden');
                        fileLabel.textContent = '';
                        return;
                    }

                    // Validate file size (10MB limit)
                    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
                    if (input.files[0].size > maxSize) {
                        alert('File size must be less than 10MB');
                        input.value = '';
                        fileLabel.classList.add('hidden');
                        fileLabel.textContent = '';
                        return;
                    }
                } else if (fileLabel) {
                    fileLabel.classList.add('hidden');
                    fileLabel.textContent = '';
                }
            }

            // Drag and drop handlers
            function handleDragOver(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function handleDragEnter(e) {
                e.preventDefault();
                e.stopPropagation();
                e.currentTarget.classList.add('border-blue-300', 'bg-blue-50');
            }

            function handleDragLeave(e) {
                e.preventDefault();
                e.stopPropagation();
                e.currentTarget.classList.remove('border-blue-300', 'bg-blue-50');
            }

            function handleDrop(e) {
                e.preventDefault();
                e.stopPropagation();
                e.currentTarget.classList.remove('border-blue-300', 'bg-blue-50');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const fileInput = document.getElementById('importFile');
                    if (fileInput) {
                        fileInput.files = files;
                        handleFileSelect(fileInput);
                    }
                }
            }

            // Form submission handler with validation
            document.addEventListener('DOMContentLoaded', function() {
                const importForm = document.getElementById('importForm');
                if (importForm) {
                    importForm.addEventListener('submit', function(e) {
                        const fileInput = document.getElementById('importFile');
                        if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                            e.preventDefault();
                            alert('Please select a file to import.');
                            return false;
                        }
                    });
                }

                // File input change handler
                const fileInput = document.getElementById('importFile');
                if (fileInput) {
                    fileInput.addEventListener('change', function() {
                        handleFileSelect(this);
                    });
                }
            });

            // Close modal when clicking outside
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('importModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeImportModal();
                        }
                    });
                }
            });

            console.log("✅ Dashboard loaded successfully!");
        </script>
    @endpush

</x-app-shell>
