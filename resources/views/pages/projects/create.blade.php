{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    SIMPP Pillar Presisi - Proyek Baru
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

{{-- Page content --}}
@section('page-content')
    <section class="flex flex-col p-6">

        <div id="box-item" class="flex flex-col w-full h-fit p-6 bg-[#FFFFFF] rounded-lg shadow-md">

            <form class="flex flex-col" action="" method="post">
                @csrf
                {{-- Form Baris #1 --}}
                <div class="flex flex-row">
                    {{-- Nama Proyek --}}
                    <div class="flex flex-col w-1/2">
                        <label for="project_name" class="text-sm font-bold text-gray-700 mb-2">Nama Proyek</label>
                        <input type="text" id="project_name" name="project_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                    {{-- Nama klien --}}
                    <div class="flex flex-col w-1/2 ml-4">
                        <label for="client_name" class="text-sm font-bold text-gray-700 mb-2">Nama Klien</label>
                        <input type="text" id="client_name" name="client_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                </div>
                {{-- Form Baris #2 --}}
                <div class="flex flex-row">
                    {{-- Tanggal Mulai --}}
                    <div class="flex flex-col w-1/2 mt-4">
                        <label for="start_date" class="text-sm font-bold text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                    <span class="flex flex-col items-center justify-center text-2xl"> - </span>
                    {{-- Tanggal Selesai --}}
                    <div class="flex flex-col w-1/2 ml-4 mt-4">
                        <label for="end_date" class="text-sm font-bold text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                    </div>
                </div>

            </form>

        </div>

    </section>
    
@endsection

{{-- Script for JS --}}
@section('scripts')
    
@endsection

