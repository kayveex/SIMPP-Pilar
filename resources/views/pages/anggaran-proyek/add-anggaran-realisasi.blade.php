{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Tambah Anggaran Rencana - SIMPP Pillar Presisi
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
    @include('layouts.molecules.topbar', compact('myNotif', 'countMyNotif'))
@endsection

@section('page-content')
    <section class="flex flex-col p-6">
        {{-- Page Header --}}
        <div class="flex flex-col justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Anggaran Realisasi</h1>
            <p class="text-lg font-semibold text-gray-500">Proyek {{ $project->project_name }}</p>
        </div>
        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('anggaran-proyek.index') }}">Anggaran Proyek</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('anggaran-proyek.detail', $project->project_id) }}">Detail Anggaran Proyek</a></li>
                <li>Tambah Anggaran Realisasi</li>
            </ul>
        </div>

        {{-- Content Section --}}
        <div x-data="{tab: 'tab1'}" class="w-full bg-white shadow-md rounded-xl border border-gray-200" >
            {{-- Tab Header --}}
            <div class="flex border-b border-gray-200 bg-[#F1F4F9] rounded-t-xl font-bold">
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'tab1'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'tab1', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'tab1'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-selection-plus"></i>
                    <span>Tambah Uraian Anggaran</span>
                </button>
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'tab2'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'tab2', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'tab2'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-stack-plus"></i>
                    <span>Tambah Item Anggaran</span>
                </button>
            </div>

            {{-- Tab Content --}}
            <div class="p-6">
                <div x-show="tab === 'tab1'" class="mt-4">
                    <div class="flex flex-col p-4" >
                        <form action="{{ route('anggaran-proyek.realisasi.store', $project->project_id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="block text-md mb-2 font-bold text-gray-700">Uraian Anggaran <span class="text-red-500">*</span></label>
                                <input type="text" id="title" name="title" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ old('title') }}"  required>
                            </div>
                            {{-- Button untuk submit --}}
                            <div class="flex flex-row items-center justify-end">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600  cursor-pointer">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div x-show="tab === 'tab2'" class="mt-4">
                    <div class="flex flex-col p-4" >
                        <form action="{{ route('anggaran-proyek.realisasi.items.store') }}" method="POST">
                            @csrf
                            {{-- Pilihan untuk uraian anggaran mana --}}
                            <div class="mb-4">
                                <label for="anggaran_realisasi_id" class="block text-md mb-2 font-bold text-gray-700">Pilih Uraian Anggaran <span class="text-red-500">*</span></label>
                                <select id="anggaran_realisasi_id" name="anggaran_realisasi_id" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                    <option value="" disabled>-- Pilih Uraian Anggaran --</option>
                                    @foreach($anggaranRealisasi as $realisasi)
                                        <option value="{{ $realisasi->anggaran_realisasi_id }}">{{ $realisasi->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="item_name" class="block text-md mb-2 font-bold text-gray-700">Nama Item Anggaran <span class="text-red-500">*</span></label>
                                <input type="text" id="item_name" name="item_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ old('item_name') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="quantity" class="block text-md mb-2 font-bold text-gray-700">Kuantitas <span class="text-red-500">*</span></label>
                                <input type="number" id="quantity" name="quantity" step="any" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ old('quantity') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="unit" class="block text-md mb-2 font-bold text-gray-700">Satuan <span class="text-red-500">*</span></label>
                                <select id="unit" name="unit" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                    <option value="" disabled selected>Pilih Satuan</option>
                                    <option value="pcs">Pcs</option>
                                    <option value="kg">Kg</option>
                                    <option value="m">Meter</option>
                                    <option value="cm">Cm</option>
                                    <option value="liter">Liter</option>
                                    <option value="set">Set</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="price_per_unit" class="block text-md mb-2 font-bold text-gray-700">Harga Satuan Item <span class="text-red-500">*</span></label>
                                <input type="number" id="price_per_unit" name="price_per_unit" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ old('price_per_unit') }}" required>
                            </div>

                            {{-- Button untuk submit --}}
                            <div class="flex flex-row items-center justify-end">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600  cursor-pointer">Simpan</button>
                            </div>

                        </form>
                        
                    </div>
                </div>

        </div>

    </section>
@endsection