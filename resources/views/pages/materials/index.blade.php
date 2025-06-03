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
    <section class="flex flex-col px-6 pt-6">
        {{-- Title --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800"> Pengajuan Material</h1>
            <a href="{{ route('material.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="ph-bold ph-plus"></i>
                <span class="ml-2">Tambah Material</span>
            </a>
        </div>
        {{-- Bagian Filter tabel --}}
        <div class="flex flex-row w-full gap-4 bg-white shadow-sm rounded-lg p-4 mb-6 border-gray-200">
            {{-- Search bar --}}
            <form class="flex w-full" action="{{ route('material.index') }}" method="GET">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-magnifying-glass text-xl text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menurut proyek..."
                        class="block w-full pl-12 pr-3 py-2 border text-md border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </form>

            {{-- Filter Controls --}}
            <form class="flex flex-row w-full items-center justify-start gap-2" action="" method="GET">
                <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" type="submit">
                    <i class="ph-bold ph-funnel"></i>                    
                    <span class="ml-2">Filter</span>
                </button>

                {{-- Input dropdown - Berdasarkan Terbaru dan Terlama --}}
                <select name="sort" class="block w-64 min-w-fit pl-3 pr-10 py-2 border border-gray-300 text-md rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled {{ request('sort') == '' ? 'selected' : '' }}>Urutan</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>

                {{-- Input dropdown - Berdasarkan approval_status --}}
                <select name="approval_status" class="block w-64 min-w-fit pl-3 pr-10 py-2 border border-gray-300 text-md rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled {{ request('approval_status') == '' ? 'selected' : '' }}>Status Persetujuan</option>
                    <option value="diproses" {{ request('approval_status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dipesan" {{ request('approval_status') == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                    <option value="ditolak" {{ request('approval_status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="diterima" {{ request('approval_status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="disetujui" {{ request('approval_status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                </select>

                {{-- Reset Button --}}
                <a href="{{ route('material.index') }}" class="px-4 py-2 bg-white text-red-600 flex flex-row items-center cursor-pointer rounded-lg hover:bg-red-600 hover:text-white transition duration-200">
                    <i class="ph-bold ph-arrows-counter-clockwise"></i>
                    <span class="ml-2">Reset</span>
                </a>

            </form>
        </div>

        {{-- Table section --}}
        <div class="overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200">
            <table class="table w-full table-zebra">
                <thead class="bg-gray-50 border-b text-center border-gray-200">
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Judul Material</th>
                        <th>Nama Proyek</th>
                        <th>Nama Klien</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @if (isset($materials) && count($materials) > 0)
                        @foreach ($materials as $index => $material)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $material->created_at->format('d M Y') }}</td>
                                <td>{{ $material->material_title }}</td>
                                <td>{{ $material->project->project_name }}</td>
                                <td>{{ $material->client_name }}</td>
                                <td>{{ $material->approval_status }}</td>
                                <td class="flex flex-row justify-center items-center gap-2">
                                    <div class="flex flex-row gap-2 text-lg">
                                        <a href="#" class="py-2 text-blue-600 hover:text-blue-800 transition duration-200" title="Lihat Detail Material">
                                            <i class="ph-bold ph-eye"></i>
                                        </a>
                                        <a href="#" class="py-2 text-yellow-500 hover:text-yellow-600 transition duration-200" title="Edit Detail Material">
                                            <i class="ph-bold ph-pencil-simple-line"></i>
                                        </a>
                                        <div x-data="{ showModal: false }">
                                            <button @click="showModal = true" class="py-2 text-red-500 hover:text-red-600 transition duration-200 cursor-pointer" title="Hapus Material">
                                                <i class="ph-bold ph-trash-simple"></i>
                                            </button>

                                            {{-- Modal --}}
                                            <div x-show="showModal" x-cloak class="fixed inset-0 z-30 flex items-center justify-center backdrop-blur-sm bg-black/30">
                                                <div @click.away="showModal = false" class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
                                                    <h2 class="text-lg font-bold mb-4 text-gray-800">Konfirmasi Hapus</h2>
                                                    <p class="text-gray-600 mb-6">
                                                        Apakah Anda yakin ingin menghapus <strong>{{ $material->material_title }}</strong>? Tindakan ini tidak dapat dibatalkan.
                                                    </p>

                                                    <div class="flex justify-end gap-4">
                                                        <button @click="showModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">Batal</button>

                                                        <form action="" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    @endif

                </tbody>


            </table>
        </div>
    </section>

@endsection