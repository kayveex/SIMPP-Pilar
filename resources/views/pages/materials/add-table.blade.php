{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Tambah Item Material - SIMPP Pillar Presisi
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
    <section class="flex flex-col p-6"
            x-data="{
            showCustomUnit: false,
            pricePerUnit: '{{ old('price_per_unit', 0) }}',
            rupiahFormat(value) {
                let val = parseFloat(value || 0);
                return 'Rp ' + val.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
            }
        }"
    >        
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Item Material</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('material.index') }}">Pengajuan Material</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('material.edit', $material->material_id) }}">Edit Material</a></li>
                <li>Tambah Item Material</li>
            </ul>
        </div>

        {{-- Submit form --}}
        <div class="flex flex-col p-6 bg-white rounded-lg shadow-md mt-4">
            <form action="{{ route('material-items.store', $material->material_id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="item_name" class="text-md font-semibold mb-2">Nama Item <span class="text-red-500">*</span></label>
                    <input type="text" id="item_name" name="item_name" 
                           class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                           value="{{ old('item_name') }}" required>
                </div>

                <div class="flex flex-row mb-4 gap-4">
                    <div class="flex flex-col w-1/2">
                        <label for="quantity" class="text-md font-semibold mb-2">Kuantitas<span class="text-red-500">*</span></label>
                        <input type="number" id="quantity" name="quantity" step="any"
                               class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                               value="{{ old('quantity') }}" required>
                    </div>

                    <div class="flex flex-col w-1/2">
                        <label for="unit" class="text-md font-semibold mb-2">Satuan<span class="text-red-500">*</span></label>
                        <select id="unit" name="unit" 
                                class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                                required x-on:change="showCustomUnit = ($event.target.value === 'lainnya')">
                            <option value="" disabled selected>Pilih Satuan</option>
                            <option value="pcs">Pcs</option>
                            <option value="kg">Kg</option>
                            <option value="m">Meter</option>
                            <option value="cm">Cm</option>
                            <option value="liter">Liter</option>
                            <option value="set">Set</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        
                        <!-- Custom unit input -->
                        <div x-show="showCustomUnit" class="mt-2">
                            <label for="custom_unit" class="text-sm font-semibold mb-1">Satuan Lainnya</label>
                            <input type="text" id="custom_unit" name="custom_unit" 
                                   class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                                   placeholder="Masukkan satuan custom"
                                   x-bind:required="showCustomUnit">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="price_per_unit" class="text-md font-semibold mb-2">
                        @if(Auth::user()->isTeknikal())
                            Harga Satuan Item (Perkiraan) <span class="text-red-500">*</span>
                        @else
                            Harga Satuan Item <span class="text-red-500">*</span>
                        @endif
                    </label>
                    @if(Auth::user()->isTeknikal())
                        <p class="text-sm text-gray-600 mb-2">Masukkan perkiraan harga. Divisi Purchasing dapat mengedit harga ini nanti.</p>
                    @endif
                        <input type="number" id="price_per_unit" name="price_per_unit"
                            x-model="pricePerUnit"
                            class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                            value="{{ old('price_per_unit') }}" required>
                        <p class="text-sm text-gray-500 mt-2">
                            Preview: <span x-text="rupiahFormat(pricePerUnit)"></span>
                        </p>
                </div>

                <div class="mb-4">
                    <label for="required_date" class="text-md font-semibold mb-2">Dibutuhkan Tanggal</label>
                    <input type="date" id="required_date" name="required_date" 
                           class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                           value="{{ old('required_date') }}">
                </div>

                <div class="mb-4">
                    <label for="notes" class="text-md font-semibold mb-2">Catatan</label>
                    <textarea id="notes" name="notes" 
                              class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                              rows="4">{{ old('notes') }}</textarea>
                </div>

                <div class="flex flex-row items-center justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white cursor-pointer rounded hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection