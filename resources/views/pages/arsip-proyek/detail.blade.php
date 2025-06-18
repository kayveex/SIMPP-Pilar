{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Arsip Proyek - SIMPP Pillar Presisi
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
            <h1 class="text-2xl font-bold text-gray-800">Detail Arsip Proyek</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('arsip-proyek.index') }}">Daftar Proyek</a></li>
                <li>Detail Arsip Proyek</li>
            </ul>
        </div>

        {{-- Content section --}}
        <div x-data="{ tab: 'lampiran' }" class="w-full bg-white shadow-md rounded-lg border border-gray-200">
            <!-- Tab headers -->
            <div class="tabs tabs-boxed w-full">
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF] underline underline-offset-6 decoration-2': tab === 'lampiran' }"
                    @click="tab = 'lampiran'"
                >
                    Dashboard Arsip Proyek
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF] underline underline-offset-6 decoration-2': tab === 'detail' }"
                    @click="tab = 'detail'"
                >
                    Sekilas Mengenai Proyek
                </button>
            </div>

            <!-- Tab content -->
            <div class="px-6 pt-2 pb-6 bg-base-100">
                <!-- Tab 1 -->
                <div x-show="tab === 'lampiran'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-file-text text-xl"></i>
                        <h2 class="text-lg font-bold">Dashboard Arsip Proyek</h2>
                    </div>
                    {{-- Detail Content 3 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <div class="flex flex-row gap-6">
                            <div class="flex flex-col w-1/2">
                                <a class="flex flex-col items-center p-6 rounded-xl shadow-md " href="{{ route('projects.show', $project->project_id) }}">
                                    <i class="ph-bold ph-article text-3xl"></i>
                                    <span class="text-lg font-bold">Lihat Detail Proyek</span>
                                </a>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <a class="flex flex-col items-center p-6 rounded-xl shadow-md " href="{{ route('schedules.view', $project->project_id) }}">
                                    <i class="ph-bold ph-calendar text-3xl"></i>
                                    <span class="text-lg font-bold">Lihat Jadwal Proyek</span>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-row gap-6">
                            <div class="flex flex-col w-1/2">
                                <a class="flex flex-col items-center p-6 rounded-xl shadow-md " href="{{ route('progress-proyek.view', $project->project_id) }}">
                                    <i class="ph-bold ph-note text-3xl"></i>
                                    <span class="text-lg font-bold">Lihat Catatan Proyek</span>
                                </a>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <a class="flex flex-col items-center p-6 rounded-xl shadow-md " href="{{ route('anggaran-proyek.detail', $project->project_id) }}">
                                    <i class="ph-bold ph-coins text-3xl"></i>
                                    <span class="text-lg font-bold">Lihat Anggaran Proyek</span>
                                </a>
                            </div>




                        </div>

                    </div>
                </div>

                <!-- Tab 2 -->
                <div x-show="tab === 'detail'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-paperclip text-xl"></i>
                        <h2 class="text-lg font-bold">{{ $project->project_name }}</h2>
                    </div>
                    {{-- Detail content 1 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <div class=" flex flex-row">
                            <div class="flex flex-col w-1/2 mb-4">
                                <h3 class="text-lg font-semibold">Lokasi Proyek:</h3>
                                <p>{{ $project->location }}</p>
                            </div>
                            <div class="flex flex-col w-1/2 mb-4">
                                <h3 class="text-lg font-semibold">ID Proyek:</h3>
                                <p>{{ $project->project_id }}</p>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-blue-600 my-2"></div>
                        
                        <div class="flex flex-row">
                            <div class="mb-4 w-1/3">
                                <h3 class="text-lg font-semibold">Penanggungjawab:</h3>
                                <p>{{ $project->person_in_charge }}</p>
                            </div>
                            <div class="mb-4 w-1/3">
                                <h3 class="text-lg font-semibold">Jenis Proyek:</h3>
                                <p>{{ $project->project_type === 'onsite' ? 'On-site' : 'Workshop' }}</p>
                            </div>
                            <div class="mb-4 w-1/3">
                                <h3 class="text-lg font-semibold">Status Proyek:</h3>
                                @include('layouts.atoms.badges-project-status', ['project' => $project])

                            </div>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Deskripsi:</h3>
                            <p>{{ $project->description }}</p>
                        </div>
                        <div class="flex flex-row">
                            <div class="mb-4 w-1/3">
                                <h3 class="text-lg font-semibold">Tanggal Mulai:</h3>
                                <p class="text-green-600">{{ $project->start_date->format('d-m-Y') }}</p>
                            </div>
                            <div class="mb-4 w-1/3">
                                <h3 class="text-lg font-semibold">Tanggal Selesai (Prediksi):</h3>
                                <p class="text-orange-600">{{ $project->estimated_end_date->format('d-m-Y')}}</p>
                            </div>
                            <div class="mb-4 w-1/3">
                                <h3 class="text-lg font-semibold">Tanggal Selesai (Realisasi):</h3>
                                <p class="text-red-600">{{ $project->actual_end_date ? $project->actual_end_date->format('d-m-Y') : 'Belum Ada' }}</p>
                            </div>
                        </div>
                        {{-- Divider --}}
                        <div class="border-t border-blue-600 my-4"></div>
                        
                        <div class="flex flex-row">
                            <div class="mb-4 w-1/2">
                                <h3 class="text-lg font-semibold">Nama Klien:</h3>
                                <p>{{ $project->client_name }}</p>
                            </div>
                            <div class="mb-4 w-1/2">
                                <h3 class="text-lg font-semibold">Kontak Klien:</h3>
                                <p>{{ $project->client_contact ? $project->client_contact : 'Tidak Tersedia' }}</p>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
@endsection