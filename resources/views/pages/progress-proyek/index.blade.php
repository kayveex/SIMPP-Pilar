{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Progress Proyek - SIMPP Pillar Presisi
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
            <h1 class="text-2xl font-bold text-gray-800">Progress Proyek</h1>
        </div>

        {{-- Bagian Filter Cards --}}
        <div class="flex flex-row w-full gap-4 bg-white shadow-sm rounded-lg p-4 mb-6 border-gray-200">
            {{-- Search Bar --}}
            <form class="flex flex-row w-1/3" action="{{ route('progress-proyek.index') }}" method="GET">
                <div class="relative flex-1 min-w-64">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-magnifying-glass text-xl text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari proyek..."
                        class="block w-full pl-12 pr-3 py-2 border text-md border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </form>

            {{-- Filter Controls --}}
            <form class="flex flex-row w-2/3 items-center gap-2" action="" method="GET">
                <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" type="submit">
                    <i class="ph-bold ph-funnel"></i>                    
                    <span class="ml-2">Filter</span>
                </button>
                {{-- Input Dropdown - Prioritas  --}}
                <select name="priority" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Prioritas</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                </select>

                {{-- Input Dropdown - Jenis Proyek --}}
                <select name="project_type" value="{{ request('project_type') }}" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Jenis Proyek</option>
                    <option value="onsite" {{ request('project_type') == 'onsite' ? 'selected' : '' }}>On-Site</option>
                    <option value="workshop" {{ request('project_type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                </select>

                {{-- Input Dropdown - Status --}}
                <select name="status" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">
                    <option value="">Status</option>
                    <option value="belum_dimulai" {{ request('status') == 'belum_dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                    <option value="berlangsung" {{ request('status') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="tertunda" {{ request('status') == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>


                {{-- Make reset button --}}
                <a href="{{ route('progress-proyek.index') }}" class="px-4 py-2 bg-white text-red-600 flex flex-row items-center cursor-pointer rounded-lg hover:bg-red-600 hover:text-white transition duration-200">
                    <i class="ph-bold ph-arrows-counter-clockwise"></i>
                    <span class="ml-2">Reset</span>
                </a>
            </form>
        </div>

        {{-- Bagian Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $index => $project)
                {{-- Card --}}
                <a href="{{ route('progress-proyek.view', $project->project_id) }}" class="flex flex-col bg-white shadow-sm hover:shadow-md hover:shadow-blue-300 rounded-lg p-4 border border-gray-200">
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-col w-3/4">
                            <h2 class="text-lg font-bold mb-2">{{ $project->project_name }}</h2>
                        </div>
                        <div class="flex flex-col w-1/4 items-end">
                            @include('layouts.atoms.jenis-project', ['project_type' => $project->project_type])
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-md font-semibold text-gray-600">
                            {{ $project->client_name }}
                        </p>
                    </div>
                    {{-- shadow div --}}
                    <div class="my-6">

                    </div>

                    <div class="flex flex-row justify-between items-center">
                        <span class="text-md text-gray-500">Periode:</span>
                        @include('layouts.atoms.badges-project-status', ['status' => $project->status])
                    </div>
                    <div class="flex flex-col font-semibold text-md text-gray-600">
                        <p> {{ $project->start_date->format('d M Y') }} -
                            <span class="text-red-500">
                                @if ($project->actual_end_date === null)
                                    {{ $project->estimated_end_date->format('d M Y') }} (Est.)
                                @elseif ($project->actual_end_date !== null)
                                    {{ $project->actual_end_date->format('d M Y') }}
                                @endif 
                            </span>
                        </p>
                    </div>

                    <div class="flex flex-col my-3">
                        <progress class="custom-progress progress w-full h-4 rounded-full" value="{{ $project->progress_percentage }}" max="100"></progress>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <span class="text-md">Progress</span>
                        <span class="text-md font-bold">{{ $project->progress_percentage }}%</span>
                    </div>
                </a>
            @endforeach
        </div>
        {{-- Info jumlah data + Pagination --}}
        <div class="flex justify-between items-center mt-4 px-2 py-2 text-sm text-gray-600">
            <div>
                Menampilkan
                <span class="font-semibold">{{ $projects->firstItem() }}</span>
                –
                <span class="font-semibold">{{ $projects->lastItem() }}</span>
                dari
                <span class="font-semibold">{{ $projects->total() }}</span>
                proyek
            </div>

            <div class="flex justify-end">
                {{ $projects->links('pagination::tailwind') }}
            </div>
        </div>

    </section>

@endsection