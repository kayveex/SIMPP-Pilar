{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Arsip Proyek - SIMPP Pillar Presisi
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
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">
            {{-- Header Section --}}
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Arsip Proyek</h1>
                    <div class="breadcrumbs text-sm text-gray-500">
                        <ul>
                            <li><a href="#" class="text-blue-500 hover:text-blue-700">Anggaran Proyek</a></li>
                            <li class="text-gray-400">Anggaran Rencana</li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-primary bg-blue-500 hover:bg-blue-600 border-blue-500 text-white px-6">
                    Kembali
                </button>
            </div>

            {{-- Project Info Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                    <p class="text-gray-600 text-sm font-medium">Rekondisi Pipa Laut X</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                    <p class="text-gray-600 text-sm font-medium">05/05/2025 - 01/06/2025</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                    <p class="text-gray-600 text-sm font-medium">PT Gelombang Barat</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                    <p class="text-gray-600 text-sm font-medium">On-Site</p>
                </div>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
                {{-- Detail Proyek Card --}}
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
                    <div class="card-body items-center text-center p-8">
                        <div class="mb-4">
                            <i class="ph ph-file-text text-gray-700" style="font-size: 32px;"></i>
                        </div>
                        <h3 class="card-title text-xl font-semibold text-gray-800 mb-0">Detail Proyek</h3>
                    </div>
                </div>

                {{-- Jadwal Proyek Card --}}
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
                    <div class="card-body items-center text-center p-8">
                        <div class="mb-4">
                            <i class="ph ph-calendar text-gray-700" style="font-size: 32px;"></i>
                        </div>
                        <h3 class="card-title text-xl font-semibold text-gray-800 mb-0">Jadwal Proyek</h3>
                    </div>
                </div>

                {{-- Catatan Proyek Card --}}
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
                    <div class="card-body items-center text-center p-8">
                        <div class="mb-4">
                            <i class="ph ph-note text-gray-700" style="font-size: 32px;"></i>
                        </div>
                        <h3 class="card-title text-xl font-semibold text-gray-800 mb-0">Catatan Proyek</h3>
                    </div>
                </div>

                {{-- Anggaran Proyek Card --}}
                <div class="card bg-white shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
                    <div class="card-body items-center text-center p-8">
                        <div class="mb-4">
                            <i class="ph ph-money text-gray-700" style="font-size: 32px;"></i>
                        </div>
                        <h3 class="card-title text-xl font-semibold text-gray-800 mb-0">Anggaran Proyek</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Script for JS --}}
@section('scripts')
    <script>
        // Add click handlers for cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    const title = this.querySelector('.card-title').textContent.trim();
                    const projectId = {{ $project->project_id ?? 'null' }};

                    // Add your navigation logic here
                    switch (title) {
                        case 'Detail Proyek':
                            // Modified navigation logic
                            console.log('Navigate to Detail Proyek');
                            window.location.href = `/projects/${projectId}`;
                            break;
                        case 'Jadwal Proyek':
                            // Modified navigation logic
                            console.log('Navigate to Jadwal Proyek');
                            window.location.href = `/schedule`;
                            break;
                        case 'Catatan Proyek':
                            // Modified navigation logic
                            console.log('Navigate to Catatan Proyek');
                            window.location.href = `/projects/${projectId}/notes`;
                            break;
                        case 'Anggaran Proyek':
                            // Modified navigation logic
                            console.log('Navigate to Anggaran Proyek');
                            window.location.href = `/anggaran/realisasi/${projectId}`;
                            break;
                    }
                });
            });
        });
    </script>
@endsection
