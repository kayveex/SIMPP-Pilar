{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    SIMPP Pillar Presisi - Proyek Baru
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

    <section class="flex flex-col px-6 pt-6">
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Proyek Baru</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold">
            <ul>
                <li class="text-[#4880FF]"><a href="/projects">Detail Proyek</a></li>
                <li>Tambah Proyek</li>
            </ul>
        </div>
    </section>

    <section class="flex flex-col p-6">
        <div id="box-item" class="flex flex-col w-full h-fit p-6 bg-[#FFFFFF] rounded-lg shadow-md">
            <form class="flex flex-col" action="" method="post">
                @csrf
                {{-- Form Baris #1 --}}
                <div class="flex flex-row">
                    {{-- Nama Proyek --}}
                    <div class="flex flex-col w-1/2">
                        <label for="project_name" class="text-sm font-bold text-gray-700 mb-2">Nama Proyek</label>
                        <input type="text" id="project_name" name="project_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                    {{-- Nama klien --}}
                    <div class="flex flex-col w-1/2 ml-4">
                        <label for="client_name" class="text-sm font-bold text-gray-700 mb-2">Nama Klien</label>
                        <input type="text" id="client_name" name="client_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                </div>

                {{-- Form Baris #2 --}}
                <div class="flex flex-row items-center mt-4">
                    {{-- Tanggal Mulai --}}
                    <div class="flex flex-col w-1/2">
                        <label for="start_date" class="text-sm font-bold text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>

                    {{-- Tanda Strip --}}
                    <div class="mx-4 pt-6 text-gray-500 text-xl font-bold">–</div>

                    {{-- Tanggal Selesai --}}
                    <div class="flex flex-col w-1/2">
                        <label for="end_date" class="text-sm font-bold text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                </div>

                {{-- Form Baris #3 --}}
                <div class="flex flex-row mt-4">
                    {{-- Jenis Proyek --}}
                    <div class="flex flex-col w-1/3">
                        <label for="project_type"  class="text-sm font-bold text-gray-700 mb-2">Jenis Proyek</label>
                        <select name="project_type" id="project_type" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                            <option value="onsite">On-Site</option>
                            <option value="bengkel">Bengkel</option>
                        </select>
                    </div>
                    {{-- Status --}}
                    <div class="flex flex-col w-1/3 ml-4">
                        <label for="status" class="text-sm font-bold text-gray-700 mb-2">Status</label>
                        <select name="status" id="status" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                            <option value="belum_dimulai">Belum Dimulai</option>
                            <option value="berlangsung">Berlangsung</option>
                            <option value="tertunda">Tertunda</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    {{-- Penanggungjawab --}}
                    <div class="flex flex-col w-1/3 ml-4">
                        <label for="person_in_charge" class="text-sm font-bold text-gray-700 mb-2">Penanggungjawab</label>
                        <input type="text" id="person_in_charge" name="person_in_charge" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>


                    
                </div>

                {{-- Form Baris #4 --}}
                <div class="flex flex-col mt-4">
                    {{-- Deskripsi Proyek --}}
                    <label for="project_description" class="text-sm font-bold text-gray-700 mb-2">Keterangan Proyek</label>
                    <textarea id="project_description" name="project_description" rows="4" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required></textarea>
                </div>

                {{-- Form Baris #5 --}}
                <div class="flex flex-row gap-4 mt-4">
                    {{-- Buat Multiple Attachments --}}
                    <div class="flex flex-col w-1/2">
                        <label for="attachments" class="text-sm font-bold text-gray-700 mb-2">Lampiran</label>
                        <input 
                            type="file" 
                            id="attachments" 
                            name="attachments[]" 
                            multiple 
                            class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full
                                file:bg-gray-300 file:text-gray-800 file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" 
                        />
                    </div>

                    {{-- Lokasi --}}
                    <div class="flex flex-col w-1/2">
                        <label for="location" class="text-sm font-bold text-gray-700 mb-2">Lokasi Proyek</label>
                        <input type="text" id="location" name="location" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-[#4880FF] cursor-pointer text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Tambahkan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

{{-- Script for JS --}}
@section('scripts')
    
@endsection

