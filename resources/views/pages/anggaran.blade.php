{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Dashboard SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
    
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
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Anggaran Proyek</h1>
        <div class="breadcrumbs text-sm text-gray-500 mt-1">
            <ul>
                <li><a href="#" class="hover:text-blue-600">HOME</a></li>
                <li>Anggaran Proyek</li>
            </ul>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
            <!-- Search and Filters -->
            <div class="flex flex-col sm:flex-row gap-3 flex-1">
                <!-- Search Input -->
                <div class="relative">
                    <input type="text" 
                           placeholder="Search" 
                           class="input input-bordered w-full sm:w-80 pl-10 pr-4 py-2 text-sm"
                           id="searchInput">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Filter Button -->
                <button class="btn btn-outline btn-sm gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>

                <!-- Prioritas Dropdown -->
                <select class="select select-bordered select-sm w-full sm:w-32">
                    <option>Prioritas</option>
                    <option>Tinggi</option>
                    <option>Sedang</option>
                    <option>Rendah</option>
                </select>

                <!-- Jenis Dropdown -->
                <select class="select select-bordered select-sm w-full sm:w-32">
                    <option>Jenis</option>
                    <option>On-site</option>
                    <option>Remote</option>
                    <option>Hybrid</option>
                </select>

                <!-- Status Dropdown -->
                <select class="select select-bordered select-sm w-full sm:w-32">
                    <option>Status</option>
                    <option>Berlangsung</option>
                    <option>Selesai</option>
                    <option>Tertunda</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <!-- Reset Filter -->
                <button class="btn btn-ghost btn-sm text-red-600 hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset Filter
                </button>

                <!-- Rencana Button -->
                <button class="btn btn-outline btn-sm">
                    Rencana
                </button>

                <!-- Realisasi Button -->
                <button class="btn btn-primary btn-sm">
                    Realisasi
                </button>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-gray-800">Daftar Anggaran Proyek</h2>
                <div class="text-sm text-gray-500">
                    Showing 1-09 of 78
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left font-semibold text-gray-700">No</th>
                        <th class="text-left font-semibold text-gray-700">Nama Proyek</th>
                        <th class="text-left font-semibold text-gray-700">Klien</th>
                        <th class="text-left font-semibold text-gray-700">Jenis</th>
                        <th class="text-left font-semibold text-gray-700">Tanggal</th>
                        <th class="text-left font-semibold text-gray-700">Status</th>
                        <th class="text-left font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">1</td>
                        <td>
                            <div class="font-medium text-gray-900">
                                Rekondisi Pipa Laut X
                            </div>
                        </td>
                        <td>
                            <div class="text-gray-700">
                                PT Gelombang Barat
                            </div>
                        </td>
                        <td>
                            <div class="text-gray-700">
                                On-site
                            </div>
                        </td>
                        <td>
                            <div class="text-gray-700">
                                05/05/2025 - 01/06/2025
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-warning text-white font-medium">
                                Berlangsung
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <!-- View/Details Button -->
                                <button class="btn btn-ghost btn-sm p-2 hover:bg-gray-100" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">2</td>
                        <td>
                            <div class="font-medium text-gray-900">
                                Instalasi Sistem Keamanan Y
                            </div>
                        </td>
                        <td>
                            <div class="text-gray-700">
                                PT Teknologi Maju
                            </div>
                        </td>
                        <td>
                            <div class="text-gray-700">
                                Remote
                            </div>
                        </td>
                        <td>
                            <div class="text-gray-700">
                                10/05/2025 - 15/06/2025
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-success text-white font-medium">
                                Selesai
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <button class="btn btn-ghost btn-sm p-2 hover:bg-gray-100" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Showing 1-09 of 78 results
                </div>
                <div class="join">
                    <button class="join-item btn btn-sm" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="join-item btn btn-sm btn-active">1</button>
                    <button class="join-item btn btn-sm">2</button>
                    <button class="join-item btn btn-sm">3</button>
                    <button class="join-item btn btn-sm">...</button>
                    <button class="join-item btn btn-sm">9</button>
                    <button class="join-item btn btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Script for JS --}}
@section('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            if (rowText.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filter functionality can be added here
    document.querySelectorAll('select').forEach(select => {
        select.addEventListener('change', function() {
            // Add filter logic here
            console.log('Filter changed:', this.value);
        });
    });

    // Reset filter functionality
    document.querySelector('.btn-ghost').addEventListener('click', function() {
        // Reset all filters
        document.getElementById('searchInput').value = '';
        document.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
        });
        
        // Show all rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.style.display = '';
        });
    });
</script>
@endsection