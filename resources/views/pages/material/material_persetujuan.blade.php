{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
Lihat Status Material - SIMPP Pillar Presisi
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
    <div class="mb-6">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="#" class="text-blue-500 hover:text-blue-600">Status Material</a></li>
                <li class="text-gray-600">Lihat Status Material</li>
            </ul>
        </div>
    </div>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Lihat Status Material</h1>
        <div class="flex gap-3">
            <button class="btn btn-ghost gap-2">
                <i class="ph ph-download text-lg"></i>
                Unduh
            </button>
            <button class="btn btn-primary gap-2">
                <i class="ph ph-arrow-left text-lg"></i>
                Kembali
            </button>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card bg-white shadow-lg">
        <div class="card-body p-8">
            <!-- Project and Client Info -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Project Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Proyek</label>
                    <input 
                        type="text" 
                        value="Proyek A" 
                        class="input input-bordered w-full bg-gray-100" 
                        readonly
                    />
                </div>

                <!-- Client -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Klien</label>
                    <input 
                        type="text" 
                        value="Klien A" 
                        class="input input-bordered w-full bg-gray-100" 
                        readonly
                    />
                </div>
            </div>

            <!-- Status, Date, and Notes -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Status Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="select select-bordered w-full" id="statusSelect">
                        <option value="ditolak">Ditolak</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="pending">Pending</option>
                        <option value="dalam_review">Dalam Review</option>
                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input 
                        type="text" 
                        value="00/00/0000" 
                        class="input input-bordered w-full"
                        placeholder="DD/MM/YYYY"
                    />
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                    <input 
                        type="text" 
                        id="catatanInput"
                        class="input input-bordered w-full"
                        placeholder="Masukkan catatan..."
                    />
                </div>
            </div>

            <!-- Materials Table -->
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-center font-semibold">No</th>
                            <th class="font-semibold">Nama Barang</th>
                            <th class="text-center font-semibold">Jumlah</th>
                            <th class="text-center font-semibold">Satuan</th>
                            <th class="text-center font-semibold">Harga</th>
                            <th class="text-center font-semibold">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center font-medium">1</td>
                            <td>
                                <input 
                                    type="text" 
                                    value="Besi 4x4" 
                                    class="input input-sm input-bordered w-full"
                                />
                            </td>
                            <td class="text-center">
                                <input 
                                    type="number" 
                                    value="30" 
                                    class="input input-sm input-bordered w-20 text-center"
                                />
                            </td>
                            <td class="text-center">
                                <select class="select select-sm select-bordered">
                                    <option selected>Pcs</option>
                                    <option>Kg</option>
                                    <option>Meter</option>
                                    <option>Liter</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <input 
                                    type="text" 
                                    placeholder="Rp 0" 
                                    class="input input-sm input-bordered w-24 text-center"
                                />
                            </td>
                            <td class="text-center">
                                <input 
                                    type="text" 
                                    placeholder="Rp 0" 
                                    class="input input-sm input-bordered w-24 text-center"
                                />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center font-medium">2</td>
                            <td>
                                <input 
                                    type="text" 
                                    value="Cat XYZ" 
                                    class="input input-sm input-bordered w-full"
                                />
                            </td>
                            <td class="text-center">
                                <input 
                                    type="number" 
                                    value="5" 
                                    class="input input-sm input-bordered w-20 text-center"
                                />
                            </td>
                            <td class="text-center">
                                <select class="select select-sm select-bordered">
                                    <option selected>Pcs</option>
                                    <option>Kg</option>
                                    <option>Meter</option>
                                    <option>Liter</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <input 
                                    type="text" 
                                    placeholder="Rp 0" 
                                    class="input input-sm input-bordered w-24 text-center"
                                />
                            </td>
                            <td class="text-center">
                                <input 
                                    type="text" 
                                    placeholder="Rp 0" 
                                    class="input input-sm input-bordered w-24 text-center"
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add Material Button -->
            <div class="mt-4">
                <button class="btn btn-outline btn-sm gap-2" onclick="addMaterialRow()">
                    <i class="ph ph-plus text-lg"></i>
                    Tambah Material
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
                <button class="btn btn-ghost">
                    <i class="ph ph-x text-lg mr-1"></i>
                    Batal
                </button>
                <button class="btn btn-primary">
                    <i class="ph ph-check text-lg mr-1"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Script for JS --}}
@section('scripts')
<script>
// Update notes based on status selection
document.getElementById('statusSelect').addEventListener('change', function() {
    const status = this.value;
    const catatanInput = document.getElementById('catatanInput');
    
    switch(status) {
        case 'ditolak':
            catatanInput.value = 'Permintaan ajukan ulang revisi';
            break;
        case 'disetujui':
            catatanInput.value = 'Akan segera dipesan';
            break;
        case 'pending':
            catatanInput.value = 'Menunggu persetujuan';
            break;
        case 'dalam_review':
            catatanInput.value = 'Sedang dalam tahap review';
            break;
        default:
            catatanInput.value = '';
    }
});

// Add new material row
function addMaterialRow() {
    const tbody = document.querySelector('tbody');
    const rowCount = tbody.children.length + 1;
    
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td class="text-center font-medium">${rowCount}</td>
        <td>
            <input 
                type="text" 
                placeholder="Nama barang" 
                class="input input-sm input-bordered w-full"
            />
        </td>
        <td class="text-center">
            <input 
                type="number" 
                placeholder="0" 
                class="input input-sm input-bordered w-20 text-center"
            />
        </td>
        <td class="text-center">
            <select class="select select-sm select-bordered">
                <option>Pcs</option>
                <option>Kg</option>
                <option>Meter</option>
                <option>Liter</option>
            </select>
        </td>
        <td class="text-center">
            <input 
                type="text" 
                placeholder="Rp 0" 
                class="input input-sm input-bordered w-24 text-center"
            />
        </td>
        <td class="text-center">
            <input 
                type="text" 
                placeholder="Rp 0" 
                class="input input-sm input-bordered w-24 text-center"
            />
        </td>
    `;
    
    tbody.appendChild(newRow);
}

// Initialize with default status
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('statusSelect');
    statusSelect.value = 'disetujui';
    statusSelect.dispatchEvent(new Event('change'));
});

// Format currency inputs
document.addEventListener('input', function(e) {
    if (e.target.placeholder === 'Rp 0') {
        let value = e.target.value.replace(/[^\d]/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
            e.target.value = 'Rp ' + value;
        }
    }
});
</script>
@endsection