{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Pengajuan Material Proyek Baru - SIMPP Pillar Presisi
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

    <section class="flex flex-col px-6 pt-6">
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800"> Pengajuan Material Baru</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold">
            <ul>
                <li class="text-[#4880FF]"><a href="/material">Pengajuan Material</a></li>
                <li>Ajukan Material</li>
            </ul>
        </div>

        {{-- Submit form --}}
        <div class="flex flex-col p-6 bg-white rounded-lg shadow-md mt-4">
            <form action="" method="POST">
                @csrf
                <div class="mb-4 flex flex-row gap-4">
                    <div class="flex flex-col w-1/2">
                        <label for="project_id" class="text-sm font-semibold mb-2">Pengajuan Untuk Proyek</label>
                        <select id="project_id" name="project_id" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                            <option value="">-- Pilih Proyek --</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->project_id }}">{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col w-1/2">
                        <label for="client_name" class="text-sm font-semibold mb-2">Nama Klien</label>
                        <input type="text" id="client_name" name="client_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>



                    </div>


                </div>

                <div class="mb-4">
                    <label for="material_name" class="text-sm font-semibold mb-2">Judul Pengajuan Material</label>
                    <input type="text" id="material_name" name="material_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                </div>

                <div class="mb-4 flex flex-row justify-end">
                    <button type="submit" class="px-4 py-2 font-bold cursor-pointer rounded-lg bg-blue-600 hover:bg-blue-700 text-white">
                        Lanjutkan Pengajuan
                    </button>
                </div>

            </form>


        </div>
    </section>

@endsection