{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Daftar Users - SIMPP Pillar Presisi
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
    <section class="flex flex-col px-6 pt-6">
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Users</h1>
            <a href="{{ route('user.create') }}" class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="ph-bold ph-plus"></i>
                <span class="ml-2">Tambah Akun</span>
            </a>
        </div>

        {{-- Filtering Feature --}}
        <div class="flex flex-row w-full gap-4 bg-white shadow-sm rounded-lg p-4 mb-6 border-gray-200">
            {{-- Search bar --}}
            <form class="flex flex-row w-1/3" action="" method="GET">
                <div class="relative flex-1 min-w-64">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph-bold ph-magnifying-glass text-xl text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user..."
                        class="block w-full pl-12 pr-3 py-2 border text-md border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </form>

            {{-- Filter Control --}}
            <form class="flex flex-row w-2/3 items-center gap-2" action="" method="GET">
                <button class="px-4 py-2 bg-blue-600 flex flex-row items-center cursor-pointer text-white rounded-lg hover:bg-blue-700 transition duration-200" type="submit">
                    <i class="ph-bold ph-funnel"></i>                    
                    <span class="ml-2">Filter</span>
                </button>
                {{-- Input Dropdown - Berdasarkan Divisi --}}
                <select name="role" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                    <option disabled value="">Pilih Role</option>
                    <option value="Divisi Teknikal" {{ request('role') == 'Divisi Teknikal' ? 'selected' : '' }}>Divisi Teknikal</option>
                    <option value="Divisi Purchasing" {{ request('role') == 'Divisi Purchasing' ? 'selected' : '' }}>Divisi Purchasing</option>
                    <option value="Divisi Finance" {{ request('role') == 'Divisi Finance' ? 'selected' : '' }}>Divisi Finance</option>
                    <option value="Divisi Admin" {{ request('role') == 'Divisi Admin' ? 'selected' : '' }}>Divisi Admin</option>
                    <option value="Direktur" {{ request('role') == 'Direktur' ? 'selected' : '' }}>Direktur</option>
                    <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
                {{-- Make reset button --}}
                <a href="{{ route('user.index') }}" class="px-4 py-2 bg-white text-red-600 flex flex-row items-center cursor-pointer rounded-lg hover:bg-red-600 hover:text-white transition duration-200">
                    <i class="ph-bold ph-arrows-counter-clockwise"></i>
                    <span class="ml-2">Reset</span>
                </a>
            </form>
        </div>

        {{-- Users Table --}}
        <div class="overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200">
            <table class="table w-full table-zebra">
                {{-- Table Header --}}
                <thead class="bg-gray-50 border-b text-center border-gray-200">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                {{-- Table Body --}}
                <tbody class="text-center">
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="text-lg">
                                <a title="Edit Akun" href="" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="ph-bold ph-pencil-simple-line"></i>
                                </a>
                                <form action="" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Hapus Akun" type="submit" class="text-red-500 hover:text-red-600 cursor-pointer">
                                        <i class="ph-bold ph-trash-simple"></i>   
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-gray-500">Tidak ada data user ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Info jumlah data + pagination --}}
            <div class="flex justify-between items-center mt-4 px-4 py-2 text-sm text-gray-600">
                <div>
                    Menampilkan
                    <span class="font-semibold">{{ $users->firstItem() }}</span>
                    –
                    <span class="font-semibold">{{ $users->lastItem() }}</span>
                    dari
                    <span class="font-semibold">{{ $users->total() }}</span>
                    proyek
                </div>

                <div class="flex justify-end">
                    {{ $users->links('pagination::tailwind') }}
                </div>
            </div>
        </div>




        
    </section>
    
@endsection