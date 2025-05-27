{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Pengajuan Material - Dashboard SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
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
    <div class="p-6 bg-gray-50 min-h-screen">
        {{-- Page Header --}}
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Pengajuan Material</h1>
                <p class="text-gray-600">Kelola pengajuan material proyek</p>
            </div>
            <button class="btn btn-primary">
                <i class="ph ph-plus text-xl mr-2"></i>
                Tambah Pengajuan
            </button>
        </div>

        {{-- Search and Filter Section --}}
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-col sm:flex-row gap-4">
                {{-- Search Input --}}
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ph ph-magnifying-glass text-gray-400" style="font-size: 20px;"></i>
                        </div>
                        <input type="text" class="input input-bordered w-full pl-10" placeholder="Search">
                    </div>
                </div>

                {{-- Filter Dropdown --}}
                <div class="w-full sm:w-48">
                    <select class="select select-bordered w-full">
                        <option disabled selected>Filter</option>
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-hover w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left font-semibold text-gray-700">No</th>
                            <th class="text-left font-semibold text-gray-700">Tanggal Pengajuan</th>
                            <th class="text-left font-semibold text-gray-700">Nama Proyek</th>
                            <th class="text-left font-semibold text-gray-700">Nama Klien</th>
                            <th class="text-center font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-4 text-gray-800 font-medium">1</td>
                            <td class="py-4 text-gray-600">13 Mei 2025</td>
                            <td class="py-4">
                                <div class="font-medium text-gray-800">Honing Line &</div>
                                <div class="font-medium text-gray-800">Hardchrome Piston</div>
                            </td>
                            <td class="py-4 text-gray-600">PT Makmur Jaya</td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="btn btn-sm btn-ghost text-blue-600 hover:bg-blue-50">
                                        <i class="ph ph-eye" style="font-size: 16px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50">
                                        <i class="ph ph-trash" style="font-size: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-100">
                            <td class="py-4 text-gray-800 font-medium">2</td>
                            <td class="py-4 text-gray-600">5 Mei 2025</td>
                            <td class="py-4 font-medium text-gray-800">Rekondisi Mesin Bubut B</td>
                            <td class="py-4 text-gray-600">PT Laba Besar</td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="btn btn-sm btn-ghost text-blue-600 hover:bg-blue-50">
                                        <i class="ph ph-eye" style="font-size: 16px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50">
                                        <i class="ph ph-trash" style="font-size: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-100">
                            <td class="py-4 text-gray-800 font-medium">3</td>
                            <td class="py-4 text-gray-600">20 April 2025</td>
                            <td class="py-4 font-medium text-gray-800">Insitu Drilling</td>
                            <td class="py-4 text-gray-600">PT Laut Selatan</td>
                            <td class="py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="btn btn-sm btn-ghost text-blue-600 hover:bg-blue-50">
                                        <i class="ph ph-eye" style="font-size: 16px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50">
                                        <i class="ph ph-trash" style="font-size: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="flex justify-between items-center p-4 border-t border-gray-100">
                <div class="text-sm text-gray-600">
                    Showing 1-09 of 78
                </div>
                <div class="flex gap-2">
                    <button class="btn btn-sm btn-ghost" disabled>
                        <i class="ph ph-caret-left" style="font-size: 16px;"></i>
                    </button>
                    <button class="btn btn-sm btn-ghost">
                        <i class="ph ph-caret-right" style="font-size: 16px;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Script for JS --}}
@section('scripts')
    <script>
        // Add any JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.querySelector('input[placeholder="Search"]');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    // Add search functionality here
                    console.log('Searching for:', e.target.value);
                });
            }

            // Filter functionality
            const filterSelect = document.querySelector('select');
            if (filterSelect) {
                filterSelect.addEventListener('change', function(e) {
                    // Add filter functionality here
                    console.log('Filter changed to:', e.target.value);
                });
            }

            // Action buttons
            const viewButtons = document.querySelectorAll('.btn-ghost:first-child');
            const deleteButtons = document.querySelectorAll('.btn-ghost:last-child');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Add view functionality here
                    console.log('View button clicked');
                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Add delete confirmation here
                    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                        console.log('Delete confirmed');
                    }
                });
            });
        });
    </script>
@endsection
