{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Dashboard SIMPP Pillar Presisi
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
    <div class="p-6">
        
        <!-- Active Projects Table -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Proyek Aktif</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenggat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sisa Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Honing Line & Hardchrome Piston</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">24 Mei 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">9</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    Berlangsung
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Fabrikasi Sterntube Stuffing Box</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1 Juni 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">17</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    Perencanaan
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Line Boring & Undercoat Polishing</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12 Juni 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">28</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                    Belum Dimulai
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">4</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Repair Bearing Housing</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5 Mei 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Machining Compressor Parts</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">10 Juli 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">49</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                    Ditunda
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Table Footer -->
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <span class="text-sm text-gray-700">Show</span>
                    <select class="border border-gray-300 rounded-md text-sm px-2 py-1 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Statistics Cards Layout -->
        <div class="flex flex-row w-full h-fit gap-6 my-10">
            <!-- Left Section -->
            <div class="flex flex-col w-1/2 gap-6">
                
                <!-- Top Row - Statistics Cards -->
                <div class="flex flex-row gap-6">
                    <!-- Proyek Masuk Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 flex-1">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Proyek Masuk</h3>
                        <div class="text-3xl font-bold text-gray-900 mb-2">4</div>
                        <div class="flex items-center text-sm">
                            <i class="ph ph-trend-up w-4 h-4 text-green-500 mr-1"></i>
                            <span class="text-green-600 font-medium">+2</span>
                            <span class="text-gray-500 ml-1">dari bulan April</span>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row - Calendar Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Kalender Proyek</h3>
                    <div class="h-48 bg-gray-50 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">Calendar content placeholder</span>
                    </div>
                </div>

            </div>

            <!-- Right Section -->
            <div class="flex flex-col w-1/2 gap-6">
                
                <!-- Top Row - Statistics Cards -->
                <div class="flex flex-row gap-6">
                    <!-- Proyek Selesai Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 flex-1">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Proyek Selesai</h3>
                        <div class="text-3xl font-bold text-gray-900 mb-2">10</div>
                        <div class="flex items-center text-sm">
                            <i class="ph ph-trend-up w-4 h-4 text-green-500 mr-1"></i>
                            <span class="text-green-600 font-medium">+16</span>
                            <span class="text-gray-500 ml-1">dari bulan April</span>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row - User Activity Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Pengguna</h3>
                    <div class="h-48 bg-gray-50 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">User activity placeholder</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- Script for JS --}}
@section('scripts')
    
@endsection