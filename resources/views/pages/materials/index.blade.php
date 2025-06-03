{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Pengajuan Material Proyek Baru - SIMPP Pillar Presisi
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

{{-- Content --}}
@section('page-content')
    <section class="flex flex-col px-6 pt-6">
        {{-- Title --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800"> Pengajuan Material</h1>
        </div>

        {{-- Table section --}}
        <div class="overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200">
            <table class="table w-full table-zebra">
                <thead class="bg-gray-50 border-b text-center border-gray-200">
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Judul Material</th>
                        <th>Nama Proyek</th>
                        <th>Nama Klien</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                {{-- Bagian Filter tabel --}}
                <div class="flex flex-row w-full gap-4 bg-white shadow-sm rounded-lg p-4 mb-6 border-gray-200">
                    {{-- Search bar --}}
                    <form action="" method="GET">
                        <div class="relative flex-1 min-w-64">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="ph-bold ph-magnifying-glass text-xl text-gray-400 w-5 h-5"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari material..."
                                class="block w-full pl-12 pr-3 py-2 border text-md border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </form>

                    {{-- Filter Controls --}}
                    <form class="flex flex-row w-2/3 items-center gap-2" action="" method="GET">
                        <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" type="submit">
                            <i class="ph-bold ph-funnel"></i>                    
                            <span class="ml-2">Filter</span>
                        </button>

                    </form>


                </div>


                <tbody class="text-center">
                    @if (isset($materials) && count($materials) > 0)
                        @foreach ($materials as $index => $material)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $material->created_at->format('d M Y') }}</td>
                                <td>{{ $material->material_title }}</td>
                                <td>{{ $material->project->project_name }}</td>
                                <td>{{ $material->client_name }}</td>
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    @endif

                </tbody>


            </table>
        </div>
    </section>

@endsection