<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List Report - {{ date('M d, Y') }}</title>

    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            @page {
                size: A4;
                margin: 2cm;
            }

            .paper-preview {
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }

            body {
                background: none !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans text-gray-800">
    <div
        class="no-print fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm px-4 py-3 flex justify-between items-center">
        <span class="font-bold text-gray-700 text-sm md:text-base hidden sm:block">Preview Laporan</span>

        <div class="flex gap-2 w-full sm:w-auto justify-end">
            <a href="{{ route('admin.user.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition">
                Back
            </a>
            <button onclick="window.print()"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Report
            </button>
        </div>
    </div>

    <div class="h-16 no-print"></div>

    <div
        class="paper-preview w-full md:w-[210mm] min-h-screen md:min-h-[297mm] mx-auto bg-white p-6 md:p-10 md:my-8 md:shadow-lg">

        <div
            class="border-b-2 border-gray-800 pb-4 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-xl md:text-2xl font-bold uppercase tracking-wide">FOCUSTODAY</h1>
                <p class="text-sm text-gray-600 mt-1">User List Report</p>
            </div>
            <div class="text-left md:text-right">
                <p class="text-xs text-gray-500">Print Date</p>
                <p class="font-semibold text-sm">{{ date('F d, Y, H:i') }}</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-400">
                        <th class="py-3 px-2 text-xs font-bold uppercase text-gray-700 tracking-wider text-center w-10">
                            No</th>
                        <th class="py-3 px-2 text-xs font-bold uppercase text-gray-700 tracking-wider w-20">User ID</th>
                        <th class="py-3 px-2 text-xs font-bold uppercase text-gray-700 tracking-wider">Full Name</th>
                        <th class="py-3 px-2 text-xs font-bold uppercase text-gray-700 tracking-wider">Email Address
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($users as $index => $user)
                        <tr class="border-b border-gray-200 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="py-3 px-2 text-center text-gray-500">{{ $loop->iteration }}</td>
                            <td class="py-3 px-2 font-mono text-xs text-gray-500">#{{ $user->id }}</td>
                            <td class="py-3 px-2 font-semibold text-gray-900">
                                {{ $user->name }}
                                <div class="text-[10px] text-gray-500 md:hidden mt-0.5 uppercase">{{ $user->role }}
                                </div>
                            </td>
                            <td class="py-3 px-2 text-gray-600">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-12 flex justify-end page-break-inside-avoid print:mt-20">
            <div class="text-center w-48">
                <p class="text-sm text-gray-600 mb-16">Approved by,</p>
                <p class="text-sm font-bold border-b border-gray-400 pb-1">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </p>
                <p class="text-xs text-gray-500 mt-1">Automatically generated by system</p>
            </div>
        </div>

    </div>

</body>

</html>
