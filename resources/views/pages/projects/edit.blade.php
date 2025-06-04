{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}

@extends('layouts.master')

{{-- Page Title --}}
@section('page_title')
    Edit Proyek - SIMPP Pillar Presisi
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
        <div class="flex flex-row items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Edit Proyek</h1>
        </div>

        {{-- Breadcrumb --}}
        <div class="breadcrumbs text-md font-bold mb-4">
            <ul>
                <li class="text-[#4880FF]"><a href="/projects">Daftar Proyek</a></li>
                <li>Edit Proyek</li>
            </ul>
        </div>

        {{-- Content section --}}
        <div x-data="{ tab: 'detail' }" class="w-full bg-white shadow-md rounded-lg border border-gray-200">
            <!-- Tab headers -->
            <div class="tabs tabs-boxed w-full">
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'detail' }"
                    @click="tab = 'detail'"
                >
                    Detail Proyek
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'persetujuan' }"
                    @click="tab = 'persetujuan'"
                >
                    Persetujuan
                </button>
                <button
                    class="tab border-2 font-bold text-lg"
                    :class="{ 'tab-active text-[#4880FF]': tab === 'lampiran' }"
                    @click="tab = 'lampiran'"
                >
                    Lampiran File
                </button>
            </div>

            <!-- Tab content -->
            <div class="p-6 bg-base-100">
                <!-- Tab 1 -->
                <div x-show="tab === 'detail'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-paperclip text-xl"></i>
                        <h2 class="text-lg font-bold">Edit Form Detail Proyek</h2>
                    </div>

                    {{-- Edit Konten 1 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <form action="{{ route('projects.update.detail', $project->project_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Nama Proyek</h3>
                                <input type="text" id="project_name" name="project_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->project_name }}" required>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Lokasi Proyek</h3>
                                <input type="text" id="location" name="location" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->location }}" required>
                            </div>

                            {{-- 3 baris --}}
                            <div class="flex flex-row gap-4 mb-4">
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Penanggungjawab</h3>
                                    <input type="text" id="person_in_charge" name="person_in_charge" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->person_in_charge }}" required>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Jenis Proyek</h3>
                                    <select id="project_type" name="project_type" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                        <option value="onsite" {{ $project->project_type === 'onsite' ? 'selected' : '' }}>On-site</option>
                                        <option value="bengkel" {{ $project->project_type === 'bengkel' ? 'selected' : '' }}>Bengkel</option>
                                    </select>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Status</h3>
                                    <select id="status" name="status" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>
                                        <option value="belum_dimulai" {{ $project->status === 'belum_dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                                        <option value="berlangsung" {{ $project->status === 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                        <option value="tertunda" {{ $project->status === 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                                        <option value="selesai" {{ $project->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dibatalkan" {{ $project->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">Keterangan Proyek</h3>
                                <textarea id="description" name="description" rows="4" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" required>{{ $project->description }}</textarea>
                            </div>

                            <div class="flex flex-row gap-4 mb-4">
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Mulai</h3>
                                    <input type="date" id="start_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" name="start_date" value="{{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}" required>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Selesai (Perkiraan)</h3>
                                    <input type="date" id="estimated_end_date" name="estimated_end_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ \Carbon\Carbon::parse($project->estimated_end_date)->format('Y-m-d') }}" required>
                                </div>
                                <div class="mb-4 w-1/3">
                                    <h3 class="text-lg font-semibold mb-2">Tanggal Selesai (Realisasi)</h3>
                                    <input type="date" id="actual_end_date" name="actual_end_date" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ optional($project->actual_end_date)->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="border-t border-gray-300 my-4"></div>

                            {{-- Edit client_name, client_contact --}}
                            <div class="flex flex-row gap-4 mb-4">
                                <div class="mb-4 w-1/2">
                                    <h3 class="text-lg font-semibold mb-2">Nama Klien</h3>
                                    <input type="text" id="client_name" name="client_name" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->client_name }}" required>
                                </div>
                                <div class="mb-4 w-1/2">
                                    <h3 class="text-lg font-semibold mb-2">Kontak Klien</h3>
                                    <input type="text" id="client_contact" name="client_contact" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" value="{{ $project->client_contact }}">
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 font-bold cursor-pointer rounded-lg bg-blue-600 hover:bg-blue-700 text-white">Simpan Perubahan</button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Tab 2 -->
                <div x-show="tab === 'persetujuan'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-check-circle text-xl"></i>
                        <h2 class="text-lg font-bold">Persetujuan Proyek</h2>
                    </div>

                    {{-- Edit Konten 2 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        
                        {{-- Persetujuan Divisi Teknikal --}}

                            @if (Auth::user()->role === 'Divisi Teknikal' && $project->technical_approval === false)
                                <h3 class="text-lg font-semibold">Berikan Persetujuan Sebagai Perwakilan {{ Auth::user()->role }} ? </h3>
                                <form action="{{ route('project.approval', $project->project_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-4 py-2 my-2 font-bold cursor-pointer rounded-lg bg-green-600 hover:bg-green-700 text-white">Setujui Proyek</button>
                                </form>
                            @elseif (Auth::user()->role === 'Divisi Teknikal' && $project->technical_approval === true)
                                <p class="font-semibold">Proyek telah disetujui oleh Divisi Teknikal. Batalkan persetujuan?</p>
                                <form action="{{ route('project.approval.delete', $project->project_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-4 py-2 my-2 font-bold cursor-pointer rounded-lg bg-red-600 hover:bg-red-700 text-white">Batalkan Persetujuan</button>
                                </form>
                            @endif

                        {{-- Persetujuan Divisi Finance --}}


                        {{-- Persetujuan Divisi Purchasing --}}


                        {{-- Persetujuan Direktur --}}

  

                    </div>

                </div>

                <!-- Tab 3 -->
                <div x-show="tab === 'lampiran'" x-transition>
                    <div class="flex gap-2 items-center bg-blue-600 text-white w-fit px-4 py-2 rounded-t-lg rounded-tr-lg">
                        <i class="ph-bold ph-file-text text-xl"></i>
                        <h2 class="text-lg font-bold">Lampiran File Proyek</h2>
                    </div>

                    {{-- Edit Konten 3 --}}
                    <div class="flex flex-col border-2 border-blue-600 rounded-bl-lg rounded-tr-lg rounded-br-lg p-4">
                        <ul class="list-disc pl-5">
                            @foreach ($projectDocuments as $doc)
                                <li class="mb-2">
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" class="text-blue-600 hover:underline" target="_blank">
                                        {{ $doc->document_name }}
                                    </a>
                                    <span class="text-gray-500 text-sm">({{ $doc->created_at->format('d M Y') }})</span>

                                    <form action="{{ route('projectDocs.delete', $doc->document_id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Lampiran" class="text-white bg-red-600 hover:bg-red-700 px-2 py-1 cursor-pointer rounded-lg text-sm">
                                            <i class="ph-bold ph-x"></i>
                                        </button>
                                    </form>
                                </li> 
                            @endforeach
                            @if ($projectDocuments->isEmpty())
                                <li class="text-gray-500">Tidak ada lampiran file untuk proyek ini.</li>
                            @endif

                            <div x-data="{ showModal: false }">
                                <button @click="showModal = true" class="py-2 px-4 mt-2 text-white rounded-lg bg-blue-500 hover:bg-blue-600 transition duration-200 cursor-pointer" title="Tambah Lampiran">
                                    <i class="ph-bold ph-upload-simple"></i>
                                    <span>Tambahkan Lampiran</span>
                                </button>

                                {{-- Modal --}}
                                <div x-show="showModal" x-cloak class="fixed inset-0 z-30 flex items-center justify-center backdrop-blur-sm bg-black/30">
                                    <div @click.away="showModal = false" class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
                                        <h3 class="text-lg font-semibold mb-4">Tambahkan Lampiran Baru</h3>
                                        <form action="{{ route('projectDocs.upload', $project->project_id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input 
                                                type="file" 
                                                id="attachments" 
                                                name="attachments[]" 
                                                multiple 
                                                class="file-input file-input-bordered border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full
                                                    file:bg-gray-300 file:text-gray-800 file:border-none file:rounded file:px-4 file:py-2 file:cursor-pointer" 
                                            />
                                            <div class="flex justify-end gap-4 mt-4">
                                                <a @click="showModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">Batal</a>
                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white cursor-pointer rounded hover:bg-blue-700 transition">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </section>



@endsection
