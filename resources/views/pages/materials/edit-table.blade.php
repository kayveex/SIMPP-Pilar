{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Edit Item Material - SIMPP Pillar Presisi
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
    <section class="flex flex-col px-6 pt-6" x-data="{ 
        showCustomUnit: '{{ !in_array(old('unit', $item->unit), ['pcs', 'kg', 'm', 'cm', 'liter', 'set']) && old('unit', $item->unit) ? 'true' : 'false' }}' === 'true',
        currentUnit: '{{ old('unit', $item->unit) }}',
        customUnitValue: '{{ !in_array(old('unit', $item->unit), ['pcs', 'kg', 'm', 'cm', 'liter', 'set']) ? old('unit', $item->unit) : '' }}'
    }">
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Edit Item Material</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('material.index') }}">Pengajuan Material</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('material.edit', $material->material_id) }}">Edit Material</a></li>
                <li>Edit Item Material</li>
            </ul>
        </div>

        {{-- Submit Edit Form --}}
        <div class="flex flex-col p-6 bg-white rounded-lg shadow-md mt-4">
            <form action="{{ route('material-items.update', $item->item_id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="item_name" class="text-md font-semibold mb-2">Nama Item <span class="text-red-500">*</span></label>
                    <input type="text" id="item_name" name="item_name" 
                           class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                           value="{{ old('item_name', $item->item_name) }}" required>
                </div>

                <div class="flex flex-row mb-4 gap-4">
                    <div class="flex flex-col w-1/2">
                        <label for="quantity" class="text-md font-semibold mb-2">Kuantitas<span class="text-red-500">*</span></label>
                        <input type="number" id="quantity" name="quantity" step="any"
                               class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                               value="{{ old('quantity', $item->quantity) }}" required>
                    </div>

                    <div class="flex flex-col w-1/2">
                        <label for="unit" class="text-md font-semibold mb-2">Satuan<span class="text-red-500">*</span></label>
                        <select name="unit" id="unit" 
                                class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" 
                                required 
                                x-on:change="showCustomUnit = ($event.target.value === 'lainnya')">
                            <option value="" disabled {{ old('unit', $item->unit) ? '' : 'selected' }}>Pilih Satuan</option>
                            <option value="pcs" {{ old('unit', $item->unit) == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="kg" {{ old('unit', $item->unit) == 'kg' ? 'selected' : '' }}>Kg</option>
                            <option value="m" {{ old('unit', $item->unit) == 'm' ? 'selected' : '' }}>Meter</option>
                            <option value="cm" {{ old('unit', $item->unit) == 'cm' ? 'selected' : '' }}>Cm</option>
                            <option value="liter" {{ old('unit', $item->unit) == 'liter' ? 'selected' : '' }}>Liter</option>
                            <option value="set" {{ old('unit', $item->unit) == 'set' ? 'selected' : '' }}>Set</option>
                            <option value="lainnya" {{ !in_array(old('unit', $item->unit), ['pcs', 'kg', 'm', 'cm', 'liter', 'set']) && old('unit', $item->unit) ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        
                        <!-- Custom unit input -->
                        <div x-show="showCustomUnit" class="mt-2">
                            <label for="custom_unit" class="text-sm font-semibold mb-1">Satuan Lainnya</label>
                            <input type="text" id="custom_unit" name="custom_unit" 
                                   class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                                   placeholder="Masukkan satuan custom"
                                   x-model="customUnitValue"
                                   x-bind:required="showCustomUnit">
                        </div>
                    </div>
                </div>

                @if(Auth::user()->isPurchasing())
                <div class="mb-4">
                    <label for="received_quantity" class="text-md font-semibold mb-2">Kuantitas Diterima</label>
                    <input type="number" id="received_quantity" name="received_quantity" step="any"
                           class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                           value="{{ old('received_quantity', $item->received_quantity) }}">
                </div>
                @endif

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
                    <input type="number" id="price_per_unit" name="price_per_unit" step="any"
                           class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                           value="{{ old('price_per_unit', $item->price_per_unit) }}" required>
                </div>

                <div class="flex flex-row mb-4 gap-4">
                    <div class="flex flex-col w-1/2">
                        <label for="required_date" class="text-md font-semibold mb-2">Dibutuhkan Tanggal</label>
                        <input type="date" id="required_date" name="required_date"
                               class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                               value="{{ old('required_date', $item->required_date?->format('Y-m-d')) }}">
                    </div>
                    @if(Auth::user()->isPurchasing())
                    <div class="flex flex-col w-1/2">
                        <label for="received_date" class="text-md font-semibold mb-2">Diterima Tanggal</label>
                        <input type="date" id="received_date" name="received_date"
                               class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                               value="{{ old('received_date', $item->received_date?->format('Y-m-d')) }}">
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="notes" class="text-md font-semibold mb-2">Catatan</label>
                    <textarea id="notes" name="notes" 
                              class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                              rows="4">{{ old('notes', $item->notes) }}</textarea>
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