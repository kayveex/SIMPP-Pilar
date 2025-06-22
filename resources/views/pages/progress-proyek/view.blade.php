{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Daftar Fase Progress - SIMPP Pillar Presisi
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

{{-- Page Content --}}
@section('page-content')
    <section class="flex flex-col p-6">
        {{-- Page Header --}}
        <div class="flex flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Fase Catatan Progress</h1>
        </div>
        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('progress-proyek.index') }}">Progress Proyek</a></li>
                <li>Daftar Fase Catatan Progress</li>
            </ul>
        </div>

        {{-- Content Section --}}
        <div class="overflow-x-auto bg-white shadow-sm rounded-lg border p-6 border-gray-200">
            <div class="flex flex-row items-center justify-between border-b border-gray-200">
                <div class="flex flex-row items-center gap-2 text-lg">
                    <i class="ph-bold ph-list-checks"></i>
                    <h2 class="font-semibold">Daftar Fase Pada <a href="{{ route('projects.show', $project->project_id) }}" class="hover:text-blue-500 hover:underline">{{ $project->project_name }}</a></h2>
                </div>
            </div>

            <div class="flex flex-col text-gray-600 mb-3 mt-2 text-md">
                <p>
                    Catatan Proyek tersimpan di dalam tiap fase proyek. 
                    Anda dapat melihat catatan-catatan tersebut dengan mengeklik tombol <i class="ph-bold mx-1.5 ph-eye text-blue-500"></i> pada salah satu fase.
                </p>
                @if (Auth::user()->role === 'Super Admin' || Auth::user()->role === 'Divisi Teknikal')
                    <p>
                        Untuk mengubah status fase/tambah fase, silahkan klik <a href="{{ route('schedules.view', $project->project_id) }}" class="text-blue-500 hover:underline">disini</a>
                    </p>
                @endif

                @if ($currentPhase !== null)
                    <div class="flex flex-row items-center gap-2 text-md bg-yellow-500/90 border-2 text-yellow-800 rounded-xl px-2 py-1.5 my-2 border-yellow-700">
                        <i class="ph-bold ph-bell-simple-ringing"></i>
                        <p class="font-semibold">
                            Hari ini sampai tanggal {{ $currentPhase->estimated_end_date->format('d M Y') }} adalah fase <span class="font-bold">{{ $currentPhase->phase_name }}</span> dari proyek ini.
                        </p>
                    </div>
                @endif
            </div>
                
            <table class="table w-full table-zebra">
                <thead class="bg-gray-50 border-b text-center border-gray-200">
                    <tr>
                        <th>No.</th>
                        <th>Nama Fase</th>
                        <th>Tanggal Periode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center ">
                    @if (isset($phases) && count($phases) > 0)
                        @foreach ($phases as $index => $phase)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a class="hover:text-blue-500 hover:underline" href="#">
                                        {{ $phase->phase_name }}
                                    </a>
                                </td>
                                <td>
                                    @if ($phase->actual_start_date === null)
                                        <span class="text-gray-800">{{ $phase->estimated_start_date->format('d M Y') }}</span>
                                    @elseif ($phase->actual_start_date !== null)
                                        <span class="text-gray-800">{{ $phase->actual_start_date->format('d M Y') }}</span>
                                    @endif

                                    <span> - </span>

                                    @if ($phase->actual_end_date === null)
                                        <span class="text-red-500">{{ $phase->estimated_end_date->format('d M Y') }}</span>
                                    @elseif ($phase->actual_end_date !== null)
                                        <span class="text-red-500">{{ $phase->actual_end_date->format('d M Y') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex flex-row justify-center text-lg items-center gap-2">
                                        <a href="{{ route('progress-proyek.report', $phase->phase_id) }}" class="py-2 text-blue-500 hover:text-blue-600 transition duration-200" title="Lihat Catatan Proyek">
                                            <i class="ph-bold ph-eye"></i>
                                        </a>
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
