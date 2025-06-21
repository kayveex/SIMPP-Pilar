{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Edit Profil - SIMPP Pillar Presisi
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
        {{-- Page header --}}
        <div class="flex flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Profil Saya</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('home') }}">Dashboard</a></li>
                <li>Edit Profil Saya</li>
            </ul>
        </div>

        {{-- Content --}}
        <div x-data="{tab: 'tab1'}" class="w-full bg-white shadow-md rounded-xl border border-gray-200" >
            {{-- Tab Header --}}
            <div class="flex border-b border-gray-200 bg-[#F1F4F9] rounded-t-xl font-bold">
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'tab1'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'tab1', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'tab1'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-user-gear"></i>
                    <span>Edit Data Profil</span>
                </button>
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'tab2'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'tab2', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'tab2'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-password"></i>
                    <span>Edit Password</span>
                </button>
            </div>

            {{-- Tab Content --}}
            <div class="p-6">
                <div x-show="tab === 'tab1'" class="mt-4">
                    <div class="flex flex-col p-4" >

                    </div>       
                </div>
                <div x-show="tab === 'tab2'" class="mt-4">
                    <div class="flex flex-col p-4" >

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection