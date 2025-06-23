{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Edit Pengajuan Material - SIMPP Pillar Presisi
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
                <li>Edit Material</li>
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
                @if(Auth::user()->isPurchasing())
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'persetujuan' }"
                    @click="tab = 'persetujuan'"
                >
                    Edit Persetujuan
                </button>
                @endif
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
                        <form action="{{ route('material.update', $material->material_id) }}" method="POST" enctype="multipart/form-data">
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
                                    class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">{{ $material->material_notes }}</textarea>
                            </div>
                            <div class="flex w-full mb-4 gap-4">
                                @if(Auth::user()->isPurchasing())
                                <div class="w-1/2 flex-col mb-4">
                                    <h3 class="text-lg font-semibold mb-2">Vendor</h3>
                                    <input type="text" id="vendor" name="vendor" value="{{ $material->vendor }}"
                                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                                </div>
                                <div class="w-1/2 flex-col mb-4 gap-4">
                                    <h3 class="text-lg font-semibold mb-2">Upload Invoice (Rekap)</h3>
                                    <input type="file" id="invoice" name="invoice"
                                        class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full file:bg-blue-600 file:text-white file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" >
                                </div>
                                @endif

                            </div>

                            {{-- Tanggal - Tanggal Kedatangan (Only for Purchasing) --}}
                            @if(Auth::user()->isPurchasing())
                            <div class="flex flex-row w-full mb-4 gap-4">
                                <div class="w-1/2 flex flex-col">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Estimasi Kedatangan</h3>
                                    <input type="date" id="estimated_arrival_date" name="estimated_arrival_date" value="{{ $material->estimated_arrival_date }}"
                                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" >
                                </div>
                                <div class="w-1/2 flex flex-col">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Kedatangan (Realita)</h3>
                                    <input type="date" id="actual_arrival_date" name="actual_arrival_date" value="{{ $material->actual_arrival_date }}"
                                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" >
                                </div>
                            </div>
                            @endif

                            {{-- approval_status (Only for Purchasing) --}}
                            @if(Auth::user()->isPurchasing())
                            <div class="flex flex-col w-full mb-4">
                                <h3 class="text-lg font-semibold mb-2">Status Pengajuan</h3>
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
                            @endif

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
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-grid-nine text-xl"></i>
                        <h2 class="text-lg font-bold">Edit Tabel Item</h2>
                    </div>

                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <div class="flex flex-row justify-between items-center mb-4">
                            <h3 class="text-xl font-bold">Tabel Item Material</h3>
                            <a href="{{ route('material-items.create', $material->material_id) }}" class="px-4 py-2 font-bold flex items-center justify-center gap-2 cursor-pointer rounded-lg bg-blue-600 hover:bg-blue-700 text-white">
                                <i class="ph-bold ph-plus text-xl"></i>
                                <span>Tambahkan</span>
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
                                                    <a href="{{ route('material-items.edit', $item->item_id) }}" class="text-yellow-600 hover:text-yellow-800">
                                                        <i class="ph-bold ph-pencil-simple text-lg"></i>
                                                    </a>
                                                    <form action="{{ route('material-items.delete', $item->item_id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800 cursor-pointer">
                                                            <i class="ph-bold ph-trash text-lg"></i>
                                                        </button>
                                                    </form>
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
                {{-- Tab 3 (Only for Purchasing) --}}
                @if(Auth::user()->isPurchasing())
                <div x-show="tab === 'persetujuan'" xtransition>
                    {{-- Fill content here --}}

                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-list-checks"></i>
                        <h2 class="text-lg font-bold">Edit Persetujuan</h2>
                    </div>
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        @php
                            $userRole = Auth::user()->role;
                            $isPurchasing = $userRole === 'Divisi Purchasing' || $userRole === 'Super Admin';
                            $isApproved = $material->purchasing_approval == true || $material->purchasing_approval == 1 ;
                        @endphp

                        @if ($isPurchasing && !$isApproved)
                            <h3 class="text-lg font-semibold">
                                Berikan Persetujuan Material Sebagai Perwakilan Divisi Purchasing?
                            </h3>

                            <form action="{{ route('material.approval', $material->material_id) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 font-bold cursor-pointer rounded-lg bg-green-600 hover:bg-green-700 text-white">
                                    Setujui
                                </button>
                            </form>

                        @elseif ($isPurchasing && $isApproved)
                            <h3 class="text-lg font-semibold">
                                Material Sudah Disetujui Oleh Divisi Purchasing pada
                                <span class="font-bold text-green-600">
                                    {{ \Carbon\Carbon::parse($material->purchasing_approval_date)->translatedFormat('j F Y') }}.
                                </span>
                            </h3>

                            <form action="{{ route('material.approval.delete', $material->material_id) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 font-bold cursor-pointer rounded-lg bg-red-600 hover:bg-red-700 text-white">
                                    Batalkan Persetujuan
                                </button>
                            </form>

                        @elseif (!$isPurchasing && $isApproved)
                            <h3 class="text-lg font-semibold">
                                Material ini sudah disetujui oleh Divisi Purchasing pada
                                <span class="font-bold text-green-600">
                                    {{ \Carbon\Carbon::parse($material->purchasing_approval_date)->translatedFormat('j F Y') }}.
                                </span>
                            </h3>
                            <p class="text-sm text-gray-500 mt-2">
                                Anda tidak dapat mengubah status persetujuan material ini karena sudah disetujui oleh Divisi Purchasing.
                            </p>

                        @elseif (!$isPurchasing && !$isApproved)
                            <h3 class="text-lg font-semibold">
                                Material ini belum disetujui oleh Divisi Purchasing.
                            </h3>
                            <p class="text-sm text-gray-500 mt-2">
                                Anda tidak dapat mengubah status persetujuan material ini karena bukan merupakan Divisi Purchasing.
                            </p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    
@endsection