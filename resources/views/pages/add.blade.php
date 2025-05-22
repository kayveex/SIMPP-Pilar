{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    PROYEK - Tambah Proyek
@endsection

{{-- Head - Styles --}}
@section('styles-head')
    <style>
        .modal-backdrop {
            backdrop-filter: blur(4px);
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
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-red-600 p-2 rounded">
                <span class="text-white font-bold text-sm">PPI</span>
            </div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Proyek</h1>
        </div>
        <div class="flex items-center space-x-2">
            <button class="p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                </svg>
            </button>
            <button class="p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm border">
        <!-- Navigation Tabs -->
        <div class="border-b">
            <nav class="flex space-x-8 px-6 pt-4">
                <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-2 font-medium">Tambah Proyek</a>
                <a href="#" class="text-gray-500 hover:text-gray-700 pb-2">Project List</a>
                <a href="#" class="text-gray-500 hover:text-gray-700 pb-2">Dashboard</a>
            </nav>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <form class="space-y-6">
                <!-- PROYEK Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">PROYEK</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Proyek</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Proyek</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Program Budget</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Aksi</label>
                            <div class="flex space-x-2">
                                <button type="button" onclick="openCreateModal()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Buat
                                </button>
                                <button type="button" onclick="openDropdownModal()" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Pilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SETTINGS Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">SETTINGS</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Proyek</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Pilih Jenis Proyek</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Pilih Status</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Work Baseline</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- AKTIVITAS Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">AKTIVITAS</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dana Proyek</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- FILES Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">FILES</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Terkait</label>
                            <div class="flex">
                                <input type="text" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" onclick="openUploadModal()" class="px-4 py-2 bg-gray-500 text-white rounded-r-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Upload
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CREATE Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="bg-red-600 p-2 rounded">
                        <span class="text-white font-bold text-xs">PPI</span>
                    </div>
                    <h3 class="text-lg font-semibold">Tambah Proyek</h3>
                </div>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Proyek</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Aksi</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3 p-6 border-t">
                <button onclick="closeCreateModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- DROPDOWN Modal -->
<div id="dropdownModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="bg-red-600 p-2 rounded">
                        <span class="text-white font-bold text-xs">PPI</span>
                    </div>
                    <h3 class="text-lg font-semibold">Tambah Proyek</h3>
                </div>
                <button onclick="closeDropdownModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Proyek</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Pilih Proyek</option>
                                <option>Proyek A</option>
                                <option>Proyek B</option>
                                <option>Proyek C</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                                <option>Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3 p-6 border-t">
                <button onclick="closeDropdownModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Pilih
                </button>
            </div>
        </div>
    </div>
</div>

<!-- UPLOAD Modal -->
<div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="bg-red-600 p-2 rounded">
                        <span class="text-white font-bold text-xs">PPI</span>
                    </div>
                    <h3 class="text-lg font-semibold">Tambah Proyek</h3>
                </div>
                <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="text-center">
                    <div class="mb-4">
                        <svg class="mx-auto w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Upload</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-gray-400 transition-colors">
                                <input type="file" id="fileInput" class="hidden" multiple>
                                <button type="button" onclick="document.getElementById('fileInput').click()" class="w-full">
                                    <svg class="mx-auto w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="text-sm text-gray-600">Klik untuk memilih file atau drag & drop</p>
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama File</label>
                            <input type="text" placeholder="Masukkan nama file" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea rows="3" placeholder="Masukkan keterangan file" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Tipe</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>PDF</option>
                                <option>DOC</option>
                                <option>XLS</option>
                                <option>PNG</option>
                                <option>JPG</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3 p-6 border-t">
                <button onclick="closeUploadModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Script for JS --}}
@section('scripts')
<script>
    // Modal Functions
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openDropdownModal() {
        document.getElementById('dropdownModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDropdownModal() {
        document.getElementById('dropdownModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openUploadModal() {
        document.getElementById('uploadModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeUploadModal() {
        document.getElementById('uploadModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal-backdrop')) {
            closeCreateModal();
            closeDropdownModal();
            closeUploadModal();
        }
    });

    // File input handler
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const files = event.target.files;
        if (files.length > 0) {
            console.log('Selected files:', files);
            // Handle file upload logic here
        }
    });

    // ESC key to close modals
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeCreateModal();
            closeDropdownModal();
            closeUploadModal();
        }
    });
</script>
@endsection