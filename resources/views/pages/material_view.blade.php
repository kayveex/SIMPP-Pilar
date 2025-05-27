{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
Lihat Pengajuan - Dashboard SIMPP Pillar Presisi
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
<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Breadcrumb -->
    <div class="breadcrumbs text-sm mb-6">
        <ul>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Pengajuan Material</a></li>
            <li class="text-gray-500">Lihat Pengajuan</li>
        </ul>
    </div>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Lihat Pengajuan</h1>
        <button class="btn btn-primary">
            <i class="ph ph-arrow-counter-clockwise mr-2"></i>
            Kembali
        </button>
    </div>

    <!-- Project and Client Selection -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Project Name -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Nama Proyek</h2>
            <div class="form-control">
                <select class="select select-bordered w-full bg-gray-100">
                    <option selected>Proyek A</option>
                    <option>Proyek B</option>
                    <option>Proyek C</option>
                </select>
            </div>
        </div>

        <!-- Client -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Klien</h2>
            <div class="form-control">
                <select class="select select-bordered w-full bg-gray-100">
                    <option selected>Klien A</option>
                    <option>Klien B</option>
                    <option>Klien C</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Materials Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Material</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-center font-semibold text-gray-700">No</th>
                        <th class="text-center font-semibold text-gray-700">Nama Barang</th>
                        <th class="text-center font-semibold text-gray-700">Jumlah</th>
                        <th class="text-center font-semibold text-gray-700">Satuan</th>
                        <th class="text-center font-semibold text-gray-700">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="text-center font-medium">1</td>
                        <td class="text-center">Besi 4x4</td>
                        <td class="text-center">30</td>
                        <td class="text-center">
                            <span class="badge badge-outline">Pcs</span>
                        </td>
                        <td class="text-center">Untuk Rangka</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="text-center font-medium">2</td>
                        <td class="text-center">Cat XYZ</td>
                        <td class="text-center">5</td>
                        <td class="text-center">
                            <span class="badge badge-outline">Pcs</span>
                        </td>
                        <td class="text-center">Finishing</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="text-center font-medium">3</td>
                        <td class="text-center">Lorem Ipsum</td>
                        <td class="text-center">6</td>
                        <td class="text-center">
                            <span class="badge badge-outline">Pcs</span>
                        </td>
                        <td class="text-center">Lorem Ipsum</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="text-center font-medium">4</td>
                        <td class="text-center">Lorem Ipsum</td>
                        <td class="text-center">7</td>
                        <td class="text-center">
                            <span class="badge badge-outline">Pcs</span>
                        </td>
                        <td class="text-center">Lorem Ipsum</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end gap-4 mt-8">
        <button class="btn btn-outline btn-error">
            <i class="ph ph-x mr-2"></i>
            Tolak
        </button>
        <button class="btn btn-success">
            <i class="ph ph-check mr-2"></i>
            Setujui
        </button>
    </div>
</div>
@endsection

{{-- Script for JS --}}
@section('scripts')
<script>
    // Add any JavaScript functionality here
    document.addEventListener('DOMContentLoaded', function() {
        // Handle form interactions
        console.log('Lihat Pengajuan page loaded');
    });
</script>
@endsection