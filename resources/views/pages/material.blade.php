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
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
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
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
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
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="btn btn-sm btn-ghost">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
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