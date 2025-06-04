{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Pengajuan Material - SIMPP Pillar Presisi
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
    <section class="flex flex-col px-6 py-6">
        {{-- Title --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Edit Material</h1>
        </div>

        {{-- Breadcrumbs --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="/material">Pengajuan Material</a></li>
                <li>Edit Proyek</li>
            </ul>
        </div>

        {{-- Content Section - Form --}}
        <div x-data="{ tab: 'detail' }" class="w-full bg-white shadow-md rounded-lg border border-gray-200">
            {{-- Tab headers --}}
            <div class="tabs tabs-boxed w-full">
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'detail' }"
                    @click="tab = 'detail'"
                >
                    Edit Material
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'table' }"
                    @click="tab = 'table'"
                >
                    Edit Tabel Item
                </button>
                {{-- Buat Divisi Purchasing - > NgeACC --}}
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'persetujuan' }"
                    @click="tab = 'persetujuan'"
                >
                    Edit Persetujuan
                </button>
            </div>

            {{-- Tab content --}}
            <div class="p-6 bg-base-100">
                {{-- Tab 1 --}}
                <div x-show="tab === 'detail'" xtransition>
                    {{-- Fill content here --}}
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-paperclip text-xl"></i>
                        <h2 class="text-lg font-bold">Edit Detail Material</h2>
                    </div>

                    {{-- Edit Konten 1 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="flex flex-row w-full mb-4 gap-4">
                                <div class="w-1/2 flex flex-col">
                                    <h3 class="text-lg font-semibold mb-2">Nama Proyek</h3>
                                    <input type="text" disabled id="project_name" name="project_name" value="{{ $material->project->project_name }}"
                                        class="border border-gray-300 bg-gray-100 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" >
                                </div>
                                <div class="w-1/2 flex flex-col">
                                    <h3 class="text-lg font-semibold mb-2">Nama Klien</h3>
                                    <input type="text" disabled id="client_name" name="client_name" value="{{ $material->client_name }}"
                                        class="border border-gray-300 bg-gray-100 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" >
                                </div>
                            </div>

                            <div class="flex flex-col w-full mb-4">
                                <h3 class="text-lg font-semibold mb-2">Judul Material</h3>
                                <input type="text" id="material_title" name="material_title" value="{{ $material->material_title }}"
                                    class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                            </div>

                            {{-- horizontal line --}}
                            <hr class="my-4 border-t border-gray-300">

                            <div class="flex flex-col w-full mb-4">
                                <h3 class="text-lg font-semibold mb-2">Catatan Material</h3>
                                <textarea id="material_notes" name="material_notes" rows="4"
                                    class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">{{ $material->material_description }}</textarea>
                            </div>
                            <div class="flex w-full mb-4 gap-4">
                                <div class="w-1/2 flex-col mb-4">
                                    <h3 class="text-lg font-semibold mb-2">Vendor</h3>
                                    <input type="text" id="vendor" name="vendor" value="{{ $material->vendor }}"
                                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                </div>
                                <div class="w-1/2 flex-col mb-4 gap-4">
                                    <h3 class="text-lg font-semibold mb-2">Upload Invoice (Rekap)</h3>
                                    <input type="file" id="invoice_file" name="invoice_file"
                                        class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full file:bg-blue-600 file:text-white file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" >
                                </div>

                            </div>

                            {{-- Tanggal - Tanggal Kedatangan --}}
                            <div class="flex flex-row w-full mb-4 gap-4">
                                <div class="w-1/2 flex flex-col">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Estimasi Kedatangan</h3>
                                    <input type="date" id="estimated_arrival_date" name="estimated_arrival_date" value="{{ $material->estimated_arrival_date }}"
                                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                </div>
                                <div class="w-1/2 flex flex-col">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Kedatangan (Realita)</h3>
                                    <input type="date" id="actual_arrival_date" name="actual_arrival_date" value="{{ $material->actual_arrival_date }}"
                                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                </div>
                            </div>

                            {{-- approval_status --}}
                            <div class="flex flex-col w-full mb-4">
                                <h3 class="text-lg font-semibold mb-2">Status Persetujuan</h3>
                                <select id="approval_status" name="approval_status"
                                    class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                    <option value="">-- Pilih Status Persetujuan --</option>
                                    <option value="diproses" {{ $material->approval_status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="dipesan" {{ $material->approval_status === 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                                    <option value="disetujui" {{ $material->approval_status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="diterima" {{ $material->approval_status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ $material->approval_status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            {{-- Button - Edit --}}
                            <div class="flex flex-row justify-end">
                                <button type="submit" class="px-4 py-2 font-bold cursor-pointer rounded-lg bg-blue-600 hover:bg-blue-700 text-white">
                                    Simpan Perubahan
                                </button>
                            </div>




                        </form>
                    </div>





                </div>

                {{-- Tab 2 --}}
                <div x-show="tab === 'table'" xtransition>
                    {{-- Fill content here --}}

                </div>
                {{-- Tab 3 --}}
                <div x-show="tab === 'persetujuan'" xtransition>
                    {{-- Fill content here --}}

                </div>
            </div>

        </div>




    </section>
    
@endsection