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
                    <div class="flex flex-row p-4" >
                        <div class="flex flex-col w-1/2 items-center">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://placehold.co/300x300' }}" alt="Foto Profil" class="w-32 h-32 rounded-full mb-4">
                            <h2 class="text-xl font-semibold mb-2">{{ Auth::user()->name }}</h2>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="flex flex-col w-1/2 items-center">
                            <form class="w-full" action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold mb-2">Nama User</h3>
                                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold mb-2">Email</h3>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                {{-- upload foto 'photo' --}}
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold mb-2">Foto Profil</h3>
                                    <input type="file" name="photo" accept="image/*" class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full
                                    file:bg-gray-300 file:text-gray-800 file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" >
                                </div>
                                {{-- Submit  --}}
                                <div class="flex justify-end">
                                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 cursor-pointer focus:ring-blue-500">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>       
                </div>
                <div x-show="tab === 'tab2'" class="mt-4">
                    <div class="flex flex-col p-4" >
                        <form action="{{ route('user.profile.update.password', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Password Baru</h3>
                                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Konfirmasi Password Baru</h3>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 cursor-pointer focus:ring-blue-500">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection