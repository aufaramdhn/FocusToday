@props([
    'action', // URL Route (Wajib)
    'showSearch' => true, // Default: Tampil
    'showDate' => false, // Default: Sembunyi
    'showRole' => false, // Default: Sembunyi
    'showSort' => true, // Default: Tampil
])

<form action="{{ $action }}" method="GET" class="p-4 border-b-2 border-gray-300">
    <div class="flex items-center justify-between gap-4 flex-wrap">

        @if ($showSearch)
            <div class="flex flex-row-reverse items-center gap-2 md:w-[300px] w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                    class="w-full focus:outline-none rounded-md px-3">
                <button type="submit">
                    <x-ri-search-line class="w-6 h-6 cursor-pointer" />
                </button>
            </div>
        @else
            <div></div>
        @endif

        <div class="flex items-center gap-4 flex-wrap">

            {{ $slot }}

            @if ($showDate)
                <div class="flex flex-wrap items-center gap-2 text-sm">
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        onchange="this.form.submit()" class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                    <span>—</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        onchange="this.form.submit()" class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                </div>
            @endif

            @if ($showRole)
                <select name="role" onchange="this.form.submit()"
                    class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1 text-sm">
                    <option value="">Select Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="editor" {{ request('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            @endif

            @if ($showSort)
                <select name="sort" onchange="this.form.submit()"
                    class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1 text-sm">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Sort By</option>
                    <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Name (Z-A)
                    </option>
                    <option value="tanggal_asc" {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>Oldest
                    </option>
                    <option value="tanggal_desc" {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>Newest
                    </option>
                </select>
            @endif

            @if (request()->query())
                <a href="{{ $action }}" class="text-red-500 text-sm hover:underline">
                    Reset Filter
                </a>
            @endif
        </div>
    </div>
</form>
