{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
Catatan Proyek - SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
<link href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/bold/style.css" rel="stylesheet">
<link href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css" rel="stylesheet">
<style>
.modal {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.modal[open] {
    display: flex;
}

.modal-box {
    position: relative;
    margin: auto;
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
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Catatan Proyek</h1>
        
        <!-- Breadcrumb -->
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="#" class="text-blue-600 hover:text-blue-800">Progress Proyek</a></li>
                <li class="text-gray-500">Catatan Proyek</li>
            </ul>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="flex flex-wrap gap-3 mb-6">
        <button class="btn btn-outline btn-sm">
            <i class="ph ph-wrench mr-2"></i>
            Rekondisi Pipa Laut X
        </button>
        <button class="btn btn-outline btn-sm">
            <i class="ph ph-buildings mr-2"></i>
            PT Gelombang Barat
        </button>
        <button class="btn btn-outline btn-sm">
            <i class="ph ph-clock mr-2"></i>
            Tersisa ... hari.
        </button>
        <button class="btn btn-primary btn-sm ml-auto">
            <i class="ph ph-plus mr-2"></i>
            Tambah Progress
        </button>
    </div>

    <!-- Alert Message -->
    <div class="alert alert-info mb-6">
        <i class="ph ph-info text-lg"></i>
        <span>Hari ini sampai ... seharusnya menyelesaikan Pemasangan Pipa #2</span>
    </div>

    <!-- Notes Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-gray-700 font-semibold">No</th>
                        <th class="text-gray-700 font-semibold">Penanggung Jawab</th>
                        <th class="text-gray-700 font-semibold">Tanggal Input</th>
                        <th class="text-gray-700 font-semibold">Jenis Catatan</th>
                        <th class="text-gray-700 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">1</td>
                        <td>Robert Pattinson</td>
                        <td>27/05/2025</td>
                        <td>Laporan Harian</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-ghost btn-sm text-blue-600 hover:bg-blue-50">
                                    <i class="ph ph-eye text-lg"></i>
                                </button>
                                <button class="btn btn-ghost btn-sm text-amber-600 hover:bg-amber-50">
                                    <i class="ph ph-pencil text-lg"></i>
                                </button>
                                <button class="btn btn-ghost btn-sm text-red-600 hover:bg-red-50" onclick="deleteModal.showModal()">
                                    <i class="ph ph-trash text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">2</td>
                        <td>Robert Pattinson</td>
                        <td>25 Mei 2025</td>
                        <td>Kendala (Penyelesaian)</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-ghost btn-sm text-blue-600 hover:bg-blue-50">
                                    <i class="ph ph-eye text-lg"></i>
                                </button>
                                <button class="btn btn-ghost btn-sm text-amber-600 hover:bg-amber-50">
                                    <i class="ph ph-pencil text-lg"></i>
                                </button>
                                <button class="btn btn-ghost btn-sm text-red-600 hover:bg-red-50" onclick="deleteModal.showModal()">
                                    <i class="ph ph-trash text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="font-medium">3</td>
                        <td>Robert Pattinson</td>
                        <td>20 Mei 2025</td>
                        <td>Kendala</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-ghost btn-sm text-blue-600 hover:bg-blue-50">
                                    <i class="ph ph-eye text-lg"></i>
                                </button>
                                <button class="btn btn-ghost btn-sm text-amber-600 hover:bg-amber-50">
                                    <i class="ph ph-pencil text-lg"></i>
                                </button>
                                <button class="btn btn-ghost btn-sm text-red-600 hover:bg-red-50" onclick="deleteModal.showModal()">
                                    <i class="ph ph-trash text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<dialog id="deleteModal" class="modal">
    <div class="modal-box w-96 max-w-md bg-white rounded-lg shadow-xl p-6">
        <h3 class="font-bold text-xl text-center mb-6">Hapus Catatan?</h3>
        
        <div class="text-center mb-8">
            <p class="text-gray-700 text-base">Apakah Anda yakin ingin menghapus catatan?</p>
        </div>
        
        <div class="flex justify-center gap-4">
            <button class="btn btn-outline px-8 py-2 min-w-[120px]" type="button" onclick="deleteModal.close()">Kembali</button>
            <button class="btn bg-red-500 hover:bg-red-600 text-white px-8 py-2 min-w-[120px]" type="button" onclick="handleDelete()">Hapus</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop bg-black bg-opacity-50">
        <button>close</button>
    </form>
</dialog>
@endsection

{{-- Script for JS --}}
@section('scripts')
<script>
function handleDelete() {
    // Add your delete logic here
    console.log('Deleting item...');
    
    // Close modal after delete
    document.getElementById('deleteModal').close();
    
    // You can add toast notification here
    // toast('Catatan berhasil dihapus', 'success');
}

// Optional: Add toast notification function
function toast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} fixed top-4 right-4 z-50 max-w-sm shadow-lg`;
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="ph ph-check-circle text-lg mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}
</script>
@endsection