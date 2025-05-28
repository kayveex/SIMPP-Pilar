{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
Tambah Pengajuan - SIMPP Pillar Presisi
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
<div class="min-h-screen bg-gray-50">
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Tambah Pengajuan</h1>
            <div class="breadcrumbs text-sm text-blue-600">
                <ul>
                    <li><a href="#" class="hover:underline">Pengajuan Material</a></li>
                    <li class="text-gray-500">Tambah Pengajuan</li>
                </ul>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 mb-6">
            <button class="btn btn-outline btn-primary">
                <i class="ph ph-arrow-left mr-2"></i>
                Kembali
            </button>
            <button class="btn btn-primary">
                <i class="ph ph-check mr-2"></i>
                Simpan
            </button>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Project Name Section -->
            <div class="card bg-white shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg font-semibold text-gray-800 mb-4">Nama Proyek</h3>
                    <div class="form-control">
                        <div class="input-group">
                            <span class="input-group-text bg-gray-50">
                                <i class="ph ph-magnifying-glass text-gray-400"></i>
                            </span>
                            <input type="text" placeholder="Cari nama proyek..." class="input input-bordered w-full bg-gray-50 focus:bg-white">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Section -->
            <div class="card bg-white shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg font-semibold text-gray-800 mb-4">Klien</h3>
                    <div class="form-control">
                        <div class="input-group">
                            <span class="input-group-text bg-gray-50">
                                <i class="ph ph-magnifying-glass text-gray-400"></i>
                            </span>
                            <input type="text" placeholder="Cari klien..." class="input input-bordered w-full bg-gray-50 focus:bg-white">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Materials Table -->
        <div class="card bg-white shadow-sm">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="card-title text-lg font-semibold text-gray-800">Daftar Material</h3>
                    <button class="btn btn-outline btn-sm">
                        <i class="ph ph-plus mr-2"></i>
                        Tambah Tabel
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="text-center font-semibold text-gray-700">No</th>
                                <th class="font-semibold text-gray-700">Nama Barang</th>
                                <th class="text-center font-semibold text-gray-700">Jumlah</th>
                                <th class="text-center font-semibold text-gray-700">Satuan</th>
                                <th class="text-center font-semibold text-gray-700">Keterangan</th>
                                <th class="text-center font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="text-center font-medium">1</td>
                                <td class="font-medium">Besi 4x4</td>
                                <td class="text-center">30</td>
                                <td class="text-center">Pcs</td>
                                <td class="text-center">Untuk Rangka</td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="btn btn-sm btn-outline btn-warning">
                                            <i class="ph ph-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline btn-error">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="text-center font-medium">2</td>
                                <td class="font-medium">Cat XYZ</td>
                                <td class="text-center">5</td>
                                <td class="text-center">Pcs</td>
                                <td class="text-center">Finishing</td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="btn btn-sm btn-outline btn-warning">
                                            <i class="ph ph-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline btn-error">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Add New Row Button -->
                <div class="mt-4">
                    <button class="btn btn-outline btn-primary btn-sm">
                        <i class="ph ph-plus mr-2"></i>
                        Tambah Baris Baru
                    </button>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-3 mt-6">
            <button class="btn btn-outline">
                <i class="ph ph-x mr-2"></i>
                Batal
            </button>
            <button class="btn btn-success">
                <i class="ph ph-check mr-2"></i>
                Simpan Pengajuan
            </button>
        </div>
    </div>
</div>

<!-- Add Material Modal -->
<div class="modal" id="add-material-modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Tambah Material Baru</h3>
        
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text font-medium">Nama Barang</span>
            </label>
            <input type="text" placeholder="Masukkan nama barang" class="input input-bordered w-full">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Jumlah</span>
                </label>
                <input type="number" placeholder="0" class="input input-bordered w-full">
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Satuan</span>
                </label>
                <select class="select select-bordered w-full">
                    <option disabled selected>Pilih satuan</option>
                    <option>Pcs</option>
                    <option>Kg</option>
                    <option>Meter</option>
                    <option>Liter</option>
                </select>
            </div>
        </div>

        <div class="form-control mb-6">
            <label class="label">
                <span class="label-text font-medium">Keterangan</span>
            </label>
            <textarea class="textarea textarea-bordered" placeholder="Masukkan keterangan..."></textarea>
        </div>

        <div class="modal-action">
            <button class="btn btn-outline" onclick="document.getElementById('add-material-modal').close()">Batal</button>
            <button class="btn btn-primary">
                <i class="ph ph-plus mr-2"></i>
                Tambah
            </button>
        </div>
    </div>
</div>
@endsection

{{-- Script for JS --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add material button functionality
    document.querySelector('.btn-outline.btn-sm').addEventListener('click', function() {
        document.getElementById('add-material-modal').showModal();
    });

    // Add new row functionality
    document.querySelector('.btn-outline.btn-primary.btn-sm').addEventListener('click', function() {
        // Add logic to dynamically add new table row
        console.log('Add new row clicked');
    });

    // Edit and delete button functionality
    document.querySelectorAll('.btn-outline.btn-warning').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Edit functionality
            console.log('Edit clicked');
        });
    });

    document.querySelectorAll('.btn-outline.btn-error').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Delete functionality
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                // Delete logic here
                console.log('Delete confirmed');
            }
        });
    });

    // Form validation
    document.querySelector('.btn-success').addEventListener('click', function() {
        // Add form validation logic
        alert('Pengajuan berhasil disimpan!');
    });
});
</script>
@endsection