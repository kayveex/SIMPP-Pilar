{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Anggaran Proyek - SIMPP Pillar Presisi
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
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Anggaran Proyek</h1>

            <!-- Tab Navigation -->
            <div class="tabs tabs-boxed bg-white p-1 mb-6 w-fit">
                <a class="tab tab-active">Rencana</a>
                <a class="tab">Realisasi</a>
            </div>
        </div>

        <!-- Anggaran Rencana Section -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Anggaran Rencana</h2>
                        <div class="breadcrumbs text-sm text-blue-600">
                            <ul>
                                <li><a href="#" class="link link-hover">Anggaran Proyek</a></li>
                                <li>Anggaran Rencana</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button class="btn btn-outline btn-sm">
                            <i class="ph ph-download mr-2"></i>
                            Unduh
                        </button>
                        <button class="btn btn-primary btn-sm">Kembali</button>
                    </div>
                </div>

                <!-- Project Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Rekondisi Pipa Laut X</p>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">05/05/2025 - 01/06/2025</p>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">PT Gelombang Barat</p>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">On-Site</p>
                    </div>
                </div>
            </div>

            <!-- Budget Table -->
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left font-semibold text-gray-700">No</th>
                            <th class="text-left font-semibold text-gray-700">Uraian Pekerjaan</th>
                            <th class="text-center font-semibold text-gray-700">Jumlah</th>
                            <th class="text-center font-semibold text-gray-700">Satuan</th>
                            <th class="text-right font-semibold text-gray-700">Harga Satuan</th>
                            <th class="text-right font-semibold text-gray-700">Jumlah Harga</th>
                            <th class="text-right font-semibold text-gray-700">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Section A: Bahan Material -->
                        <tr class="bg-blue-50">
                            <td class="font-semibold">A</td>
                            <td class="font-semibold">Bahan Material</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Baut A</td>
                            <td class="text-center">20</td>
                            <td class="text-center">Pcs</td>
                            <td class="text-right">3.000</td>
                            <td class="text-right">60.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Baut B</td>
                            <td class="text-center">20</td>
                            <td class="text-center">Pcs</td>
                            <td class="text-right">3.000</td>
                            <td class="text-right">60.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Baut C</td>
                            <td class="text-center">20</td>
                            <td class="text-center">Pcs</td>
                            <td class="text-right">3.000</td>
                            <td class="text-right">60.000</td>
                            <td></td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-semibold">Jumlah</td>
                            <td class="text-right font-semibold">180.000</td>
                        </tr>

                        <!-- Section B: Pekerjaan Persiapan -->
                        <tr class="bg-blue-50">
                            <td class="font-semibold">B</td>
                            <td class="font-semibold">Pekerjaan Persiapan</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Pembersihan Lokasi</td>
                            <td class="text-center">1</td>
                            <td class="text-center">Lot</td>
                            <td class="text-right">100.000</td>
                            <td class="text-right">100.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Memasang XYZ</td>
                            <td class="text-center">1</td>
                            <td class="text-center">Lot</td>
                            <td class="text-right">100.000</td>
                            <td class="text-right">100.000</td>
                            <td></td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-semibold">Jumlah</td>
                            <td class="text-right font-semibold">200.000</td>
                        </tr>

                        <!-- Total -->
                        <tr class="bg-blue-100 border-t-2 border-blue-200">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-bold text-lg">Jumlah Keseluruhan</td>
                            <td class="text-right font-bold text-lg">218.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- Script for JS --}}
@section('scripts')
    <script>
        // Add any JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('tab-active'));
                    // Add active class to clicked tab
                    this.classList.add('tab-active');
                });
            });

            // Download button functionality
            const downloadBtn = document.querySelector('.btn-outline');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function() {
                    // Add download functionality here
                    console.log('Download initiated');
                });
            }

            // Back button functionality
            const backBtn = document.querySelector('.btn-primary');
            if (backBtn) {
                backBtn.addEventListener('click', function() {
                    // Add navigation back functionality
                    window.history.back();
                });
            }
        });
    </script>
@endsection
