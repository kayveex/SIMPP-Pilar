@extends('layouts.master')

@section('page_title')
    Lihat Item Material - SIMPP Pillar Presisi
@endsection

@section('styles-head')
@endsection

@section('sidebar')
    @include('layouts.molecules.sidebar')
@endsection

@section('topbar')
    @include('layouts.molecules.topbar')
@endsection

@section('page-content')
    <section class="flex flex-col px-6 pt-6">
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Lihat Item Material</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('material.index') }}">Pengajuan Material</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('material.edit', $material->material_id) }}">Edit Material</a></li>
                <li>Lihat Item Material</li>
            </ul>
        </div>

        {{-- View Mode --}}
        <div class="flex flex-col p-6 bg-white rounded-lg shadow-md mt-4 space-y-4">
            <div>
                <label class="text-md font-semibold">Nama Item:</label>
                <p class="mt-1 text-gray-800">{{ $item->item_name }}</p>
            </div>

            <div class="flex flex-row gap-4">
                <div class="w-1/2">
                    <label class="text-md font-semibold">Kuantitas:</label>
                    <p class="mt-1 text-gray-800">{{ $item->quantity == floor($item->quantity) ? number_format($item->quantity, 0, ',', '.') : number_format($item->quantity, 2, ',', '.') }}</p>
                </div>
                <div class="w-1/2">
                    <label class="text-md font-semibold">Satuan:</label>
                    <p class="mt-1 text-gray-800">{{ ucfirst($item->unit) }}</p>
                </div>
            </div>

            <div>
                <label class="text-md font-semibold">Kuantitas Diterima:</label>
                <p class="mt-1 text-gray-800">{{ $item->received_quantity == floor($item->received_quantity) ? number_format($item->received_quantity, 0, ',', '.') : number_format($item->received_quantity, 2, ',', '.') }}</p>
            </div>

            <div>
                <label class="text-md font-semibold">Harga Satuan Item:</label>
                <p class="mt-1 text-gray-800">Rp{{ number_format($item->price_per_unit, 2, ',', '.') }}</p>
            </div>

            {{-- Total price --}}
            <div>
                <label class="text-md font-semibold">Total Harga:</label>
                <p class="mt-1 text-gray-800">Rp{{ number_format($item->total_price, 2, ',', '.') }}</p>
            </div>

            <div class="flex flex-row gap-4">
                <div class="w-1/2">
                    <label class="text-md font-semibold">Dibutuhkan Tanggal:</label>
                    <p class="mt-1 text-gray-800">
                        {{ $item->required_date?->format('d-m-Y') ?? '-' }}
                    </p>
                </div>
                <div class="w-1/2">
                    <label class="text-md font-semibold">Diterima Tanggal:</label>
                    <p class="mt-1 text-gray-800">
                        {{ $item->received_date?->format('d-m-Y') ?? '-' }}
                    </p>
                </div>
            </div>

            <div>
                <label class="text-md font-semibold">Catatan:</label>
                <p class="mt-1 text-gray-800 whitespace-pre-line">{{ $item->notes ?? '-' }}</p>
            </div>

            <div class="flex flex-row justify-end mt-6">
                <a href="{{ route('material.edit', $material->material_id) }}" class="px-4 py-2 bg-gray-300 font-bold flex items-center gap-2 text-gray-800 rounded hover:bg-gray-400 transition">
                    <i class="ph-bold ph-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </section>
@endsection
