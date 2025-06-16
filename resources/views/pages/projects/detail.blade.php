{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Proyek - SIMPP Pillar Presisi
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
            <h1 class="text-2xl font-bold text-gray-800">Detail Proyek</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="/projects">Daftar Proyek</a></li>
                <li>Detail Proyek</li>
            </ul>
        </div>

        {{-- Content section --}}
        <div x-data="{ tab: 'detail' }" class="w-full bg-white shadow-md rounded-lg border border-gray-200">
            <!-- Tab headers -->
            <div class="tabs tabs-boxed w-full">
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF] underline underline-offset-6 decoration-2': tab === 'detail' }"
                    @click="tab = 'detail'"
                >
                    Detail Proyek
                </button>
                {{-- <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF] underline underline-offset-6 decoration-2': tab === 'persetujuan' }"
                    @click="tab = 'persetujuan'"
                >
                    Persetujuan
                </button> --}}
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF] underline underline-offset-6 decoration-2': tab === 'lampiran' }"
                    @click="tab = 'lampiran'"
                >
                    Lampiran File
                </button>
            </div>

            <!-- Tab content -->
            <div class="px-6 pt-2 pb-6 bg-base-100">
                <!-- Tab 1 -->
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
                                <p>{{ $project->project_type === 'onsite' ? 'On-site' : 'Bengkel' }}</p>
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

                <!-- Tab 2 -->
                {{-- <div x-show="tab === 'persetujuan'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-check-circle text-xl"></i>
                        <h2 class="text-lg font-bold">Persetujuan Proyek</h2>
                    </div>
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Persetujuan Direktur:</h3>
                            @if ($project->director_approval === true)
                                <p class="text-green-600">Disetujui</p>
                            @else
                                <p class="text-red-600">Belum Disetujui</p> 
                            @endif
                        </div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Persetujuan Divisi Teknikal:</h3>
                            @if ($project->technical_approval === true)
                                <p class="text-green-600">Disetujui</p>
                            @else
                                <p class="text-red-600">Belum Disetujui</p> 
                            @endif
                        </div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Persetujuan Divisi Purchasing:</h3>
                            @if ($project->purchasing_approval === true)
                                <p class="text-green-600">Disetujui</p>
                            @else
                                <p class="text-red-600">Belum Disetujui</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Persetujuan Divisi Keuangan:</h3>
                            @if ($project->finance_approval === true)
                                <p class="text-green-600">Disetujui</p>
                            @else
                                <p class="text-red-600">Belum Disetujui</p>
                            @endif
                        </div>
                    </div>
                </div> --}}

                <!-- Tab 3 -->
                <div x-show="tab === 'lampiran'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-file-text text-xl"></i>
                        <h2 class="text-lg font-bold">Lampiran File Proyek</h2>
                    </div>
                    {{-- Detail Content 3 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        {{-- Ambil dari Model ProjectDocument --}}
                        @if ($project->documents->isEmpty())
                            <p class="text-gray-500">Tidak ada lampiran file untuk proyek ini.</p>
                        
                        @else
                            <ul class="list-disc pl-5">
                                @foreach ($project->documents as $document)
                                    <li class="mb-2">
                                        <a href="{{ asset('storage/' . $document->file_path) }}" class="text-blue-600 hover:underline" target="_blank">
                                            {{ $document->document_name }} ({{ $document->created_at->format('d-m-Y') }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
@endsection