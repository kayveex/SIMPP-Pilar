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
            <h1 class="text-2xl font-bold text-gray-800">Edit Akun</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('user.index') }}">Daftar Akun</a></li>
                <li>Edit Akun</li>
            </ul>
        </div>

    {{-- Form Edit Section --}}
    <div class="flex flex-col p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') 
            
            {{-- Nama --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Nama User</h3>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Email</h3>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            {{-- Password opsional --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Password (Biarkan kosong jika tidak diubah, Min: 8)</h3>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Role --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Role</h3>
                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled>Pilih Role</option>
                    @foreach (['Divisi Teknikal', 'Divisi Purchasing', 'Divisi Finance', 'Divisi Admin', 'Direktur', 'Super Admin'] as $role)
                        <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Foto Profil --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Foto Profil</h3>
                <input type="file" name="photo" accept="image/*"
                    class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full
                    file:bg-gray-300 file:text-gray-800 file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer">
                
                @if ($user->photo)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 mb-1">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="w-24 h-24 object-cover rounded-md border border-gray-300">
                    </div>
                @endif
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 cursor-pointer focus:ring-blue-500">Perbarui</button>
            </div>
        </form>
    </div>



    </section>
@endsection
