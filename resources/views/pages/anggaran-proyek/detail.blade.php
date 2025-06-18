{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Anggaran Proyek - SIMPP Pillar Presisi
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
        {{-- Page header --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Detail Anggaran Proyek</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('anggaran-proyek.index') }}">Anggaran Proyek</a></li>
                <li>Detail Anggaran Proyek</li>
            </ul>
        </div>

        {{-- Content Section --}}
        <div x-data="{tab: 'tab1'}" class="w-full bg-white shadow-md rounded-xl border border-gray-200" >
            {{-- Tab Header --}}
            <div class="flex border-b border-gray-200 bg-[#F1F4F9] rounded-t-xl font-bold">
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'tab1'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'tab1', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'tab1'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-receipt"></i>
                    <span>Rencana Anggaran</span>
                </button>
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'tab2'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'tab2', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'tab2'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-hand-coins"></i>
                    <span>Realisasi Anggaran</span>
                </button>
            </div>

            {{-- Tab Content --}}
            <div class="p-6">
                <div x-show="tab === 'tab1'" class="mt-4">
                    <div class="flex flex-col p-4" >
                        <div class="flex flex-row items-center justify-between gap-2">
                            <h2 class="text-2xl font-bold">Rencana Anggaran</h2>
                            <div class="flex flex-row items-center gap-2">
                                <button class="px-4 py-2 bg-green-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-green-700 transition duration-200" onclick="window.location.href='{{ route('projects.create') }}'">
                                    <i class="ph-bold ph-microsoft-excel-logo"></i>
                                    <span class="ml-2 font-bold">Export Excel</span>
                                </button>
                                <a href="{{ route('anggaran-proyek.add', $project->project_id) }}" class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" >
                                    <i class="ph-bold ph-plus"></i>
                                    <span class="ml-2 font-bold">Tambahkan</span>
                                </a>
                            </div>
                        </div>

                        {{-- Display project name --}}
                        <div class="mt-4">
                            <h3 class="text-lg font-bold">Proyek: <span class="font-normal">{{ $project->project_name }}</span></h3>
                        {{-- hr line --}}
                        <hr class="my-4 border-gray-300">
                        {{-- Rencana Anggaran Table --}}
                        <table class="table w-full table-zebra">
                            {{-- Table Header --}}
                            <thead class="bg-gray-50 border-b text-center border-gray-200">
                                <tr>
                                    <th>No.</th>
                                    <th>Uraian Anggaran</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>



                        </table>
                        
                    </div>
                </div>
                <div x-show="tab === 'tab2'" class="mt-4">
                    <div class="flex flex-col p-4" >
                        <div class="flex flex-row items-center justify-between gap-2">
                            <h2 class="text-2xl font-bold">Realisasi Anggaran</h2>
                            <div class="flex flex-row items-center gap-2">
                                <button class="px-4 py-2 bg-green-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-green-700 transition duration-200" onclick="window.location.href='{{ route('projects.create') }}'">
                                    <i class="ph-bold ph-microsoft-excel-logo"></i>
                                    <span class="ml-2 font-bold">Export Excel</span>
                                </button>
                                <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" onclick="window.location.href='{{ route('projects.create') }}'">
                                    <i class="ph-bold ph-plus"></i>
                                    <span class="ml-2 font-bold">Tambahkan</span>
                                </button>
                            </div>
                        </div>
                        {{-- hr line --}}
                        <hr class="my-4 border-gray-300">
                        
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection