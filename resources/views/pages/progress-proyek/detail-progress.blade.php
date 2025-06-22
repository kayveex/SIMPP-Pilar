{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Detail Catatan Progress - SIMPP Pillar Presisi
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
    <section class="flex flex-col p-6">
        {{-- Page Header --}}
        <header class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">List Catatan Progress</h1>
        </header>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="{{ route('progress-proyek.index') }}">Progress Proyek</a></li>
                <li class="text-[#4880FF]"><a href="{{ route('progress-proyek.view', $phase->project_id) }}">Daftar Fase Catatan Progress</a></li>
                <li>List Catatan Progress</li>
            </ul>
        </div>

        {{-- Content Section --}}
        <div x-data="{tab: 'notes'}" class="w-full bg-white shadow-md rounded-xl border border-gray-200" >
            {{-- Tab Headers --}}
            <div class="flex border-b border-gray-200 bg-[#F1F4F9] rounded-t-xl font-bold">
                <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'notes'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'notes', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'notes'}" class="px-4 py-2 focus:outline-none">
                    <i class="ph-bold ph-stack-simple"></i>
                    <span>List Catatan</span>
                </button>
                @if (Auth::user()->role === 'Super Admin' || Auth::user()->role === 'Divisi Teknikal')
                    <button class="flex px-3 py-2 flex-row gap-2 items-center" @click="tab = 'new_note'" :class="{'border-blue-500 text-blue-600 bg-white rounded-t-xl': tab === 'new_note', 'text-gray-500 bg-[#F1F4F9] cursor-pointer': tab !== 'new_note'}" class="px-4 py-2 focus:outline-none">
                        <i class="ph-bold ph-list-plus"></i>
                        <span>Tambah Catatan</span>
                    </button>
                @endif
            </div>

            {{-- Tab Content --}}
            <div class="p-4">
                <div x-show="tab === 'notes'" class="space-y-4">
                    <div class="flex flex-col p-4">
                        <h2 class="text-xl font-bold mb-4 border-b border-gray-200 pb-2">
                            List Catatan Pada Fase <a class="hover:text-blue-500 hover:underline" href="#">{{ $phase->phase_name }}</a>
                        </h2>
                        <p class="text-gray-600 text-md mb-2">
                            Catatan proyek tersimpan di dalam tiap fase proyek. 
                            Anda dapat melihat catatan-catatan tersebut dengan mengeklik tombol <i class="ph-bold mx-1.5 ph-eye text-blue-500"></i> pada salah satu catatan.
                        </p>
                        {{-- Divider border --}}

                        {{-- Notes Table --}}
                        <div class="overflow-x-auto bg-white rounded-lg border border-gray-300">
                            <table class="table w-full table-zebra">
                                <thead class="bg-gray-50 border-b text-center border-gray-200">
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul Laporan</th>
                                        <th>Jenis Laporan</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @if (isset($reports) && count($reports) > 0)
                                        @foreach ($reports as $index => $report)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $report->report_title }}</td>
                                                <td>
                                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                        {{ ucfirst($report->report_type) }}
                                                    </span>
                                                </td>
                                                <td>{{ $report->created_at->format('d M Y') }}</td>
                                                <td class="flex flex-row justify-center items-center gap-2">
                                                    <div class="flex flex-row gap-2 text-lg">
                                                        <a href="{{ route('progress-proyek.report.detail', $report->report_id) }}" class="py-2 text-blue-600 hover:text-blue-700 transition duration-200" title="Lihat/Edit Catatan">
                                                            <i class="ph-bold ph-eye"></i>
                                                        </a>
                                                    </div>
                                                    {{-- Delete Button --}}
                                                    <form action="{{ route('progress-proyek.report.delete', $report->report_id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-700 transition duration-200 cursor-pointer text-lg" title="Hapus Catatan">
                                                            <i class="ph-bold ph-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>  
                                        @endforeach
                                        
                                    @endif

                                </tbody>

                            </table>
                        </div>




                    </div>


                </div>
                <div x-show="tab === 'new_note'" class="space-y-4">
                    <div class="flex flex-col p-4">
                        <h2 class="text-xl font-bold mb-4 border-b border-gray-200 pb-2">
                            Tambah Catatan Baru
                        </h2>

                        <p class="text-gray-600 text-md mb-4">
                            Silakan isi form di bawah ini untuk menambahkan catatan baru pada fase <a class="hover:text-blue-500 hover:underline" href="#">{{ $phase->phase_name }}</a>.
                        </p>

                        {{-- Form to add new note --}}
                        <form action="{{ route('progress-proyek.report.store', $phase->phase_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="report_title" class="block text-sm font-medium text-gray-700 mb-2">Judul Catatan</label>
                                <input type="text" id="report_title" name="report_title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="report_type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Catatan</label>
                                <select id="report_type" name="report_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Jenis Catatan --</option>
                                    <option value="harian">Harian</option>
                                    <option value="mingguan">Mingguan</option>
                                    <option value="bulanan">Bulanan</option>
                                    <option value="kendala">Kendala</option>
                                    <option value="penyelesaian">Penyelesaian</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="activity" class="block text-sm font-medium text-gray-700 mb-2">Aktivitas</label>
                                <textarea id="activity" name="activity" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsikan aktivitas atau catatan Anda di sini..." ></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="trouble" class="block text-sm font-medium text-gray-700 mb-2">Kendala</label>
                                <textarea id="trouble" name="trouble" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsikan kendala yang dihadapi di sini..." ></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="solution" class="block text-sm font-medium text-gray-700 mb-2">Solusi</label>
                                <textarea id="solution" name="solution" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsikan solusi yang diambil di sini..."></textarea>
                            </div>

                            <div class="mb-4">
                                {{-- File upload --}}
                                <label for="report_files" class="block text-sm font-medium text-gray-700 mb-2">Unggah File</label>
                                <input type="file" id="report_files" name="report_files[]" multiple class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full
                                file:bg-gray-300 file:text-gray-800 file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" >
                            </div>

                            {{-- Button --}}
                            <div class="mb-4 flex flex-row justify-end">
                                <button type="submit" class="cursor-pointer items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Simpan
                                </button>
                            </div>

                        </form>

                        

                    </div>



                </div>
                
                
                
            </div>



        </div>



    </section>
@endsection