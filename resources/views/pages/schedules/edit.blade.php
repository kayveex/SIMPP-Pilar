{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Edit Proyek - SIMPP Pillar Presisi
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
        {{-- Page header --}}
        <div class="flex flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Fase Jadwal</h1>
        </div>
        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('schedules.index') }}">Jadwal Proyek</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('schedules.view', $phase->project->project_id) }}">Detail Jadwal Proyek</a></li>
                <li>Edit Fase Jadwal</li>
            </ul>
        </div>

        {{-- Content Section --}}
        <div class="overflow-x-auto bg-white flex flex-col shadow-sm rounded-lg border p-6 border-gray-200">
            <form action="{{ route('schedules.phase.update', $phase->phase_id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="phase_name" class="block text-sm font-medium text-gray-700 my-2">Nama Fase</label>
                    <input type="text" id="phase_name" name="phase_name" value="{{ old('phase_name', $phase->phase_name) }}" 
                    class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="estimated_start_date" class="block text-sm font-medium text-gray-700 my-2">Tanggal Mulai (Rencana)</label>
                    <input type="date" id="estimated_start_date" name="estimated_start_date" value="{{ old('estimated_start_date', $phase->estimated_start_date ? $phase->estimated_start_date->format('Y-m-d') : '') }}"
                    class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="estimated_end_date" class="block text-sm font-medium text-gray-700 my-2">Tanggal Selesai (Rencana)</label>
                    <input type="date" id="estimated_end_date" name="estimated_end_date" value="{{ old('estimated_end_date', $phase->estimated_end_date ? $phase->estimated_end_date->format('Y-m-d') : '') }}"
                    class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="actual_start_date" class="block text-sm font-medium text-gray-700 my-2">Tanggal Mulai (Realisasi)</label>
                    <input type="date" id="actual_start_date" name="actual_start_date" value="{{ old('actual_start_date', $phase->actual_start_date ? $phase->actual_start_date->format('Y-m-d') : '') }}"      
                    class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                </div>
                <div class="mb-4">
                    <label for="actual_end_date" class="block text-sm font-medium text-gray-700 my-2">Tanggal Selesai (Realisasi)</label>
                    <input type="date" id="actual_end_date" name="actual_end_date" value="{{ old('actual_end_date', $phase->actual_end_date ? $phase->actual_end_date->format('Y-m-d') : '') }}"
                    class="border border-gray-300 text-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">

                <div class="my-2 flex flex-row justify-end">
                    <button type="submit" class="bg-blue-500 text-white font-bold cursor-pointer px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Simpan</button>
                </div>
            </form>
        </div>
    </section>
    
@endsection