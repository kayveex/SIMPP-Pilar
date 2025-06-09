{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@php
    $periodeStart = \Carbon\Carbon::parse($project->start_date)->format('Y-m-d');
    $periodeEnd = $project->actual_end_date
        ? \Carbon\Carbon::parse($project->actual_end_date)->format('Y-m-d')
        : \Carbon\Carbon::parse($project->estimated_end_date)->format('Y-m-d');
@endphp


@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Jadwal Proyek - SIMPP Pillar Presisi
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
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Proyek {{ $project->project_name }}</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('schedules.index') }}">Jadwal Proyek</a></li>
                <li>Detail Jadwal Proyek</li>
            </ul>
        </div>

        {{-- Content Section --}}
        <div x-data="{tab: 'visual'}" class="w-full bg-white shadow-md rounded-xl border border-gray-200" >
            {{-- Tab headers --}}
            <div class="flex border-b border-gray-200 bg-[#F1F4F9] rounded-t-xl font-bold">
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'visual'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'visual', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'visual'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-fill ph-chart-bar-horizontal"></i>
                    <span>Visualisasi Jadwal</span>
                </button>
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'table'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'table', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'table'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-fill ph-table"></i>
                    <span>Daftar Tabel</span>
                </button>
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'new_schedule'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'new_schedule', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'new_schedule'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-fill ph-calendar-plus"></i>
                    <span>Tambah Jadwal</span>
                </button>
            </div>

            {{-- Tab content --}}
            <div class="p-4">
                <div x-show="tab === 'visual'" class="space-y-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-2">Visualisasi Jadwal</h2>
                    <p>Visualisasi jadwal proyek akan ditampilkan di sini.</p>
                    {{-- Placeholder for visual content --}}
                </div>

                <div x-show="tab === 'table'" class="space-y-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="flex flex-col p-4">
                        <h2 class="text-xl font-bold mb-2">Daftar Tabel Jadwal</h2>
                        <p>Berikut adalah daftar jadwal proyek <span class="font-bold">{{ $project->project_name }}</span></p>
                        {{-- Periode --}}
                        <div class="flex flex-row items-center justify-between my-4">
                            <div class="text-md">
                                <span class="font-semibold">Periode </span>
                                <span class="font-bold text-green-500">{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</span> s.d.
                                @if ($project->actual_end_date === null)
                                    <span class="font-bold text-red-500">{{ \Carbon\Carbon::parse($project->estimated_end_date)->format('d M Y') }} (Est.)</span>
                                @elseif ($project->actual_end_date !== null)
                                    <span class="font-bold text-red-500">{{ \Carbon\Carbon::parse($project->actual_end_date)->format('d M Y') }}</span>
                                @endif

                            </div>
                        </div>

                        {{-- Tabel Rencana --}}
                        <div class="collapse bg-base-100 my-4 collapse-arrow border-base-300 border">
                            <input type="checkbox" />
                            <div class="collapse-title font-bold">Tabel Jadwal (Rencana) - Tersedia <span class="text-yellow-500">Edit</span> dan <span class="text-red-500">Delete</span></div>
                            <div class="collapse-content text-md">
                                {{-- Beritahu bahwa fitur edit dan delete mempengaruhi tabel jadwal realisasi juga --}}
                                <p class="text-sm text-gray-500 mb-2">* Perubahan data akan memengaruhi seluruh tabel. Menghapus salah satu fase akan berpengaruh pada keseluruhan jadwal.</p>
                                {{-- Tabel --}}
                                <div class="overflow-x-auto bg-white rounded-lg border border-gray-300">
                                    <table class="table w-full table-zebra">
                                        <thead class="bg-gray-50 border-b text-center border-gray-200">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @if (isset($phasesEst) && count($phasesEst) > 0)
                                                @foreach ($phasesEst as $index => $phase)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $phase->phase_name }}</td>
                                                        <td>
                                                            {{-- Jika tanggal mulai belum diisi, tampilkan "Tidak ada" --}}
                                                            @if ($phase->estimated_start_date === null)
                                                                <span class="text-red-500 font-bold">Tidak ada</span>
                                                            {{-- Jika tanggal mulai sudah diisi, tampilkan tanggalnya --}}
                                                            @elseif ($phase->estimated_start_date !== null)
                                                                {{-- Format tanggal mulai --}}
                                                                <span class="text-green-500 font-bold">
                                                                    {{ \Carbon\Carbon::parse($phase->estimated_start_date)->format('d M Y') }} 
                                                                </span>  
                                                            @endif
                                                            -
                                                            <span class="text-red-500 font-bold">
                                                                {{-- Jika tanggal selesai belum diisi, tampilkan "Tidak ada" --}}
                                                                @if ($phase->estimated_end_date === null)
                                                                    Tidak ada
                                                                @endif
                                                                {{-- Jika tanggal selesai sudah diisi, tampilkan tanggalnya --}}
                                                                @if ($phase->estimated_end_date !== null)
                                                                    {{ \Carbon\Carbon::parse($phase->estimated_end_date)->format('d M Y') }}
                                                                @endif
                                                            </span> 

                                                        </td>
                                                        <td>
                                                            {{-- Jika status belum selesai, tampilkan "Belum Selesai" --}}
                                                            @if ($phase->is_completed === false)
                                                                <span class="bg-red-500 font-bold text-white px-2 py-1 rounded-xl">Belum Selesai</span>
                                                            {{-- Jika status sudah selesai, tampilkan "Selesai" --}}
                                                            @elseif ($phase->is_completed === true)
                                                                <span class="bg-green-500 font-bold text-white px-2 py-1 rounded-xl">Selesai</span>
                                                            @endif
                                                        </td>
                                                        <td class="flex justify-center items-center gap-2 text-xl">
                                                            @if ($phase->is_completed === false)
                                                                <form action="" method="POST">
                                                                    <button class="text-green-500 cursor-pointer hover:text-green-600" title="Tandai Sudah Selesai">
                                                                        <i class="ph-bold ph-check-square-offset"></i>
                                                                    </button>
                                                                </form>
                                                            @elseif ($phase->is_completed === true)
                                                                <form action="" method="POST">
                                                                    <button class="text-red-500 cursor-pointer" title="Batalkan Penyelesaian">
                                                                        <i class="ph-bold ph-x-circle"></i>
                                                                    </button>
                                                                </form>
                                                                
                                                            @endif

                                                            <a href="" class="text-yellow-500 hover:text-yellow-600" title="Edit Jadwal">
                                                                <i class="ph-bold ph-pencil-simple-line"></i>
                                                            </a>
                                                            <form class="flex items-center justify-center" action="" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-500 cursor-pointer hover:text-red-600" title="Hapus Jadwal" >
                                                                    <i class="ph-bold ph-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            @if (isset($phasesEst) && count($phasesEst) === 0)
                                                <tr>
                                                    <td colspan="5" class="text-center text-gray-500">Tidak ada jadwal yang tersedia.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Tabel Realisasi --}}
                        <div class="collapse bg-base-100 my-4 collapse-arrow border-base-300 border">
                            <input type="checkbox" />
                            <div class="collapse-title font-bold">Tabel Jadwal (Realisasi) - <span class="text-blue-500">View Only</span></div>
                            <div class="collapse-content text-md">
                                <div class="overflow-x-auto bg-white rounded-lg border border-gray-300">
                                    <table class="table w-full table-zebra">
                                        <thead class="bg-gray-50 border-b text-center border-gray-200">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @if (isset($phasesAct) && count($phasesAct) > 0)
                                                @foreach ($phasesAct as $index => $phase)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $phase->phase_name }}</td>
                                                        <td>
                                                            @if ($phase->actual_start_date === null)
                                                                <span class="text-red-500 font-bold">Tidak ada</span>
                                                            @elseif ($phase->actual_start_date !== null)
                                                                {{ \Carbon\Carbon::parse($phase->actual_start_date)->format('d M Y') }}                                 
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($phase->actual_end_date === null)
                                                                <span class="text-red-500 font-bold">Tidak ada</span>
                                                            @elseif ($phase->actual_end_date !== null)
                                                                {{ \Carbon\Carbon::parse($phase->actual_end_date)->format('d M Y') }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($phase->is_completed === false)
                                                                <span class="bg-red-500 font-bold text-white px-2 py-1 rounded-xl">Belum Selesai</span>
                                                            @elseif ($phase->is_completed === true)
                                                                <span class="bg-green-500 font-bold text-white px-2 py-1 rounded-xl">Selesai</span>
                                                            @endif
                                                        </td>
                                                        <td class="flex justify-center items-center gap-2 text-xl">
                                                            @if ($phase->is_completed === false)
                                                                <form action="" method="POST">
                                                                    <button class="text-green-500 cursor-pointer hover:text-green-600" title="Tandai Sudah Selesai">
                                                                        <i class="ph-bold ph check-square-offset"></i>
                                                                    </button>
                                                                </form>
                                                            @elseif ($phase->is_completed === true)
                                                                <form action="" method="POST">
                                                                    <button class="text-red-500 cursor-pointer" title="Batalkan Penyelesaian">
                                                                        <i class="ph-bold ph-x-circle"></i>
                                                                    </button>           
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif  
                                            @if (isset($phasesAct) && count($phasesAct) === 0)
                                                <tr>
                                                    <td colspan="5" class="text-center text-gray-500">Tidak ada jadwal yang tersedia.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    {{-- divider --}}

                    </div>
                </div>

                <div x-show="tab === 'new_schedule'" class="space-y-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="flex flex-col p-4">
                        <h2 class="text-xl font-bold mb-4">Tambah Jadwal Baru</h2>
                        <p>Isi form di bawah ini untuk menambahkan jadwal baru ke proyek.</p>

                        <div class="text-md my-2">
                            <span class="font-semibold">Periode </span>
                            <span class="font-bold text-green-500">{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</span> s.d.
                            @if ($project->actual_end_date === null)
                                <span class="font-bold text-red-500">{{ \Carbon\Carbon::parse($project->estimated_end_date)->format('d M Y') }} (Est.)</span>
                            @elseif ($project->actual_end_date !== null)
                                <span class="font-bold text-red-500">{{ \Carbon\Carbon::parse($project->actual_end_date)->format('d M Y') }}</span>
                            @endif

                        </div>
                        {{-- divider --}}
                        <hr class="my-4 border-gray-300">
                        {{-- Form to add new schedule --}}
                        <form action="{{ route('schedules.store', $project->project_id) }}" method="POST">
                            {{-- CSRF Token --}}
                            @csrf
                            <div class="mb-4">
                                <label for="phase_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                                <input type="text" id="phase_name" name="phase_name" class="appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline" required>
                            </div>

                            <div class="flex flex-row mb-4 gap-4">
                                <div class="w-1/2">
                                    <label for="estimated_start_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai (Rencana) <span class="text-red-500">*</span></label>
                                    <input type="date" id="estimated_start_date" name="estimated_start_date" class="appearance
                                    -none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline" 
                                    min="{{ $periodeStart }}" max="{{ $periodeEnd }}"
                                    required>
                                </div>
                                <div class="w-1/2">
                                    <label for="estimated_end_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai (Rencana) <span class="text-red-500">*</span></label>
                                    <input type="date" id="estimated_end_date" name="estimated_end_date" class="appearance
                                    -none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline" 
                                    min="{{ $periodeStart }}" max="{{ $periodeEnd }}"
                                    required>
                                </div>
                            </div>

                            {{-- Button --}}
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="bg-blue-500 cursor-pointer hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                                    Tambahkan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

    </section>

@endsection

