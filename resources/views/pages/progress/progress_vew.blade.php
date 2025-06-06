{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
Lihat Catatan Proyek - SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
<style>
    .info-card {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 16px;
    }
    
    .documentation-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }
    
    .doc-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e9ecef;
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
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Lihat Catatan Proyek</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mb-6">
            <button class="btn btn-outline btn-primary">
                <i class="ph ph-pencil-simple mr-2"></i>
                Edit
            </button>
            <button class="btn btn-primary">
                <i class="ph ph-arrow-counter-clockwise mr-2"></i>
                Kembali
            </button>
        </div>

        <!-- Progress Bar Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Progress - 27 Mei 2025</h2>
                <span class="text-2xl font-bold text-blue-600">50%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: 50%"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Activities Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas</h3>
                    <div class="info-card">
                        <p class="text-gray-700 leading-relaxed">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Nulla sed orci gravida, congue felis eu, faucibus est. 
                            Curabitur auctor sed tellus ac pretium. Nam nisl neque, 
                            lobortis posuere metus nec, ultrices suscipit libero.
                        </p>
                    </div>
                </div>

                <!-- Responsible Person Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Penanggung Jawab</h3>
                    <div class="info-card">
                        <p class="text-gray-700 font-medium">Robert Pattinson</p>
                    </div>
                </div>

                <!-- Record Type Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Catatan</h3>
                    <div class="info-card">
                        <p class="text-gray-700 font-medium">Laporan Harian</p>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Issues Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Kendala</h3>
                    <div class="info-card">
                        <p class="text-gray-700 leading-relaxed">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Nulla sed orci gravida, congue felis eu, faucibus est. 
                            Curabitur auctor sed tellus ac pretium. Nam nisl neque, 
                            lobortis posuere metus nec, ultrices suscipit libero.
                        </p>
                    </div>
                </div>

                <!-- Other Notes Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Catatan Lainnya</h3>
                    <div class="info-card">
                        <p class="text-gray-700 leading-relaxed">
                            Tidak ada.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documentation Section -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Dokumentasi</h3>
            <div class="documentation-grid">
                <!-- Sample Documentation Images -->
                <div class="text-center">
                    <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=300&fit=crop" 
                         alt="Project Documentation 1" 
                         class="doc-image cursor-pointer hover:opacity-80 transition-opacity"
                         onclick="openImageModal(this.src, 'Project Documentation 1')">
                    <p class="text-sm text-gray-600 mt-2">Dokumentasi Konstruksi 1</p>
                </div>
                
                <div class="text-center">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop" 
                         alt="Project Documentation 2" 
                         class="doc-image cursor-pointer hover:opacity-80 transition-opacity"
                         onclick="openImageModal(this.src, 'Project Documentation 2')">
                    <p class="text-sm text-gray-600 mt-2">Dokumentasi Konstruksi 2</p>
                </div>
                
                <div class="text-center">
                    <img src="https://images.unsplash.com/photo-1590736969955-71cc94901144?w=400&h=300&fit=crop" 
                         alt="Project Documentation 3" 
                         class="doc-image cursor-pointer hover:opacity-80 transition-opacity"
                         onclick="openImageModal(this.src, 'Project Documentation 3')">
                    <p class="text-sm text-gray-600 mt-2">Dokumentasi Konstruksi 3</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<dialog id="image_modal" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="font-bold text-lg mb-4" id="modal_title">Dokumentasi</h3>
        
        <div class="text-center">
            <img id="modal_image" src="" alt="" class="max-w-full max-h-96 mx-auto rounded-lg">
        </div>

        <div class="modal-action">
            <button class="btn btn-outline" onclick="document.getElementById('image_modal').close()">
                <i class="ph ph-x mr-2"></i>
                Tutup
            </button>
            <button class="btn btn-primary" onclick="downloadImage()">
                <i class="ph ph-download mr-2"></i>
                Download
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
    // Image modal functions
    function openImageModal(imageSrc, imageTitle) {
        const modal = document.getElementById('image_modal');
        const modalImage = document.getElementById('modal_image');
        const modalTitle = document.getElementById('modal_title');
        
        modalImage.src = imageSrc;
        modalImage.alt = imageTitle;
        modalTitle.textContent = imageTitle;
        
        modal.showModal();
    }

    // Download image function
    function downloadImage() {
        const modalImage = document.getElementById('modal_image');
        const modalTitle = document.getElementById('modal_title');
        
        if (modalImage.src) {
            const link = document.createElement('a');
            link.href = modalImage.src;
            link.download = modalTitle.textContent + '.jpg';
            link.click();
        }
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Project Record View Page loaded');
        
        // Add smooth scroll behavior for better UX
        document.documentElement.style.scrollBehavior = 'smooth';
    });

    // Add keyboard navigation for modal
    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('image_modal');
        
        if (modal.open) {
            if (event.key === 'Escape') {
                modal.close();
            }
        }
    });
</script>
@endsection