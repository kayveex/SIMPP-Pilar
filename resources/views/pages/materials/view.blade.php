{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Pengajuan Material - SIMPP Pillar Presisi
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
            <h1 class="text-2xl font-bold text-gray-800">Detail Material</h1>
        </div>

        {{-- Breadcrumbs --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="/material">Pengajuan Material</a></li>
                <li>Detail Material</li>
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
                    Detail Material
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'table' }"
                    @click="tab = 'table'"
                >
                    Tabel Item
                </button>
                {{-- Buat Divisi Purchasing - > NgeACC --}}
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'persetujuan' }"
                    @click="tab = 'persetujuan'"
                >
                    Persetujuan
                </button>
            </div>

            {{-- Tab content --}}
            <div class="p-6 bg-base-100">
                {{-- Tab 1 --}}
                <div x-show="tab === 'detail'" xtransition>
                    {{-- Fill content here --}}
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-paperclip text-xl"></i>
                        <h2 class="text-lg font-bold">Detail Material</h2>
                    </div>

                    {{-- Edit Konten 1 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <div class="flex flex-row w-full mb-4 gap-4">
                            <div class="w-1/2 flex flex-col">
                                <h3 class="text-lg font-semibold mb-2">Nama Proyek</h3>
                                <p class="border border-gray-300 bg-gray-100 rounded-lg p-2">{{ $material->project->project_name }}</p>
                            </div>
                            <div class="w-1/2 flex flex-col">
                                <h3 class="text-lg font-semibold mb-2">Nama Klien</h3>
                                <p class="border border-gray-300 bg-gray-100 rounded-lg p-2">{{ $material->client_name }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col w-full mb-4">
                            <h3 class="text-lg font-semibold mb-2">Judul Material</h3>
                            <p class="border border-gray-300 bg-gray-100 rounded-lg p-2">{{ $material->material_title }}</p>
                        </div>

                        <hr class="my-4 border-t border-gray-300">

                        <div class="flex flex-col w-full mb-4">
                            <h3 class="text-lg font-semibold mb-2">Catatan Material</h3>
                            <p class="border border-gray-300 bg-gray-100 rounded-lg p-2 whitespace-pre-wrap">{{ $material->material_notes ?? '-' }}</p>
                        </div>

                        <div class="flex w-full mb-4 gap-4">
                            <div class="w-1/2 flex flex-col">
                                <h3 class="text-lg font-semibold mb-2">Vendor</h3>
                                <p class="border border-gray-300 bg-gray-100 rounded-lg p-2">{{ $material->vendor ?? '-' }}</p>
                            </div>
                            <div class="w-1/2 flex flex-col">
                                <h3 class="text-lg font-semibold mb-2">Invoice (Rekap)</h3>
                                @if($material->invoice)
                                    <a href="{{ asset('storage/' . $material->invoice) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>
                                @else
                                    <p class="border border-gray-300 bg-gray-100 rounded-lg p-2">Tidak ada file</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-row w-full mb-4 gap-4">
                            <div class="w-1/2 flex flex-col">
                                <h3 class="text-lg font-semibold mb-2">Tanggal Estimasi Kedatangan</h3>
                                <p class="border border-gray-300 bg-gray-100 rounded-lg p-2">
                                    {{ $material->estimated_arrival_date ?? '-' }}
                                </p>
                            </div>
                            <div class="w-1/2 flex flex-col">
                                <h3 class="text-lg font-semibold mb-2">Tanggal Kedatangan (Realita)</h3>
                                <p class="border border-gray-300 bg-gray-100 rounded-lg p-2">
                                    {{ $material->actual_arrival_date ?? '-' }}
                                </p>
                            </div>
                        </div>


                        <div class="flex flex-col w-full mb-4">
                            <h3 class="text-lg font-semibold mb-2">Status Pengajuan</h3>
                            <p class="border border-gray-300 bg-gray-100 rounded-lg p-2 capitalize">
                                {{ $material->approval_status ?? '-' }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Tab 2 --}}
                <div x-show="tab === 'table'" xtransition>
                    {{-- Fill content here --}}
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-grid-nine text-xl"></i>
                        <h2 class="text-lg font-bold">Tabel Item</h2>
                    </div>

                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <div class="flex flex-row justify-between items-center mb-4">
                            <h3 class="text-xl font-bold">Tabel Item Material</h3>

                            {{-- Button for Download Excel --}}
                            <a href="{{ route('material-items.export', $material->material_id) }}" class="px-4 py-2 font-bold flex items-center justify-center gap-2 cursor-pointer rounded-lg bg-green-600 hover:bg-green-700 text-white">
                                <i class="ph-bold ph-file-xls text-lg"></i>
                                <span class="ml-2">Download Excel</span>
                            </a>
                        </div>
                        {{-- Table --}}
                        <div class="overflow-x-auto mb-4">
                            <table class="table w-full table-zebra">
                                <thead class="bg-gray-50 border-b text-center border-gray-200">
                                    <tr>
                                        <td class="w-[10px]">No.</td>
                                        <td>Nama Item</td>
                                        <td>Qty</td>
                                        <td>Satuan</td>
                                        <td>Harga Satuan</td>
                                        <td>Total Harga</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @if (isset($materialRequests) && count($materialRequests) > 0)
                                        @foreach ($materialRequests as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->item_name }}</td>
                                                <td>
                                                    {{-- Hapus angka dibelakang koma pada Qty jika angka koma nya 0 --}}
                                                    {{ $item->quantity == floor($item->quantity) ? number_format($item->quantity, 0, ',', '.') : number_format($item->quantity, 2, ',', '.') }}

                                                </td>
                                                <td>
                                                    {{-- Kapitalkan huruf depan --}}
                                                    {{ ucfirst($item->unit) }}
                                                </td>
                                                <td>Rp. {{ number_format($item->price_per_unit, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($item->total_price, 0, ',', '.') }}</td>
                                                <td class="flex justify-center gap-2">
                                                    {{-- view --}}
                                                    <a href="{{ route('material-items.view', $item->item_id) }}" class="text-blue-600 hover:text-blue-800">
                                                        <i class="ph-bold ph-eye text-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    {{-- Jika tidak ada data --}}
                                    @if (isset($materialRequests) && count($materialRequests) == 0)
                                        <tr>
                                            <td colspan="7" class="text-center text-gray-500">Tidak ada item material yang ditambahkan.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>


                        {{-- Info jumlah data + Pagination --}}
                        <div class="flex justify-between items-center mt-4 px-4 py-2 text-sm text-gray-600">
                            <div>
                                Menampilkan
                                <span class="font-semibold">{{ $materialRequests->count() }}</span>
                                proyek
                            </div>
                            {{-- Hitung Total dari total_price --}}
                            <div>
                                Total Harga: 
                                <span class="font-semibold">Rp. {{ number_format($materialRequests->sum('total_price'), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab 3 --}}
                <div x-show="tab === 'persetujuan'" xtransition>
                    {{-- Fill content here --}}
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-list-checks"></i>
                        <h2 class="text-lg font-bold">Persetujuan Material</h2>
                    </div>
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <h3 class="text-lg font-semibold">
                            Material <span class="font-bold">{{ $material->material_title }}</span> dari proyek <span class="font-bold">{{ $material->project->project_name }} </span> sudah disetujui oleh Divisi Purchasing pada
                            <span class="font-bold text-green-600">
                                {{ \Carbon\Carbon::parse($material->purchasing_approval_date)->translatedFormat('j F Y') }}.
                            </span>
                        </h3>  
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection