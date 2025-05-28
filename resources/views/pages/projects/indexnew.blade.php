{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Proyek - SIMPP Pillar Presisi
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

@section('page-content')
    <section class="flex flex-col p-6">
        {{-- Page Header --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Proyek</h1>
            <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" onclick="window.location.href='{{ route('projects.create') }}'">
                <i class="ph-bold ph-plus"></i>
                <span class="ml-2">Tambah Proyek</span>
            </button>
        </div>

        {{-- Bagian Filter Tabel --}}
        <div class="flex flex-row w-full gap-4 bg-white shadow-sm rounded-lg p-4 mb-6 border-gray-200">
            {{-- Search Bar --}}
            <form class="flex flex-row w-1/3" action="" method="POST">
                <div class="relative flex-1 min-w-64">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-magnifying-glass text-xl text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" name="search_bar" placeholder="Cari proyek..."
                        class="block w-full pl-12 pr-3 py-2 border text-md border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </form>

            {{-- Filter Controls --}}
            <form class="flex flex-row w-2/3 items-center gap-2" action="" method="POST">
                <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" type="submit">
                    <i class="ph-bold ph-funnel"></i>                    
                    <span class="ml-2">Filter</span>
                </button>
                {{-- Input Dropdown - Prioritas  --}}
                <select name="priority" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Prioritas</option>
                    <option value="high">Tinggi</option>
                    <option value="medium">Sedang</option>
                    <option value="low">Rendah</option>
                </select>

                {{-- Input Dropdown - Jenis Proyek --}}
                <select name="project_type" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Jenis Proyek</option>
                    <option value="onsite">On-Site</option>
                    <option value="bengkel">Bengkel</option>
                </select>

                {{-- Input Dropdown - Status --}}
                <select name="status" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Status</option>
                    <option value="belum_dimulai">Belum Dimulai</option>
                    <option value="berlangsung">Berlangsung</option>
                    <option value="tertunda">Tertunda</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>


                {{-- Make reset button --}}
                <button class="px-4 py-2 bg-white text-red-600 flex flex-row items-center cursor-pointer  rounded-lg hover:bg-red-600 hover:text-white transition duration-200" type="reset">
                    <i class="ph-bold ph-arrows-counter-clockwise"></i>
                    <span class="ml-2">Reset</span>
                </button>


            </form>





 
            
            

        </div>

        
    </section>




@endsection