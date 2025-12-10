<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/bluedale_logo_1.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masterfile Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .hairline {
            box-shadow: inset 0 0 0 1px #eaeaea;
        }

        .small-caps {
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .tabular {
            font-variant-numeric: tabular-nums;
        }

        .font-serif {
            font-family: Georgia, Cambria, "Times New Roman", Times, serif;
        }

        .font-sans {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        /* Optional: Subtle input focus glow */
        .focus-glow {
            box-shadow: 0 0 0 3px rgba(75, 187, 237, 0.2);
        }
    </style>
</head>

<body class="font-sans bg-gray-50">

    <x-app-layout>
        <div class="w-screen min-h-screen bg-[#F7F7F9]" x-data="{
            edit: false,
            saving: false,
            originalFormData: null,
        
            initForm() {
                this.originalFormData = new FormData(document.getElementById('mfForm'));
            },
        
            toggleEdit() {
                if (!this.edit) {
                    this.initForm();
                }
                this.edit = !this.edit;
            },
        
            async saveForm() {
                this.saving = true;
                const form = document.getElementById('mfForm');
                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (response.ok) {
                        this.edit = false;
                        this.showToast('Changes saved successfully');
                    } else {
                        throw new Error('Save failed');
                    }
                } catch (error) {
                    this.showToast('Error saving changes', 'error');
                } finally {
                    this.saving = false;
                }
            },
        
            cancelEdit() {
                if (this.edit) {
                    document.getElementById('mfForm').reset();
                    // Restore original values
                    if (this.originalFormData) {
                        for (let [key, value] of this.originalFormData.entries()) {
                            const input = document.querySelector(`[name='${key}']`);
                            if (input) input.value = value;
                        }
                    }
                    this.edit = false;
                } else {
                    history.back();
                }
            },
        
            showToast(message, type = 'success') {
                // Simple toast implementation
                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 px-6 py-3 rounded-xl shadow-lg z-50 ${
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     type === 'error' ? 'bg-[#d33831] text-white' : 'bg-[#22255b] text-white'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }`;
                toast.textContent = message;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            }
        }" x-init="initForm()">

            <!-- Sticky Toolbar -->
            <div class="sticky top-0 z-40 bg-white/90 backdrop-blur-sm border-b border-neutral-200/70 shadow-sm">
                <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <!-- Left: Back Button -->
                        <div>
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-neutral-600 bg-white rounded-lg border border-neutral-300 hover:bg-neutral-50 transition-colors duration-150"
                                title="Back to Dashboard">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back to Dashboard
                            </a>
                        </div>

                        <!-- Center: Entity Title & Meta -->
                        <div class="text-center sm:text-left">
                            <h1 class="text-xl sm:text-2xl font-serif text-[#1C1E26] font-semibold">
                                {{ optional($file->clientCompany)->name ?? 'No Company' }}
                            </h1>
                            <p class="text-xs sm:text-sm text-neutral-500 mt-1">
                                ID: #{{ $file->id }} • Created:
                                {{ $file->created_at ? $file->created_at->format('M d, Y') : '' }}
                            </p>
                        </div>

                        <!-- Right: Action Buttons & Delete -->
                        <div class="flex flex-wrap items-center justify-center sm:justify-end gap-2 sm:gap-3">
                            <!-- Delete Button (Top Right) -->
                            <form action="{{ route('masterfile.destroy', $file->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this record? This cannot be undone.');"
                                class="mb-2 sm:mb-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 text-xs sm:text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>

                            <!-- Job Order Button -->
                            <a href="{{ route('masterfile.print', ['file' => $file->id]) }}"
                                class="inline-flex items-center gap-1 sm:gap-2 px-3 py-1.5 text-xs sm:text-sm font-medium text-neutral-700 bg-white rounded-lg border border-neutral-300 hover:bg-neutral-50 transition-colors duration-150"
                                title="Download Job Order">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Job Order</span>
                                <span class="sm:hidden">PDF</span>
                            </a>

                            <!-- Edit/Save/Cancel Buttons -->
                            <template x-if="!edit">
                                <button type="button" @click="toggleEdit()"
                                    class="inline-flex items-center gap-1 sm:gap-2 px-3 py-1.5 text-xs sm:text-sm font-medium text-[#22255b] bg-white rounded-lg border border-[#22255b] hover:bg-[#22255b] hover:text-white transition-colors duration-150"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    <span>Edit</span>
                                </button>
                            </template>

                            <template x-if="edit">
                                <div class="flex gap-2">
                                    <button type="button" @click="saveForm()" :disabled="saving"
                                        class="inline-flex items-center gap-1 sm:gap-2 px-3 py-1.5 text-xs sm:text-sm font-medium text-white bg-[#22255b] rounded-lg hover:bg-[#1a1d4a] transition-colors duration-150 disabled:opacity-50"
                                        title="Save Changes">
                                        <svg x-show="!saving" class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg x-show="saving" class="w-4 h-4 animate-spin" fill="none"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <span x-text="saving ? 'Saving...' : 'Save'"></span>
                                    </button>
                                    <button type="button" @click="cancelEdit()"
                                        class="inline-flex items-center gap-1 sm:gap-2 px-3 py-1.5 text-xs sm:text-sm font-medium text-neutral-700 bg-white rounded-lg border border-neutral-300 hover:bg-neutral-50 transition-colors duration-150"
                                        title="Cancel">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Cancel</span>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
                <form id="mfForm" method="POST" action="{{ route('masterfile.update', $file->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Status Section -->
                    <div class="mb-8">
                        <div class="bg-white rounded-xl border border-neutral-200/70 shadow-sm p-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <h2 class="text-lg font-serif text-[#1C1E26] mb-2">Status & Product</h2>
                                    <div class="flex flex-wrap items-center gap-4">
                                        <div class="flex items-center gap-2">
                                            <label
                                                class="text-sm font-medium text-neutral-500 min-w-max">Status:</label>
                                            <select name="status" :readonly="!edit"
                                                :class="edit ?
                                                    'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                                    'w-full bg-transparent border border-black px-3 py-2 text-sm'"
                                                :disabled="!edit"
                                                class="px-3 py-1 text-sm font-medium rounded-full">
                                                @foreach (['pending', 'ongoing', 'completed', 'deleted'] as $s)
                                                    <option value="{{ $s }}" @selected($file->status === $s)>
                                                        {{ ucfirst($s) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <label
                                                class="text-sm font-medium text-neutral-500 min-w-max">Product:</label>
                                            <input name="product" value="{{ old('product', $file->product) ?: '' }}"
                                                :readonly="!edit"
                                                :class="edit ?
                                                    'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                                    'w-full bg-transparent border border-black px-3 py-2 text-sm'"
                                                class="px-3 py-1 text-sm font-medium min-w-[120px]">
                                        </div>
                                    </div>
                                </div>
                                <!-- Optional: Add an info icon or summary here if needed -->
                            </div>
                        </div>
                    </div>

                    <!-- Three Information Columns -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

                        <!-- Project Information -->
                        <div class="bg-white rounded-xl border border-black shadow-sm overflow-hidden">
                            <div class="px-6 py-3 bg-blue-200 border-b border-black">
                                <h3 class="text-xs sm:text-sm text-black font-bold small-caps tracking-wide">
                                    Project Information</h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Month</label>
                                    <input name="month" value="{{ old('month', $file->month) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Traffic</label>
                                    <input name="traffic" value="{{ old('traffic', $file->traffic) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Current
                                        Location</label>
                                    <input name="location" value="{{ old('location', $file->location) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label
                                        class="block text-xs sm:text-sm font-medium text-black mb-1">Duration</label>
                                    <input name="duration" value="{{ old('duration', $file->duration) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Artwork</label>
                                    <input name="artwork" value="{{ old('artwork', $file->artwork) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>
                            </div>
                        </div>

                        <!-- Person In Charge & Job Details -->
                        <div class="bg-white rounded-xl border border-black shadow-sm overflow-hidden">
                            <div class="px-6 py-3 bg-blue-200 border-b border-black">
                                <h3 class="text-xs sm:text-sm text-black font-bold small-caps tracking-wide">
                                    Person In Charge & Job Details</h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Client</label>
                                    <input name="client" value="{{ old('client', $file->client) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Sales
                                        Person</label>
                                    <input name="sales_person"
                                        value="{{ old('sales_person', $file->sales_person) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Email</label>
                                    <input name="email" type="email"
                                        value="{{ old('email', $file->email) ?: '' }}" :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Contact
                                        Number</label>
                                    <input name="contact_number"
                                        value="{{ old('contact_number', $file->contact_number) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Job
                                        Number</label>
                                    <input name="job_number" value="{{ old('job_number', $file->job_number) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Start
                                        Date</label>
                                    <input name="date" type="date"
                                        value="{{ old('date', $file->date ? \Illuminate\Support\Str::of($file->date)->substr(0, 10) : '') }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Date
                                        Finish</label>
                                    <input name="date_finish" type="date"
                                        value="{{ old('date_finish', $file->date_finish ? \Illuminate\Support\Str::of($file->date_finish)->substr(0, 10) : '') }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Information -->
                        <div class="bg-white rounded-xl border border-black shadow-sm overflow-hidden">
                            <div class="px-6 py-3 bg-blue-200 border-b border-black">
                                <h3 class="text-xs sm:text-sm text-black font-bold small-caps tracking-wide">
                                    Invoice Information</h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Invoice
                                        Date</label>
                                    <input name="invoice_date" type="date"
                                        value="{{ old('invoice_date', $file->invoice_date ? \Illuminate\Support\Str::of($file->invoice_date)->substr(0, 10) : '') }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-black mb-1">Invoice
                                        Number</label>
                                    <input name="invoice_number"
                                        value="{{ old('invoice_number', $file->invoice_number) ?: '' }}"
                                        :readonly="!edit"
                                        :class="edit ?
                                            'w-full h-10 rounded-lg border border-black focus:ring-2 focus:ring-[#4bbbed] focus:border-blue-500 focus-glow' :
                                            'w-full border border-black bg-neutral-50/50 px-3 py-2 text-sm'">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Outdoor Placements Table -->
                @if ($file->product_category === 'Outdoor' || $file->outdoorItems->count() > 0)
                    <div class="bg-white rounded-xl border border-black shadow-sm overflow-hidden">
                        <div class="px-6 py-4 bg-blue-200 border-b border-black">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <h3 class="text-sm font-bold text-black small-caps tracking-wide">Outdoor
                                    Placements</h3>
                                <span class="text-xs text-black sm:text-sm">
                                    Total locations: <span
                                        class="font-semibold text-black tabular">{{ $file->outdoorItems->count() }}</span>
                                    @php $totalQty = $file->outdoorItems->sum('qty'); @endphp
                                    @if ($totalQty !== $file->outdoorItems->count())
                                        • Total qty: <span
                                            class="font-semibold text-black tabular">{{ $totalQty }}</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            @if ($file->outdoorItems->isEmpty())
                                <div class="p-8 text-center text-black">
                                    <svg class="w-12 h-12 mb-4 text-neutral-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p>No outdoor placements added yet.</p>
                                </div>
                            @else
                                <table class="w-full text-sm border-collapse">
                                    <thead class="bg-emerald-50/50">
                                        <tr class="text-left border-b-2 border-black">
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[20px] border border-black">
                                                #
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[20px] border border-black ">
                                                Sub Product
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[250px] border border-black">
                                                Site Number
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[300px] border border-black">
                                                Location
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[150px] border border-black">
                                                Area
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base border border-black">
                                                Size
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[150px] border border-black">
                                                Start Date
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[150px] border border-black">
                                                End Date
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[150px] border border-black">
                                                Coordinates
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base text-right border border-black">
                                                Qty
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base border border-black">
                                                Status
                                            </th>
                                            <th
                                                class="px-4 sm:px-6 py-4 font-bold text-black text-base min-w-[300px] border border-black">
                                                Remarks
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-black">
                                        @foreach ($file->outdoorItems as $i => $item)
                                            @php
                                                $bb = $item->billboard;
                                                $loc = $bb?->location;

                                                // Build "Area": e.g., "KL – Bukit Bintang"
                                                // Prefer council/district relations if available; else fallback to item->district_council or loc->name.
                                                $councilName = $loc?->council?->name ?? null; // requires Location::council()
                                                $districtName = $loc?->district?->name ?? null; // requires Location::district()

                                                $areaLabel = null;
                                                if ($councilName || $districtName) {
                                                    $areaLabel = trim(
                                                        ($councilName ? $councilName : '') .
                                                            ($districtName ? ' – ' . $districtName : ''),
                                                        ' –',
                                                    );
                                                } else {
                                                    // legacy fallback (what you're showing now like "2|13")
    $areaLabel = $item->district_council ?: $loc?->name ?? '';
}

// Location: use location.name (specific site locality name)
$locationLabel = $loc?->name ?? '';

// Coordinates: prefer billboard lat/lng; else item->coordinates
$lat = $bb?->gps_latitude;
$lng = $bb?->gps_longitude;
$mapQ = $lat && $lng ? $lat . ',' . $lng : ($item->coordinates ?: null);

// Size: prefer billboard.size; fallback to item->size
$sizeLabel = $bb?->size ?? ($item->size ?: '');

// Site Number: from billboard (fallback to item->site)
$siteNumber = $bb?->site_number ?? ($item->site ?: '');

// Status: from billboard.status (fallback to outdoor_items.status if you later add it)
$statusLabel = $bb?->status ?? ($item->status ?? '');
                                            @endphp

                                            <tr
                                                class="hover:bg-neutral-50/50 transition-colors duration-150 border-b border-black">
                                                <td
                                                    class="px-4 sm:px-6 py-4 text-black text-base font-small text-center border border-black">
                                                    {{ $i + 1 }}
                                                </td>
                                                <td class="px-4 sm:px-6 py-4 text-black text-base font-small max-w-[150px] truncate border border-black"
                                                    title="{{ $item->sub_product }}">
                                                    {{ $item->sub_product ?: '' }}
                                                </td>
                                                <td
                                                    class="px-4 sm:px-6 py-4 text-black text-base font-small border border-black">
                                                    {{ $siteNumber }}
                                                </td>

                                                {{-- Location (location.name) --}}
                                                <td class="px-4 sm:px-6 py-4 text-black text-base font-small max-w-[350px] truncate border border-black"
                                                    title="{{ $locationLabel }}">
                                                    {{ $locationLabel }}
                                                </td>

                                                {{-- Area (Council – District) --}}
                                                <td class="px-4 sm:px-6 py-4 text-black text-base font-small max-w-[150px] truncate border border-black"
                                                    title="{{ $item->billboard?->area_label ?? '-' }}">
                                                    {{ $item->billboard?->area_label ?? '-' }}
                                                </td>

                                                {{-- Size --}}
                                                <td
                                                    class="px-4 sm:px-6 py-4 text-black text-base font-small border border-black">
                                                    {{ $sizeLabel }}
                                                </td>

                                                {{-- Start/End from outdoor_items  --}}
                                                <td
                                                    class="px-4 sm:px-6 py-4 text-black text-base font-small border border-black">
                                                    {{ $item->start_date?->format('d/m/y') ?? '' }}
                                                </td>
                                                <td
                                                    class="px-4 sm:px-6 py-4 text-black text-base font-small border border-black">
                                                    {{ $item->end_date?->format('d/m/y') ?? '' }}
                                                </td>

                                                {{-- Coordinates link --}}
                                                <td class="px-4 sm:px-6 py-4 border border-black">
                                                    @if ($mapQ)
                                                        <a href="https://maps.google.com/?q=  {{ urlencode($mapQ) }}"
                                                            target="_blank"
                                                            class="text-blue-700 hover:underline focus:outline-none focus:ring-2 focus:ring-[#4bbbed] focus:ring-opacity-50 rounded text-base">
                                                            {{ $lat && $lng ? $lat . ', ' . $lng : $item->coordinates }}
                                                        </a>
                                                    @else
                                                        <span class="text-black text-base">-</span>
                                                    @endif
                                                </td>

                                                <td
                                                    class="px-4 sm:px-6 py-4 text-right text-black text-base font-medium border border-black">
                                                    {{ $item->qty ?? 1 }}
                                                </td>

                                                {{-- Status --}}
                                                <td class="px-4 sm:px-6 py-4 text-black text-base font-medium border border-black"
                                                    x-data="{
                                                        v: '{{ $item->status ?? '' }}',
                                                        saving: false,
                                                        async save(val) {
                                                            this.saving = true;
                                                            try {
                                                                const res = await fetch('{{ route('outdoor-items.status', $item->id) }}', {
                                                                    method: 'PATCH',
                                                                    headers: {
                                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                                        'Content-Type': 'application/json',
                                                                        'X-Requested-With': 'XMLHttpRequest',
                                                                    },
                                                                    body: JSON.stringify({ status: val }),
                                                                });
                                                                if (!res.ok) throw new Error();
                                                                const data = await res.json();
                                                                this.v = data.status;
                                                            } catch (e) {
                                                                alert('Gagal update status');
                                                            } finally {
                                                                this.saving = false;
                                                            }
                                                        }
                                                    }">
                                                    <div class="inline-flex items-center gap-1">
                                                        <select x-model="v" @change="save($event.target.value)"
                                                            class="h-10 rounded-md border border-black px-3 text-base focus:ring-2 focus:ring-[#4bbbed] focus:border-[#4bbbed] focus-glow bg-white">
                                                            <option value="">-</option>
                                                            <option value="pending_payment">pending_payment</option>
                                                            <option value="pending_install">pending_install</option>
                                                            <option value="ongoing">ongoing</option>
                                                            <option value="completed">completed</option>
                                                            <option value="dismantle">dismantle</option>
                                                        </select>
                                                        <span x-show="saving"
                                                            class="text-base text-black">Saving…</span>
                                                    </div>
                                                </td>

                                                <td class="px-4 sm:px-6 py-4 text-black text-base font-medium max-w-[150px] truncate border border-black"
                                                    title="{{ $item->remarks ?: '' }}">
                                                    {{ $item->remarks ?: '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-app-layout>

</body>

</html>
