{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Dashboard SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
    <!-- Dashboard Calendar CSS -->
    <link href="{{ asset('css/dashboard-calendar.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.min.css" />

@endsection

{{-- Sidebar --}}
@section('sidebar')
    @include('layouts.molecules.sidebar')
@endsection

{{-- Topbar --}}
@section('topbar')
    @include('layouts.molecules.topbar')
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="p-6">

        <!-- Active Projects Table -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Proyek Aktif</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klien
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tenggat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sisa
                                Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($activeProjects as $index => $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $project->project_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $project->client_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $project->estimated_end_date ? \Carbon\Carbon::parse($project->estimated_end_date)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($project->estimated_end_date)
                                        {{ $project->days_remaining >= 0 ? $project->days_remaining : 0 }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($project->progress_percentage < 25)
                                        <span
                                            class="text-white font-semibold bg-red-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span>
                                    @elseif ($project->progress_percentage < 50)
                                        <span
                                            class="text-white font-semibold bg-yellow-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span>
                                    @elseif ($project->progress_percentage < 75)
                                        <span
                                            class="text-white font-semibold bg-blue-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span>
                                    @else
                                        <span
                                            class="text-white font-semibold bg-green-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada proyek aktif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <span class="text-sm text-gray-700">Show</span>
                    <select
                        class="border border-gray-300 rounded-md text-sm px-2 py-1 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Revised Statistics Cards Layout --}}
        <div class="flex flex-row w-full gap-6 my-10 items-stretch">
            {{-- Left --}}
            <div class="flex flex-col w-1/2 gap-6">
                <!-- Top Row - Statistics Cards -->
                <div class="flex flex-row gap-6 h-full">
                    <!-- Proyek Masuk Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 flex-1 flex flex-col justify-between">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Proyek Masuk</h3>
                        <div class="text-3xl font-bold text-gray-900 mb-2">{{ $activeProjectsCount }}</div>
                        <div class="flex items-center text-sm mt-auto">
                            @if ($differenceIn > 0)
                                <i class="ph ph-trend-up w-4 h-4 text-green-500 mr-1"></i>
                                <span class="text-green-600 font-medium">+{{ $differenceIn }}</span>
                                <span class="text-gray-500 ml-1">dari bulan {{ $prevMonthName }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right --}}
            <div class="flex flex-col w-1/2 gap-6">
                <!-- Top Row - Statistics Cards -->
                <div class="flex flex-row gap-6 h-full">
                    <!-- Proyek Selesai Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 flex-1 flex flex-col justify-between">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Proyek Selesai</h3>
                        <div class="text-3xl font-bold text-gray-900 mb-2">{{ $completedProjectsCount }}</div>
                        <div class="flex items-center text-sm mt-auto">
                            @if ($differenceOut > 0)
                                <i class="ph ph-trend-up w-4 h-4 text-green-500 mr-1"></i>
                                <span class="text-green-600 font-medium">+{{ $differenceOut }}</span>
                                <span class="text-gray-500 ml-1">dari bulan {{ $prevMonthName }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bottom Row - Calendar and User Activity -->
        <div class="flex flex-row w-full h-fit gap-6 my-10 items-stretch min-h-[80vh]">
            <!-- Left Section -->
            <div class="flex flex-col w-1/2 gap-6">
                <!-- Bottom Row - Calendar Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Kalender Proyek</h3>
                    <!-- Detail Calendar View -->
                    <div id="calendar" class="h-fit"></div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex flex-col w-1/2 gap-6">
                <!-- Bottom Row - User Activity Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Pengguna</h3>
                    <div class="h-48 overflow-y-auto">
                        @if ($recentActivities->count() > 0)
                            <div class="space-y-3">
                                @foreach ($recentActivities as $activity)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                 src="{{ $activity->user->photo ? asset('storage/' . $activity->user->photo) : 'https://placehold.co/300x300' }}"
                                                 alt="{{ $activity->user->name }}">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm flex flex-col">
                                                <span class="font-medium text-gray-900">{{ $activity->user->name }}</span>
                                                <span class="text-gray-500"> {{ $activity->message }}</span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $activity->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="h-full flex items-center justify-center">
                                <span class="text-gray-400">Tidak ada aktivitas terbaru</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const events = @json($calendarProjects);
            const calendarContainer = document.getElementById("calendar");

            let viewDate = new Date();

            function renderCalendar(year, month) {
                const days = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const startDay = firstDay.getDay();
                const totalDays = lastDay.getDate();

                // Header Navigasi
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                let nav = `
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex gap-2">
                            <button id="prevYear" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">&laquo;</button>
                            <button id="prevMonth" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">&lsaquo;</button>
                        </div>
                        <h2 class="text-lg font-semibold">${monthNames[month]} ${year}</h2>
                        <div class="flex gap-2">
                            <button id="nextMonth" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">&rsaquo;</button>
                            <button id="nextYear" class="bg-gray-200 text-sm px-2 py-1 rounded hover:bg-gray-300">&raquo;</button>
                        </div>
                    </div>
                `;

                // Tabel
                let table = `<table class="w-full table-fixed border-collapse">`;
                table += "<thead><tr>";
                days.forEach(day => {
                    table += `<th class="border px-2 py-1 bg-gray-100 text-xs">${day}</th>`;
                });
                table += "</tr></thead>";

                let tbody = "<tbody><tr>";
                let day = 1;
                let col = 0;

                for (let i = 0; i < startDay; i++) {
                    tbody += `<td class="border p-2 text-sm text-gray-400"></td>`;
                    col++;
                }

                while (day <= totalDays) {
                    const dateStr = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;

                    // Filter event yang start / end pada tanggal ini
                    const startEvents = events.filter(e => e.start.startsWith(dateStr));
                    const endEvents = events.filter(e => e.end.startsWith(dateStr));

                    // Warna cell jika ada event
                    const hasEvent = startEvents.length > 0 || endEvents.length > 0;
                    const cellHighlight = hasEvent ? 'bg-gray-50' : '';

                    tbody += `<td class="border p-2 text-xs align-top ${cellHighlight}">
                                <div class="font-semibold mb-1">${day}</div>`;

                    startEvents.forEach(e => {
                        tbody += `<div class="text-[10px] text-green-700 bg-green-100 px-1 py-0.5 rounded mb-1">
                                    ✅ ${e.title}<br><span class="italic">Proyek dimulai</span>
                                </div>`;
                    });

                    endEvents.forEach(e => {
                        tbody += `<div class="text-[10px] text-red-700 bg-red-100 px-1 py-0.5 rounded mb-1">
                                    ❌ ${e.title}<br><span class="italic">Proyek harus selesai</span>
                                </div>`;
                    });

                    tbody += `</td>`;
                    day++;
                    col++;

                    if (col % 7 === 0 && day <= totalDays) {
                        tbody += "</tr><tr>";
                    }
                }

                while (col % 7 !== 0) {
                    tbody += `<td class="border p-2 text-sm text-gray-300"></td>`;
                    col++;
                }

                tbody += "</tr></tbody>";
                table += tbody + "</table>";

                calendarContainer.innerHTML = nav + table;

                // Navigasi event
                document.getElementById("prevMonth").onclick = () => {
                    viewDate.setMonth(viewDate.getMonth() - 1);
                    renderCalendar(viewDate.getFullYear(), viewDate.getMonth());
                };
                document.getElementById("nextMonth").onclick = () => {
                    viewDate.setMonth(viewDate.getMonth() + 1);
                    renderCalendar(viewDate.getFullYear(), viewDate.getMonth());
                };
                document.getElementById("prevYear").onclick = () => {
                    viewDate.setFullYear(viewDate.getFullYear() - 1);
                    renderCalendar(viewDate.getFullYear(), viewDate.getMonth());
                };
                document.getElementById("nextYear").onclick = () => {
                    viewDate.setFullYear(viewDate.getFullYear() + 1);
                    renderCalendar(viewDate.getFullYear(), viewDate.getMonth());
                };
            }

            renderCalendar(viewDate.getFullYear(), viewDate.getMonth());
        });
    </script>
@endsection



