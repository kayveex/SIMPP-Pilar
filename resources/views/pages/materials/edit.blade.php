{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Pengajuan Material - SIMPP Pillar Presisi
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
    <section class="flex flex-col px-6 py-6">
        {{-- Title --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Edit Material</h1>
        </div>

        {{-- Breadcrumbs --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="/material">Pengajuan Material</a></li>
                <li>Edit Proyek</li>
            </ul>
        </div>

        {{-- Content Section - Form --}}
        <div x-data="{ tab: 'detail' }" class="w-full bg-white shadow-md rounded-lg border border-gray-200">
            {{-- Tab headers --}}
            <div class="tabs tabs-boxed w-full">
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'detail' }"
                    @click="tab = 'detail'"
                >
                    Edit Material
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'detail' }"
                    @click="tab = 'table'"
                >
                    Edit List Item
                </button>
            </div>

            {{-- Tab content --}}
            <div class="p-6 bg-base-100">
                {{-- Tab 1 --}}
                <div x-show="tab === 'detail'" xtransition>
                    {{-- Fill content here --}}

                </div>

                {{-- Tab 2 --}}
                <div x-show="tab === 'table'" xtransition>
                    {{-- Fill content here --}}

                </div>
            </div>

        </div>




    </section>
    
@endsection