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
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'edit_note'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'edit_note', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'edit_note'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-pencil-simple-line"></i>
                    <span>Edit Catatan</span>
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
                                    <h3 class="text-lg font-semibold mb-2">Trouble</h3>
                                    <p class="text-md">{{ $report->trouble }}</p>
                                </div>
                            @else
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Trouble</h3>
                                    <p class="text-md text-gray-500">Tidak ada trouble yang ditambahkan.</p>
                                </div>
                            @endif

                            {{-- Tampilkan solution --}}
                            @if ($report->solution != null)
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Solution</h3>
                                    <p class="text-md">{{ $report->solution }}</p>
                                </div>
                            @else
                                <div class="flex flex-col my-3">
                                    <h3 class="text-lg font-semibold mb-2">Solution</h3>
                                    <p class="text-md text-gray-500">Tidak ada solusi yang ditambahkan.</p>
                                </div>
                            @endif

                            {{-- Tampilkan Dokumentasi --}}
                            <h3 class="text-lg font-semibold mb-2">Dokumentasi</h3>
                            <div x-data="{
                                currentSlide: 0,
                                slides: [
                                'https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp',
                                'https://img.daisyui.com/images/stock/photo-1559703248-dcaaec9fab78.webp',
                                'https://img.daisyui.com/images/stock/photo-1565098772267-60af42b81ef2.webp'
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
                                    class="w-full object-cover transition duration-500"
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
                        

                    </div>
                </div>
            </div>
        </div>
    </section>




    
@endsection