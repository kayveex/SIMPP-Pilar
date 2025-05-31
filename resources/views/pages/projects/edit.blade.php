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

{{-- Content --}}
@section('page-content')
    <section class="flex flex-col p-6">
        {{-- Page Header --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Edit Proyek</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="/projects">Daftar Proyek</a></li>
                <li>Edit Proyek</li>
            </ul>
        </div>

        {{-- Content section --}}
        <div x-data="{ tab: 'detail' }" class="w-full bg-white shadow-md rounded-lg border border-gray-200">
            <!-- Tab headers -->
            <div class="tabs tabs-boxed w-full">
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'detail' }"
                    @click="tab = 'detail'"
                >
                    Detail Proyek
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'persetujuan' }"
                    @click="tab = 'persetujuan'"
                >
                    Persetujuan
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'lampiran' }"
                    @click="tab = 'lampiran'"
                >
                    Lampiran File
                </button>
            </div>

            <!-- Tab content -->
            <div class="p-6 bg-base-100">
                <!-- Tab 1 -->
                <div x-show="tab === 'detail'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-paperclip text-xl"></i>
                        <h2 class="text-lg font-bold">Edit Form Detail Proyek</h2>
                    </div>

                    {{-- Edit Konten 1 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Nama Proyek</h3>
                                <input type="text" id="project_name" name="project_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->project_name }}" required>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Lokasi Proyek</h3>
                                <input type="text" id="location" name="location" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->location }}" required>
                            </div>

                            {{-- 3 baris --}}
                            <div class="flex flex-row gap-4 mb-4">
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Penanggungjawab</h3>
                                    <input type="text" id="person_in_charge" name="person_in_charge" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->person_in_charge }}" required>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Jenis Proyek</h3>
                                    <select id="project_type" name="project_type" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                        <option value="onsite" {{ $project->project_type === 'onsite' ? 'selected' : '' }}>On-site</option>
                                        <option value="bengkel" {{ $project->project_type === 'bengkel' ? 'selected' : '' }}>Bengkel</option>
                                    </select>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Status</h3>
                                    <select id="status" name="status" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                        <option value="belum_dimulai" {{ $project->status === 'belum_dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                                        <option value="berlangsung" {{ $project->status === 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                        <option value="tertunda" {{ $project->status === 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                                        <option value="selesai" {{ $project->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dibatalkan" {{ $project->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Keterangan Proyek</h3>
                                <textarea id="description" name="description" rows="4" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>{{ $project->description }}</textarea>
                            </div>

                            <div class="flex flex-row gap-4 mb-4">
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Mulai</h3>
                                    <input type="date" id="start_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" name="start_date" value="{{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}" required>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Selesai (Perkiraan)</h3>
                                    <input type="date" id="estimated_end_date" name="estimated_end_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ \Carbon\Carbon::parse($project->estimated_end_date)->format('Y-m-d') }}" required>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Selesai (Realisasi)</h3>
                                    <input type="date" id="actual_end_date" name="actual_end_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ optional($project->actual_end_date)->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="border-t border-gray-300 my-4"></div>

                            {{-- Edit client_name, client_contact --}}
                            <div class="flex flex-row gap-4 mb-4">
                                <div class="mb-4 w-1/2">
                                    <h3 class="text-lg font-semibold mb-2">Nama Klien</h3>
                                    <input type="text" id="client_name" name="client_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->client_name }}" required>
                                </div>
                                <div class="mb-4 w-1/2">
                                    <h3 class="text-lg font-semibold mb-2">Kontak Klien</h3>
                                    <input type="text" id="client_contact" name="client_contact" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->client_contact }}">
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 font-bold cursor-pointer rounded-lg bg-blue-600 hover:bg-blue-700 text-white">Simpan Perubahan</button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Tab 2 -->
                <div x-show="tab === 'persetujuan'" x-transition>
                    <p>Konten persetujuan di sini...</p>
                </div>

                <!-- Tab 3 -->
                <div x-show="tab === 'lampiran'" x-transition>
                    <p>Konten lampiran file di sini...</p>
                </div>
            </div>
        </div>


    </section>



@endsection
