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
            <div class="flex gap-2 flex-wrap justify-end">
                <a href="/dashboard/user/pdf-report"
                    class="bg-green-500 text-white rounded-md px-6 py-2 hover:bg-green-600 transition duration-300 text-xs md:text-sm">PDF
                    Report</a>
                <a href="/dashboard/user/tambah"
                    class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-xs md:text-sm">Add
                    User</a>
            </div>
        </div>

        <x-card :action="route('admin.user.index')" :data="$users" :paginator="$users->appends(request()->query())" :showRole="true">
            <table class="w-full table-auto table-responsive overflow-x-scroll">
                <thead class="bg-slate-200">
                    <tr class="text-left border-b-2 border-gray-300 ">
                        <th class="py-2 px-6">ID</th>
                        <th class="py-2 px-6">Name</th>
                        <th class="py-2 px-6">Email</th>
                        <th class="py-2 px-6">Email Status</th>
                        <th class="py-2 px-6">Role</th>
                        <th class="py-2 px-6">Status</th>
                        <th class="py-2 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if ($users->isEmpty())
                        <tr
                            class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                            <td colspan="6" class="text-center py-4">No users found.</td>
                        </tr>
                    @endif
                    @foreach ($users as $user)
                        <tr
                            class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                            <td class="py-2 px-6">{{ $user->id }}</td>
                            <td class="py-2 px-6">{{ $user->name }}</td>
                            <td class="py-2 px-6">{{ $user->email }}</td>
                            <td class="py-2 px-6">
                                @if ($user->hasVerifiedEmail())
                                    <span
                                        class="py-0.5 px-3 bg-green-100 text-green-600 rounded-full font-bold text-xs">Verified</span>
                                @else
                                    <span
                                        class="py-0.5 px-3 bg-yellow-100 text-yellow-600 rounded-full font-bold text-xs">Unverified</span>
                                @endif
                            </td>

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
                                @if ($user->is_banned)
                                    <span
                                        class="py-0.5 px-3 bg-red-100 text-red-600 rounded-full font-bold text-xs">Banned</span>
                                @else
                                    <span
                                        class="py-0.5 px-3 bg-green-100 text-green-600 rounded-full font-bold text-xs">Active</span>
                                @endif
                            </td>

                            <td class="py-2 px-6 whitespace-nowrap items-center">
                                <x-table-action>

                                    @if (!$user->hasVerifiedEmail())
                                        <button
                                            @click="open = false; confirmAction(
                                                '{{ route('admin.user.resend-verification', $user->id) }}',
                                                'POST',
                                                'Verify Email',
                                                'Are you sure you want to verify the email of user \'{{ $user->name }}\'?',
                                                'success',
                                                'Yes, Verify'
                                            )"
                                            class="block w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 transition cursor-pointer font-semibold">
                                            Verify Email
                                        </button>
                                    @endif

                                    @if ($user->is_banned)
                                        <button
                                            @click="open = false; confirmAction(
                                                '{{ route('admin.user.ban', $user->id) }}',
                                                'PATCH',
                                                'Unban User',
                                                'Apakah Anda yakin ingin mengaktifkan kembali user \'{{ $user->name }}\'?',
                                                'success',
                                                'Ya, Aktifkan'
                                            )"
                                            class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-green-50 transition cursor-pointer font-semibold">
                                            Unban
                                        </button>
                                    @else
                                        <button
                                            @click="open = false; confirmAction(
                                                '{{ route('admin.user.ban', $user->id) }}',
                                                'PATCH',
                                                'Ban User',
                                                'Apakah Anda yakin ingin memblokir user \'{{ $user->name }}\'? User akan logout otomatis.',
                                                'danger',
                                                'Ya, Blokir'
                                            )"
                                            class="block w-full text-left px-4 py-2 text-sm text-orange-500 hover:bg-orange-50 transition cursor-pointer font-semibold">
                                            Ban User
                                        </button>
                                    @endif

                                    <button
                                        @click="open = false; confirmAction(
                                            '{{ route('admin.user.destroy', $user->id) }}',
                                            'DELETE',
                                            'Delete User',
                                            'Are you sure you want to delete the user \'{{ $user->name }}\'? This action cannot be undone.',
                                            'danger',
                                            'Yes, Delete'
                                        )"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-700 transition cursor-pointer">
                                        Delete
                                    </button>
                                </x-table-action>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    </div>
</x-layout-admin>
