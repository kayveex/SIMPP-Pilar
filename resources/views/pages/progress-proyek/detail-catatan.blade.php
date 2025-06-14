{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Catatan Proyek - SIMPP Pillar Presisi
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
            <h1 class="text-2xl font-bold text-gray-800">Detail Catatan Proyek</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('progress-proyek.index') }}">Progress Proyek</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('progress-proyek.view', $report->phase->project_id) }}">Daftar Fase Catatan Progress</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('progress-proyek.report', $report->phase->phase_id) }}">List Catatan Progress</a></li>
                <li>Detail Catatan Proyek</li>
            </ul>
        </div>

        {{-- Content Section --}}
        <div x-data="{tab: 'notes'}" class="w-full bg-white shadow-md rounded-xl border border-gray-200" >
            {{-- Tab header --}}
            <div class="flex border-b border-gray-200 bg-[#F1F4F9] rounded-t-xl font-bold">
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'notes'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'notes', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'notes'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-article"></i>
                    <span>Detail Catatan</span>
                </button>
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'edit_notes'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'edit_notes', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'edit_notes'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-pencil-simple-line"></i>
                    <span>Edit Catatan</span>
                </button>
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'edit_doc'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'edit_doc', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'edit_doc'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-camera-plus"></i>
                    <span>Edit Dokumentasi</span>
                </button>
            </div>

            {{-- Tab content --}}
            <div class="p-4">
                <div x-show="tab === 'notes'" class="space-y-4">
                    <div class="flex flex-col p-4" >
                        <h2 class="text-xl font-bold mb-4 border-b border-gray-200 pb-2">
                            {{ $report->report_title }}
                        </h2>
                        <div class="flex flex-col my-3">
                            <progress class="custom-progress progress w-full h-4 rounded-full" value="{{ $report->phase->project->progress_percentage }}" max="100"></progress>
                            {{-- Tampilkan persentase proses --}}
                            <div class="flex flex-row justify-between my-2 items-center">
                                <span class="text-md">Progress {{ $report->phase->project->project_name }}</span>
                                <span class="text-md font-bold">{{ $report->phase->project->progress_percentage }}%</span>
                            </div>

                            {{-- Tampilkan Activity --}}
                            @if ($report->activity != null)
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Aktivitas</h3>
                                    <p class="text-md">{{ $report->activity }}</p>
                                </div>
                            @else
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Aktivitas</h3>
                                    <p class="text-md text-gray-500">Tidak ada aktivitas yang ditambahkan.</p>
                                </div>  
                            @endif

                            {{-- Tampilkan trouble --}}
                            @if ($report->trouble != null)
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Kendala</h3>
                                    <p class="text-md">{{ $report->trouble }}</p>
                                </div>
                            @else
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Kendala</h3>
                                    <p class="text-md text-gray-500">Tidak ada trouble yang ditambahkan.</p>
                                </div>
                            @endif

                            {{-- Tampilkan solution --}}
                            @if ($report->solution != null)
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Solusi</h3>
                                    <p class="text-md">{{ $report->solution }}</p>
                                </div>
                            @else
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Solusi</h3>
                                    <p class="text-md text-gray-500">Tidak ada solusi yang ditambahkan.</p>
                                </div>
                            @endif

                            {{-- Tampilkan Dokumentasi --}}
                            <h3 class="text-lg font-semibold mb-2">Dokumentasi</h3>
                            <div x-data="{
                                currentSlide: 0,
                                slides: [
                                    @foreach ($report->files as $file)
                                        '{{ asset('storage/' . $file->file_path) }}',
                                    @endforeach
                                ]
                            }" 
                            class="flex items-center justify-center space-x-4 max-w-4xl mx-auto"
                            >

                            <!-- Tombol kiri -->
                            <button 
                                @click="currentSlide = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1"
                                class="bg-blue-500 text-white p-3 rounded-full hover:bg-blue-600 transition"
                            >
                                <i class="ph-bold ph-caret-left"></i>
                            </button>

                            <!-- Gambar -->
                            <div class="w-full max-w-2xl overflow-hidden rounded-lg shadow-lg">
                                <template x-for="(slide, index) in slides" :key="index">
                                    <img 
                                        :src="slide" 
                                        x-show="currentSlide === index" 
                                        class="w-full object-cover transition duration-500 rounded-lg]"
                                        x-transition
                                    />

                                    
                                </template>
                            </div>

                            <!-- Tombol kanan -->
                            <button 
                                @click="currentSlide = (currentSlide === slides.length - 1) ? 0 : currentSlide + 1"
                                class="bg-blue-500 text-white p-3 rounded-full hover:bg-blue-600 transition"
                            >
                                <i class="ph-bold ph-caret-right"></i>
                            </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="tab === 'edit_notes'" class="space-y-4">
                    <div class="flex flex-col p-4" >
                        <h2 class="text-xl font-bold mb-4 border-b border-gray-200 pb-2">Edit Catatan</h2>
                        <form class="flex flex-col" method="POST" action="{{ route('progress-proyek.report.update', $report->report_id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label for="report_title" class="block text-md font-bold text-gray-800 my-2">Judul Catatan <span class="text-red-500">*</span></label>
                                <input type="text" id="report_title" name="report_title" value="{{ old('report_title', $report->report_title) }}" 
                                class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                            </div>
                            <div class="mb-4">
                                <label for="activity" class="block text-md font-bold text-gray-800 my-2">Aktivitas</label>
                                <textarea id="activity" name="activity" rows="3" 
                                class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">{{ old('activity', $report->activity) }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="trouble" class="block text-md font-bold text-gray-800 my-2">Kendala</label>
                                <textarea id="trouble" name="trouble" rows="3" 
                                class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">{{ old('trouble', $report->trouble) }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="solution" class="block text-md font-bold text-gray-800 my-2">Solusi</label>
                                <textarea id="solution" name="solution" rows="3" 
                                class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">{{ old('solution', $report->solution) }}</textarea>
                            </div>
                            <div class="my-2 flex flex-row justify-end">
                                <button type="submit" class="bg-blue-500 text-white font-bold cursor-pointer px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div x-show="tab === 'edit_doc'" class="space-y-4">
                    <div class="flex flex-col p-4" >
                        <h2 class="text-xl font-bold mb-4 border-b border-gray-200 pb-2">Edit Dokumentasi</h2>
                        <p class="text-md mb-2">Dokumentasi yang sudah diupload:</p>                            
                        <ul class="list-disc pl-5">
                        @foreach ($report->files as $file)
                            <li class="text-md mb-2">
                                <span>{{ $file->file_name }}</span>
                                <a href="{{ asset('storage/' . $file->file_path) }}" class="text-white bg-green-600 hover:bg-green-700 px-2 py-1 cursor-pointer rounded-lg text-sm"  target="_blank" title="Unduh Dokumentasi" download>
                                    <i class="ph-bold ph-download-simple"></i>
                                </a>

                                <form action="{{ route('progress-proyek.report.files.delete', $file->report_file_id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Lampiran" class="text-white bg-red-600 hover:bg-red-700 px-2 py-1 cursor-pointer rounded-lg text-sm">
                                        <i class="ph-bold ph-x"></i>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                        </ul>

                        {{-- Modals Upload Dokum baru --}}
                        <div x-data="{ showModal: false }">
                            <button @click="showModal = true" class="py-2 px-4 mt-2  rounded-lg border-2 font-bold bg-blue-500 text-white hover:bg-blue-600 transition duration-200 cursor-pointer" title="Tambah Lampiran">
                                <i class="ph-bold ph-upload-simple"></i>
                                <span>Tambahkan Dokumentasi</span>
                            </button>

                            {{-- Modals --}}
                            <div x-show="showModal" x-cloak class="fixed inset-0 z-30 flex items-center justify-center backdrop-blur-sm bg-black/30">
                                <div @click.away="showModal = false" class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
                                    <h3 class="text-lg font-semibold mb-4">Tambahkan Dokumentasi Baru</h3>
                                    <form action="{{ route('progress-proyek.report.upload', $report->report_id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input 
                                            type="file" 
                                            id="report_files" 
                                            name="report_files[]" 
                                            multiple 
                                            class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full
                                                file:bg-gray-300 file:text-gray-800 file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" 
                                        />
                                        <div class="flex justify-end gap-4 mt-4">
                                            <a @click="showModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">Batal</a>
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white cursor-pointer rounded hover:bg-blue-700 transition">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    
@endsection