{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Arsip Proyek - SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
    <style>
        .table-zebra tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-selesai {
            background-color: #10b981;
            color: white;
        }
    </style>
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
    <div class="min-h-screen bg-gray-50">
        <div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">Arsip Proyek</h1>

                <!-- Search and Filter Section -->
                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ph ph-magnifying-glass h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="text" class="input input-bordered w-full pl-10" placeholder="Search">
                        </div>
                    </div>
                    <div class="w-full sm:w-auto">
                        <select class="select select-bordered w-full sm:w-auto min-w-[120px]">
                            <option disabled selected>Filter</option>
                            <option>Semua Status</option>
                            <option>Selesai</option>
                            <option>Progress</option>
                            <option>Pending</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-6">
                                    No</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-6">
                                    Nama Proyek</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-6">
                                    Klien</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-6">
                                    Jenis</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-6">
                                    Tanggal</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-6">
                                    Status</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-6">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @for ($i = 1; $i <= 7; $i++)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $i }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">XYZ</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Lorem Ipsum</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">On-site</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">00/00/0000 - 00/00/0000
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge status-selesai">Selesai</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="btn btn-ghost btn-sm hover:bg-gray-100" title="Lihat Detail">
                                            <i class="ph ph-gear-six w-5 h-5 text-gray-500"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination Section -->
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">1-09</span> of <span class="font-medium">78</span>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="btn btn-ghost btn-sm" disabled>
                        <i class="ph ph-caret-left w-4 h-4"></i>
                    </button>
                    <button class="btn btn-ghost btn-sm">
                        <i class="ph ph-caret-right w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Script for JS --}}
@section('scripts')
    <script>
        // Optional: Add any JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.querySelector('input[placeholder="Search"]');
            const filterSelect = document.querySelector('select');

            // Add event listeners for search and filter
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    // Implement search logic here
                    console.log('Searching for:', this.value);
                });
            }

            if (filterSelect) {
                filterSelect.addEventListener('change', function() {
                    // Implement filter logic here
                    console.log('Filter changed to:', this.value);
                });
            }

            // Action button functionality
            const actionButtons = document.querySelectorAll('button[title="Lihat Detail"]');
            actionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Implement detail view logic here
                    console.log('View details clicked');
                });
            });
        });
    </script>
@endsection
