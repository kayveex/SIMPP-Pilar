{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

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
            <div class="flex border-b border-gray-200 bg-[#F1F4F9] rounded-t-xl">
                <button @click="tab = 'visual'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl font-bold': tab === 'visual', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'visual'}" class="px-4 py-2 font-semibold focus:outline-none">Visualisasi Jadwal</button>
                <button @click="tab = 'table'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl font-bold': tab === 'table', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'table'}" class="px-4 py-2 font-semibold focus:outline-none">Daftar Tabel</button>
                <button @click="tab = 'new_schedule'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl font-bold': tab === 'new_schedule', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'new_schedule'}" class="px-4 py-2 font-semibold focus:outline-none">Tambah Jadwal</button>
            </div>

            {{-- Tab content --}}
            <div class="p-4">
                <div x-show="tab === 'visual'" class="space-y-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-2">Visualisasi Jadwal</h2>
                    <p>Visualisasi jadwal proyek akan ditampilkan di sini.</p>
                    {{-- Placeholder for visual content --}}
                </div>

                <div x-show="tab === 'table'" class="space-y-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-2">Tabel Jadwal</h2>
                    <p>Tabel jadwal proyek akan ditampilkan di sini.</p>
                    {{-- Placeholder for table content --}}
                </div>

                <div x-show="tab === 'new_schedule'" class="space-y-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <h2 class="text-xl font-bold mb-2">Tambah Jadwal</h2>

                </div>
        </div>

    </section>

@endsection