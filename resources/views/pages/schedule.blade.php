{{-- Use This Template If You Wanna Make A Page With Dashboard Section --}}
@extends('layouts.master')
{{-- Page Title --}} @section('page_title') Jadwal Rencana - SIMPP Pillar Presisi @endsection
{{-- Head - Styles --}} @section('styles-head')
<style>
    .calendar-day {
        transition: all 0.2s ease;
    }
    .calendar-day:hover {
        background-color: #f3f4f6;
    }
    .selected-day {
        background-color: #3b82f6 !important;
        color: white !important;
    }
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
@endsection
{{-- Sidebar --}} @section('sidebar') @include('layouts.molecules.sidebar') @endsection
{{-- Topbar --}} @section('topbar') @include('layouts.molecules.topbar') @endsection
{{-- Page content --}} @section('page-content')
<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Jadwal</h1>
        <div class="text-sm text-gray-600">
            <span>Dashboard</span>
            <span class="mx-2">/</span>
            <span class="text-blue-600">Jadwal</span>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-sm border">
        <!-- Card Header with Action Buttons -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Rencana Jadwal</h2>
                <div class="flex space-x-3">
                    <button onclick="openModal('polosan')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Polosan
                    </button>
                    <button onclick="openModal('belum-ada')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                        Belum di apa-apain
                    </button>
                    <button onclick="openModal('tambah')" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
                        TAMBAH
                    </button>
                </div>
            </div>
            
            <!-- Schedule Info -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-yellow-400 rounded-full mr-3"></div>
                    <div>
                        <div class="font-medium text-gray-800">Rencana Jadwal</div>
                        <div class="text-sm text-gray-600">Jadwal Pemeriksaan</div>
                        <div class="text-xs text-gray-500 mt-1">27 November 2024</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- May 2025 Calendar -->
                {{-- 
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Mei 2025</h3>
                        <div class="flex space-x-2">
                            <button class="p-1 hover:bg-gray-100 rounded">
                                <i class="ph ph-caret-left text-gray-600" style="font-size: 20px;"></i>
                            </button>
                            <button class="p-1 hover:bg-gray-100 rounded">
                                <i class="ph ph-caret-right text-gray-600" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Min</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Sen</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Sel</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Rab</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Kam</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Jum</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Sab</div>
                    </div>
                    
                    <div class="grid grid-cols-7 gap-1">
                        <!-- Empty cells for days before month starts -->
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <!-- May days -->
                        @for($day = 1; $day <= 31; $day++)
                            <div class="calendar-day text-center py-2 text-sm cursor-pointer rounded hover:bg-gray-100 
                                {{ $day == 15 ? 'selected-day' : '' }}">
                                {{ $day }}
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- June 2025 Calendar -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Juni 2025</h3>
                        <div class="flex space-x-2">
                            <button class="p-1 hover:bg-gray-100 rounded">
                                <i class="ph ph-caret-left text-gray-600" style="font-size: 20px;"></i>
                            </button>
                            <button class="p-1 hover:bg-gray-100 rounded">
                                <i class="ph ph-caret-right text-gray-600" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Min</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Sen</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Sel</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Rab</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Kam</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Jum</div>
                        <div class="text-center text-sm font-medium text-gray-500 py-2">Sab</div>
                    </div>
                    
                    <div class="grid grid-cols-7 gap-1">
                        <!-- June days -->
                        @for($day = 1; $day <= 30; $day++)
                            <div class="calendar-day text-center py-2 text-sm cursor-pointer rounded hover:bg-gray-100">
                                {{ $day }}
                            </div>
                        @endfor
                    </div>
                </div>
                --}}
                
                <!-- Placeholder for commented out calendar -->
                <div class="p-6 bg-gray-100 rounded-lg">
                    <p class="text-gray-600 text-center">Calendar display is currently disabled.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Actions -->
<div id="actionModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-backdrop fixed inset-0" onclick="closeModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-800 mb-4">Rencana Jadwal</h3>
                <p id="modalDescription" class="text-gray-600 mb-6">Apakah Anda yakin ingin mengubah rencana jadwal?</p>
                
                <div class="flex space-x-3 justify-end">
                    <button onclick="closeModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button onclick="confirmAction()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <div class="modal-backdrop fixed inset-0" onclick="closeEditModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tetapkan Perubahan?</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengubah Rencana Jadwal?</p>
                
                <div class="flex space-x-3 justify-end">
                    <button onclick="closeEditModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button onclick="confirmEdit()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- Script for JS --}} @section('scripts')
<script>
    let currentAction = '';

    function openModal(action) {
        currentAction = action;
        const modal = document.getElementById('actionModal');
        const title = document.getElementById('modalTitle');
        const description = document.getElementById('modalDescription');
        
        switch(action) {
            case 'polosan':
                title.textContent = 'Rencana Jadwal - Polosan';
                description.textContent = 'Apakah Anda yakin ingin mengubah rencana jadwal ke mode polosan?';
                break;
            case 'belum-ada':
                title.textContent = 'Rencana Jadwal - Belum di apa-apain';
                description.textContent = 'Apakah Anda yakin ingin mengubah rencana jadwal ke status belum di apa-apain?';
                break;
            case 'tambah':
                title.textContent = 'Tambah Rencana Jadwal';
                description.textContent = 'Apakah Anda yakin ingin menambah rencana jadwal baru?';
                break;
        }
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('actionModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentAction = '';
    }

    function confirmAction() {
        // Here you can add the actual action logic
        console.log('Confirmed action:', currentAction);
        
        // Show success message or redirect
        alert('Perubahan berhasil disimpan!');
        closeModal();
        
        // You can add AJAX call here to save to database
        // Example:
        // fetch('/api/jadwal-rencana', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     },
        //     body: JSON.stringify({
        //         action: currentAction,
        //         date: getSelectedDate()
        //     })
        // });
    }

    function openEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function confirmEdit() {
        // Handle edit confirmation
        console.log('Edit confirmed');
        alert('Perubahan berhasil disimpan!');
        closeEditModal();
    }

    // Calendar day selection
    document.addEventListener('DOMContentLoaded', function() {
        const calendarDays = document.querySelectorAll('.calendar-day');
        
        calendarDays.forEach(day => {
            day.addEventListener('click', function() {
                // Remove previous selection
                calendarDays.forEach(d => d.classList.remove('selected-day'));
                
                // Add selection to clicked day
                this.classList.add('selected-day');
                
                // You can add logic here to handle date selection
                console.log('Selected date:', this.textContent);
            });
        });
    });

    function getSelectedDate() {
        const selectedDay = document.querySelector('.selected-day');
        return selectedDay ? selectedDay.textContent : null;
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('actionModal');
        const editModal = document.getElementById('editModal');
        
        if (event.target === modal) {
            closeModal();
        }
        if (event.target === editModal) {
            closeEditModal();
        }
    });

    // Handle escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
            closeEditModal();
        }
    });
</script>
@endsection