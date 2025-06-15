{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Jadwal Proyek - SIMPP Pillar Presisi
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
        {{-- Page Header --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Proyek</h1>
        </div>

        {{-- Bagian Filter Tabel --}}
        <div class="flex flex-row w-full gap-4 bg-white shadow-sm rounded-lg p-4 mb-6 border-gray-200">
            {{-- Search Bar --}}
            <form class="flex flex-row w-1/3" action="{{ route('schedules.index') }}" method="GET">
                <div class="relative flex-1 min-w-64">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-magnifying-glass text-xl text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari proyek..."
                        class="block w-full pl-12 pr-3 py-2 border text-md border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </form>

            {{-- Filter Controls --}}
            <form class="flex flex-row w-2/3 items-center gap-2" action="{{ route('schedules.index') }}" method="GET">
                <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" type="submit">
                    <i class="ph-bold ph-funnel"></i>                    
                    <span class="ml-2">Filter</span>
                </button>
                {{-- Input Dropdown - Prioritas  --}}
                <select name="priority" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Prioritas</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                </select>

                {{-- Input Dropdown - Jenis Proyek --}}
                <select name="project_type" value="{{ request('project_type') }}" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Jenis Proyek</option>
                    <option value="onsite" {{ request('project_type') == 'onsite' ? 'selected' : '' }}>On-Site</option>
                    <option value="bengkel" {{ request('project_type') == 'bengkel' ? 'selected' : '' }}>Bengkel</option>
                </select>

                {{-- Input Dropdown - Status --}}
                <select name="status" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Status</option>
                    <option value="belum_dimulai" {{ request('status') == 'belum_dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                    <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="tertunda" {{ request('status') == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>


                {{-- Make reset button --}}
                <a href="{{ route('schedules.index') }}" class="px-4 py-2 bg-white text-red-600 flex flex-row items-center cursor-pointer rounded-lg hover:bg-red-600 hover:text-white transition duration-200">
                    <i class="ph-bold ph-arrows-counter-clockwise"></i>
                    <span class="ml-2">Reset</span>
                </a>
            </form>
        </div>

        {{-- Bagian Tabel --}}
        <div class="overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200">
            <table class="table w-full table-zebra">

                {{-- Table Header --}}
                <thead class="bg-gray-50 border-b text-center border-gray-200">
                    <tr>
                        <th>No.</th>
                        <th>Nama Proyek</th>
                        <th>Klien</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @if (isset($projects) && count($projects) > 0)
                        @foreach ($projects as $index => $project)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->client_name }}</td>
                                <td>
                                    @include('layouts.atoms.jenis-project', ['project' => $project])
                                </td>
                                <td>
                                    {{ $project->start_date->format('d M Y') }} {{-- Format tanggal --}}
                                    {{-- Tampilkan tanggal selesai jika ada --}}
                                    @if ($project->actual_end_date === null)
                                        <span class="text-red-500">– {{ $project->estimated_end_date->format('d M Y') }} (Est.)</span>
                                    @elseif ($project->actual_end_date !== null)
                                        <span class="text-red-500">– {{ $project->actual_end_date->format('d M Y') }}</span> 
                                    @endif
                                </td>
                                <td>
                                    @include('layouts.atoms.badges-project-status', ['project' => $project])
                                </td>

                                <td class="flex flex-row justify-center items-center gap-2">
                                    <div class="flex flex-row gap-2 text-lg">
                                        <a href="{{ route('schedules.view', $project->project_id) }}" class="py-2 text-blue-600 hover:text-blue-800 transition duration-200" title="Lihat Jadwal Proyek">
                                            <i class="ph-bold ph-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                    @endif

                    {{-- Jika tidak ada data proyek --}}
                    @if (isset($projects) && count($projects) === 0)
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Tidak ada data proyek yang ditemukan.</td>
                        </tr>
                    @endif
                </tbody>

            </table>

            {{-- Info jumlah data + Pagination --}}
            <div class="flex justify-between items-center mt-4 px-4 py-2 text-sm text-gray-600">
                <div>
                    Menampilkan
                    <span class="font-semibold">{{ $projects->firstItem() }}</span>
                    –
                    <span class="font-semibold">{{ $projects->lastItem() }}</span>
                    dari
                    <span class="font-semibold">{{ $projects->total() }}</span>
                    proyek
                </div>

                <div class="flex justify-end">
                    {{ $projects->links('pagination::tailwind') }}
                </div>
            </div>
        </div>

    </section>

@endsection