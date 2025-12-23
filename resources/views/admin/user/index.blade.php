<x-layout-admin>
    <x-slot:title>
        Admin User
    </x-slot:title>

    <div class="">
        <div class="flex justify-between items-center mb-6">
            <div class="">
                <h1 class="text-3xl font-bold mb-3">User List</h1>
                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'User', 'url' => '/dashboard/user'],
                ]" />
            </div>
            <a href="/dashboard/user/tambah"
                class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Add
                User</a>
        </div>

        <div class="bg-white rounded-lg shadow-md w-full overflow-x-scroll md:overflow-x-hidden">
            <form action="{{ route('admin.user.index') }}" method="GET" class="p-4 border-b-2 border-gray-300">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex flex-row-reverse items-center gap-2 md:w-[300px] w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search users..." class="w-full focus:outline-none rounded-md px-3">

                        <button type="submit" class="">
                            <x-ri-search-line class="w-6 h-6 cursor-pointer" />
                        </button>
                    </div>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                onchange="this.form.submit()"
                                class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                            <span>—</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                onchange="this.form.submit()"
                                class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                        </div>
                        <select name="role" onchange="this.form.submit()"
                            class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                            <option value="">Select Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="editor" {{ request('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        <select name="sort" onchange="this.form.submit()"
                            class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Sort By</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Name (A-Z)
                            </option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Name (Z-A)
                            </option>
                            <option value="tanggal_asc" {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>
                                Join Date (Oldest)</option>
                            <option value="tanggal_desc" {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>
                                Join Date (Newest)</option>
                        </select>
                        @if (request()->hasAny(['search', 'role', 'start_date', 'end_date', 'sort']))
                            <a href="{{ route('admin.user.index') }}" class="text-red-500 text-sm hover:underline">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <table class="w-full table-auto table-responsive overflow-x-scroll">
                <thead class="bg-slate-200">
                    <tr class="text-left border-b-2 border-gray-300 ">
                        <th class="py-2 px-6">ID</th>
                        <th class="py-2 px-6">Name</th>
                        <th class="py-2 px-6">Email</th>
                        <th class="py-2 px-6">Role</th>
                        <th class="py-2 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if ($users->isEmpty())
                        <tr
                            class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                            <td colspan="5" class="text-center py-4">No users found.</td>
                        </tr>
                    @endif
                    @foreach ($users as $user)
                        <tr
                            class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                            <td class="py-2 px-6">{{ $user->id }}</td>
                            <td class="py-2 px-6">{{ $user->name }}</td>
                            <td class="py-2 px-6">{{ $user->email }}</td>
                            @if ($user->role == 'admin')
                                <td class="py-2 px-6">
                                    <span
                                        class="py-0.5 px-3 border-2 border-green-500 rounded-full text-green-500">Admin</span>
                                </td>
                            @elseif ($user->role == 'editor')
                                <td class="py-2 px-6">
                                    <span
                                        class="py-0.5 px-3 border-2 border-yellow-500 rounded-full text-yellow-500">Editor</span>
                                </td>
                            @else
                                <td class="py-2 px-6">
                                    <span
                                        class="py-0.5 px-3 border-2 border-gray-500 rounded-full text-gray-500">Viewer</span>
                                </td>
                            @endif
                            <td class="py-2 px-6">
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini? Data yang dihapus tidak bisa dikembalikan.');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div
                class="border-gray-300 flex justify-between items-center px-6 py-4 text-sm flex-col md:flex-row gap-4 md:gap-0">
                <div class="">
                    <p class="">
                        Showing
                        <span class="font-bold">{{ $users->firstItem() }}</span>
                        to
                        <span class="font-bold">{{ $users->lastItem() }}</span>
                        of
                        <span class="font-bold">{{ $users->total() }}</span>
                        results
                    </p>
                </div>
                <div class="">
                    @if ($users->hasPages())
                        <nav>
                            <ul class="inline-flex flex-wrap items-center gap-2">
                                <li>
                                    @if ($users->onFirstPage())
                                        <button disabled
                                            class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md cursor-not-allowed">Previous</button>
                                    @else
                                        <a href="{{ $users->previousPageUrl() }}"
                                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Previous</a>
                                    @endif
                                </li>
                                @foreach (range(1, $users->lastPage()) as $page)
                                    <li>
                                        @if ($page == $users->currentPage())
                                            <span
                                                class="px-3 py-1 bg-blue-500 text-white rounded-md">{{ $page }}</span>
                                        @else
                                            <a href="{{ $users->url($page) }}"
                                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endforeach
                                <li>
                                    @if ($users->hasMorePages())
                                        <a href="{{ $users->nextPageUrl() }}"
                                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Next</a>
                                    @else
                                        <button disabled
                                            class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md cursor-not-allowed">Next</button>
                                    @endif
                                </li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>
