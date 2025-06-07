{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
Tambah Catatan Proyek - SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
<style>
    .dropdown-content {
        max-height: 200px;
        overflow-y: auto;
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
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="text-sm breadcrumbs">
            <ul class="flex items-center space-x-2 text-blue-600">
                <li><a href="#" class="hover:underline">Progress Proyek</a></li>
                <li><i class="ph ph-caret-right text-gray-400"></i></li>
                <li><a href="#" class="hover:underline">Catatan Proyek</a></li>
                <li><i class="ph ph-caret-right text-gray-400"></i></li>
                <li class="text-gray-600">Lihat Catatan Proyek</li>
            </ul>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Catatan Proyek</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mb-6">
            <button class="btn btn-outline btn-primary">
                <i class="ph ph-floppy-disk mr-2"></i>
                Simpan
            </button>
            <button class="btn btn-primary">
                <i class="ph ph-arrow-counter-clockwise mr-2"></i>
                Kembali
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Progress Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Progress</h3>
                    <div class="dropdown dropdown-bottom w-full">
                        <div tabindex="0" role="button" class="btn btn-outline w-full justify-between">
                            <span id="selected-progress" class="text-gray-600">Pilih Progress</span>
                            <i class="ph ph-caret-down"></i>
                        </div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-full dropdown-content">
                            <li><a onclick="selectProgress('10%')">10%</a></li>
                            <li><a onclick="selectProgress('15%')">15%</a></li>
                            <li><a onclick="selectProgress('20%')">20%</a></li>
                            <li><a onclick="selectProgress('25%')">25%</a></li>
                            <li><a onclick="selectProgress('30%')">30%</a></li>
                            <li><a onclick="selectProgress('35%')">35%</a></li>
                            <li><a onclick="selectProgress('40%')">40%</a></li>
                        </ul>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">*Progress sebelumnya yaitu 40%</p>
                </div>

                <!-- Activities Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas</h3>
                    <textarea 
                        class="textarea textarea-bordered w-full h-32 resize-none" 
                        placeholder="Masukkan aktivitas proyek...">
                    </textarea>
                </div>

                <!-- Responsible Person Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Penanggung Jawab</h3>
                    <input 
                        type="text" 
                        class="input input-bordered w-full" 
                        placeholder="Masukkan nama penanggung jawab">
                </div>

                <!-- Record Type Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Catatan</h3>
                    <input 
                        type="text" 
                        class="input input-bordered w-full" 
                        placeholder="Masukkan jenis catatan">
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Issues Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Kendala</h3>
                    <textarea 
                        class="textarea textarea-bordered w-full h-32 resize-none" 
                        placeholder="Masukkan kendala yang dihadapi...">
                    </textarea>
                </div>

                <!-- Other Notes Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Catatan Lainnya</h3>
                    <textarea 
                        class="textarea textarea-bordered w-full h-32 resize-none" 
                        placeholder="Masukkan catatan tambahan...">
                    </textarea>
                </div>
            </div>
        </div>

        <!-- Documentation Section -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Dokumentasi</h3>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <button 
                    class="btn btn-outline" 
                    onclick="document.getElementById('file_upload_modal').showModal()">
                    <i class="ph ph-upload mr-2"></i>
                    Pilih File
                </button>
                <p class="text-sm text-gray-500 mt-2">
                    Klik untuk mengunggah file dokumentasi
                </p>
            </div>
        </div>
    </div>
</div>

<!-- File Upload Modal -->
<dialog id="file_upload_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Pilih File</h3>
        
        <div class="space-y-4">
            <!-- File Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih File
                </label>
                <input 
                    type="file" 
                    class="file-input file-input-bordered w-full" 
                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xls,.xlsx"
                    onchange="updateFileName(this)">
            </div>

            <!-- File Name Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama File
                </label>
                <input 
                    type="text" 
                    id="file_name_input"
                    class="input input-bordered w-full" 
                    placeholder="Masukkan nama file">
            </div>

            <!-- File Preview/Info -->
            <div id="file_info" class="hidden">
                <div class="alert alert-info">
                    <i class="ph ph-info"></i>
                    <div>
                        <div class="font-semibold">File dipilih:</div>
                        <div id="selected_file_name" class="text-sm"></div>
                        <div id="selected_file_size" class="text-xs text-gray-600"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-action">
            <button class="btn btn-outline" onclick="document.getElementById('file_upload_modal').close()">
                <i class="ph ph-x mr-2"></i>
                Batal
            </button>
            <button class="btn btn-primary" onclick="uploadFile()">
                <i class="ph ph-upload mr-2"></i>
                Upload
            </button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@endsection

{{-- Script for JS --}}
@section('scripts')
<script>
    // Progress selection function
    function selectProgress(value) {
        document.getElementById('selected-progress').textContent = value;
        // Close dropdown
        document.activeElement.blur();
    }

    // File name update function
    function updateFileName(input) {
        const file = input.files[0];
        const fileInfo = document.getElementById('file_info');
        const fileNameDisplay = document.getElementById('selected_file_name');
        const fileSizeDisplay = document.getElementById('selected_file_size');
        const fileNameInput = document.getElementById('file_name_input');

        if (file) {
            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = `Ukuran: ${(file.size / 1024 / 1024).toFixed(2)} MB`;
            fileNameInput.value = file.name.split('.')[0]; // Set name without extension
            fileInfo.classList.remove('hidden');
        } else {
            fileInfo.classList.add('hidden');
            fileNameInput.value = '';
        }
    }

    // File upload function
    function uploadFile() {
        const fileInput = document.querySelector('input[type="file"]');
        const fileNameInput = document.getElementById('file_name_input');
        
        if (!fileInput.files[0]) {
            alert('Silakan pilih file terlebih dahulu!');
            return;
        }

        if (!fileNameInput.value.trim()) {
            alert('Silakan masukkan nama file!');
            return;
        }

        // Here you would typically handle the file upload
        // For now, we'll just show a success message and close the modal
        
        // Simulate upload process
        const uploadBtn = event.target;
        const originalText = uploadBtn.innerHTML;
        
        uploadBtn.innerHTML = '<i class="ph ph-spinner animate-spin mr-2"></i>Uploading...';
        uploadBtn.disabled = true;

        setTimeout(() => {
            alert('File berhasil diupload!');
            document.getElementById('file_upload_modal').close();
            
            // Reset form
            fileInput.value = '';
            fileNameInput.value = '';
            document.getElementById('file_info').classList.add('hidden');
            
            // Reset button
            uploadBtn.innerHTML = originalText;
            uploadBtn.disabled = false;
        }, 2000);
    }

    // Form validation and submission
    document.addEventListener('DOMContentLoaded', function() {
        // Add any initialization code here
        console.log('Project Record Page loaded');
    });
</script>
@endsection