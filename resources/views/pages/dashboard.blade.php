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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klien</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenggat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sisa Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($activeProjects as $index => $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $project->project_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $project->client_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $project->estimated_end_date ? \Carbon\Carbon::parse($project->estimated_end_date)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($project->estimated_end_date)
                                        {{ $project->days_remaining >= 0 ? $project->days_remaining : 0 }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($project->progress_percentage < 25 )
                                        <span class="text-white font-semibold bg-red-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span> 
                                    @elseif ($project->progress_percentage < 50)
                                        <span class="text-white font-semibold bg-yellow-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span>
                                    @elseif ($project->progress_percentage < 75)
                                        <span class="text-white font-semibold bg-blue-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span>
                                    @else
                                        <span class="text-white font-semibold bg-green-500 rounded-xl px-2">{{ $project->progress_percentage }}%</span>        
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada proyek aktif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
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
                
                <!-- Statistics Cards -->
                <div class="flex flex-row gap-6">
                    <!-- Proyek Masuk Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 flex-1">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Proyek Masuk</h3>
                        <div class="text-3xl font-bold text-gray-900 mb-2">{{ $activeProjectsCount }}</div>
                        <div class="flex items-center text-sm">
                            @if ($differenceIn > 0)
                                <i class="ph ph-trend-up w-4 h-4 text-green-500 mr-1"></i>
                                <span class="text-green-600 font-medium">+{{ $differenceIn }}</span>
                                <span class="text-gray-500 ml-1">dari bulan {{ $prevMonthName }}</span>                     
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Section -->
            <div class="flex flex-col w-1/2 gap-6">
                
                <!-- Statistics Cards -->
                <div class="flex flex-row gap-6">
                    <!-- Proyek Selesai Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 flex-1">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Proyek Selesai</h3>
                        <div class="text-3xl font-bold text-gray-900 mb-2">{{ $completedProjectsCount }}</div>
                        <div class="flex items-center text-sm">
                            @if ($differenceOut > 0)
                                <i class="ph ph-trend-up w-4 h-4 text-green-500 mr-1"></i>
                                <span class="text-green-600 font-medium">+{{ $differenceOut }}</span>
                                <span class="text-gray-500 ml-1">dari bulan {{ $prevMonthName }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- Script for JS --}}
@section('scripts')
    
@endsection