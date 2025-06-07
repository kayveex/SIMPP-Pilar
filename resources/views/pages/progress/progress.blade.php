{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
Progress Proyek - SIMPP Pillar Presisi
@endsection

{{-- Head - Styles --}}
@section('styles-head')
<script src="https://unpkg.com/@phosphor-icons/web"></script>
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
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Progress Proyek</h1>
    </div>

    {{-- Search and Filter Section --}}
    <div class="mb-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
        {{-- Search Bar --}}
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ph ph-magnifying-glass text-gray-400 text-lg"></i>
            </div>
            <input type="text" 
                   class="input input-bordered w-full pl-10 pr-4 py-2 bg-white border-gray-200 focus:border-blue-500 focus:ring-blue-500" 
                   placeholder="Search">
        </div>

        {{-- Filter Section --}}
        <div class="flex gap-3 items-center">
            {{-- Filter Button --}}
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-outline gap-2">
                    <i class="ph ph-funnel text-lg"></i>
                    Filter
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>All Projects</a></li>
                    <li><a>On-site</a></li>
                    <li><a>Bengkel</a></li>
                    <li><a>In Progress</a></li>
                    <li><a>Completed</a></li>
                </ul>
            </div>

            {{-- Priority Dropdown --}}
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-outline gap-2">
                    Prioritas
                    <i class="ph ph-caret-down text-lg"></i>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>High Priority</a></li>
                    <li><a>Medium Priority</a></li>
                    <li><a>Low Priority</a></li>
                </ul>
            </div>

            {{-- Jenis Dropdown --}}
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-outline gap-2">
                    Jenis
                    <i class="ph ph-caret-down text-lg"></i>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Rekondisi</a></li>
                    <li><a>Servis</a></li>
                    <li><a>Survey</a></li>
                </ul>
            </div>

            {{-- Reset Filter --}}
            <button class="btn btn-ghost text-red-500 gap-2">
                <i class="ph ph-arrow-clockwise text-lg"></i>
                Reset Filter
            </button>
        </div>
    </div>

    {{-- Project Cards Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Project Card 1 --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            {{-- Card Header --}}
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Rekondisi Pipa Laut X</h3>
                    <p class="text-gray-600 text-sm">PT Gelombang Barat</p>
                </div>
                <div class="badge badge-outline badge-sm px-3 py-2">On-site</div>
            </div>

            {{-- Date Range --}}
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700">05/05/2025 - 02/06/2025</p>
            </div>

            {{-- Progress Section --}}
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progress</span>
                    <span class="text-sm font-bold text-blue-600">50%</span>
                </div>
                <div class="progress progress-primary w-full h-2">
                    <div class="progress-primary" style="width: 50%"></div>
                </div>
            </div>
        </div>

        {{-- Project Card 2 --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            {{-- Card Header --}}
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Servis Mesin Bubut</h3>
                    <p class="text-gray-600 text-sm">PT Sinar Mas</p>
                </div>
                <div class="badge badge-secondary badge-outline badge-sm px-3 py-2">Bengkel</div>
            </div>

            {{-- Date Range --}}
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700">Tanggal Awal - Tanggal Akhir</p>
            </div>

            {{-- Progress Section --}}
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progress</span>
                    <span class="text-sm font-bold text-blue-600">70%</span>
                </div>
                <div class="progress progress-primary w-full h-2">
                    <div class="progress-primary" style="width: 70%"></div>
                </div>
            </div>
        </div>

        {{-- Project Card 3 --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            {{-- Card Header --}}
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Servis Mesin Y</h3>
                    <p class="text-gray-600 text-sm">PT Fortress A</p>
                </div>
                <div class="badge badge-secondary badge-outline badge-sm px-3 py-2">Bengkel</div>
            </div>

            {{-- Date Range --}}
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700">Tanggal Awal - Tanggal Akhir</p>
            </div>

            {{-- Progress Section --}}
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progress</span>
                    <span class="text-sm font-bold text-blue-600">10%</span>
                </div>
                <div class="progress progress-primary w-full h-2">
                    <div class="progress-primary" style="width: 10%"></div>
                </div>
            </div>
        </div>

        {{-- Project Card 4 --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            {{-- Card Header --}}
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Survey Geometrik Z</h3>
                    <p class="text-gray-600 text-sm">PT Tenggara Perunggu</p>
                </div>
                <div class="badge badge-outline badge-sm px-3 py-2">On-site</div>
            </div>

            {{-- Date Range --}}
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700">Tanggal Awal - Tanggal Akhir</p>
            </div>

            {{-- Progress Section --}}
            <div class="mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Progress</span>
                    <span class="text-sm font-bold text-gray-400">0%</span>
                </div>
                <div class="progress w-full h-2 bg-gray-200">
                    <div class="bg-gray-300" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center items-center gap-2">
        <button class="btn btn-circle btn-sm btn-outline">
            <i class="ph ph-caret-left text-lg"></i>
        </button>
        
        <div class="flex gap-1">
            <button class="btn btn-circle btn-sm btn-primary">1</button>
            <button class="btn btn-circle btn-sm btn-outline">2</button>
            <button class="btn btn-circle btn-sm btn-outline">3</button>
        </div>
        
        <button class="btn btn-circle btn-sm btn-outline">
            <i class="ph ph-caret-right text-lg"></i>
        </button>
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
                // Add search logic here
                console.log('Searching for:', e.target.value);
            });
        }

        // Progress bar animations
        const progressBars = document.querySelectorAll('.progress');
        progressBars.forEach(bar => {
            // Add progress animation on load
            const progressDiv = bar.querySelector('div');
            if (progressDiv) {
                progressDiv.style.transition = 'width 1s ease-in-out';
            }
        });
    });
</script>
@endsection