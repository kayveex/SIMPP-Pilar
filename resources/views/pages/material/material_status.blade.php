{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}} 
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title') 
Status Material - SIMPP Pillar Presisi 
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
<div class="flex-1 p-6 bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Status Material</h1>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-sm mb-6 p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" 
                           class="input input-bordered w-full pl-10" 
                           placeholder="Search">
                </div>
            </div>
            <!-- Filter Dropdown -->
            <div class="sm:w-48">
                <select class="select select-bordered w-full">
                    <option disabled selected>Filter</option>
                    <option>Diproses</option>
                    <option>Diterima</option>
                    <option>Dipesan</option>
                    <option>Ditolak</option>
                    <option>Disetujui</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Material Status Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left font-semibold text-gray-700">No</th>
                        <th class="text-left font-semibold text-gray-700">Tanggal Pengajuan</th>
                        <th class="text-left font-semibold text-gray-700">Tanggal Pembaruan Terakhir</th>
                        <th class="text-left font-semibold text-gray-700">Nama Proyek</th>
                        <th class="text-left font-semibold text-gray-700">Nama Klien</th>
                        <th class="text-left font-semibold text-gray-700">Status</th>
                        <th class="text-left font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">1</td>
                        <td>13 Mei 2025</td>
                        <td>00 00 0000</td>
                        <td class="font-medium">Honing Line & Hardchrome Piston</td>
                        <td>PT Makmur Jaya</td>
                        <td>
                            <span class="badge bg-yellow-100 text-yellow-800 border-yellow-200">
                                Diproses
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-sm">
                                <i class="ph ph-gear text-gray-500"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">1</td>
                        <td>00 00 0000</td>
                        <td>00 00 0000</td>
                        <td class="font-medium">Lorem Ipsum</td>
                        <td>Lorem Ipsum</td>
                        <td>
                            <span class="badge bg-purple-100 text-purple-800 border-purple-200">
                                Diterima
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-sm">
                                <i class="ph ph-gear text-gray-500"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">1</td>
                        <td>00 00 0000</td>
                        <td>00 00 0000</td>
                        <td class="font-medium">Lorem Ipsum</td>
                        <td>Lorem Ipsum</td>
                        <td>
                            <span class="badge bg-blue-100 text-blue-800 border-blue-200">
                                Dipesan
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-sm">
                                <i class="ph ph-gear text-gray-500"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">1</td>
                        <td>00 00 0000</td>
                        <td>00 00 0000</td>
                        <td class="font-medium">Lorem Ipsum</td>
                        <td>Lorem Ipsum</td>
                        <td>
                            <span class="badge bg-red-100 text-red-800 border-red-200">
                                Ditolak
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-sm">
                                <i class="ph ph-gear text-gray-500"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">1</td>
                        <td>00 00 0000</td>
                        <td>00 00 0000</td>
                        <td class="font-medium">Lorem Ipsum</td>
                        <td>Lorem Ipsum</td>
                        <td>
                            <span class="badge bg-green-100 text-green-800 border-green-200">
                                Disetujui
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-sm">
                                <i class="ph ph-gear text-gray-500"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center p-6 border-t border-gray-200">
            <div class="text-sm text-gray-600">
                Showing 1-09 of 78
            </div>
            <div class="flex gap-2">
                <button class="btn btn-ghost btn-sm">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button class="btn btn-ghost btn-sm">
                    <i class="ph ph-caret-right"></i>
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
        // Example: Search functionality
        const searchInput = document.querySelector('input[placeholder="Search"]');
        const filterSelect = document.querySelector('select');
        
        // Add event listeners for search and filter functionality
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                // Implement search logic here
                console.log('Search:', this.value);
            });
        }
        
        if (filterSelect) {
            filterSelect.addEventListener('change', function() {
                // Implement filter logic here
                console.log('Filter:', this.value);
            });
        }
    });
</script>
@endsection