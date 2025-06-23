{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Buat Akun - SIMPP Pillar Presisi
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
    @include('layouts.molecules.topbar', compact('myNotif', 'countMyNotif'))
@endsection

{{-- Content --}}
@section('page-content')
    <section class="flex flex-col p-6">
        {{-- Page Header --}}
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Buat Akun</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('user.index') }}">Daftar Akun</a></li>
                <li>Buat Akun</li>
            </ul>
        </div>

        {{-- Form Section --}}
        <div class="flex flex-col p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Nama User</h3>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Email</h3>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Password (Min: 8)</h3>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                {{-- roles --}}
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Role</h3>
                    <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="Divisi Teknikal">Divisi Teknikal</option>
                        <option value="Divisi Purchasing">Divisi Purchasing</option>
                        <option value="Divisi Finance">Divisi Finance</option>
                        <option value="Divisi Admin">Divisi Admin</option>
                        <option value="Direktur">Direktur</option>
                        <option value="Super Admin">Super Admin</option>
                    </select>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Foto Profil</h3>
                    <input type="file" name="photo" accept="image/*" class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full
                    file:bg-gray-300 file:text-gray-800 file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" >
                </div>

                {{-- Submit --}}
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 cursor-pointer focus:ring-blue-500">Simpan</button>
                </div>
                
            
            </form>

        </div>




    </section>

    
@endsection
