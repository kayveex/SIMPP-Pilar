<nav class="hidden md:flex lg:flex flex-col pb-6 pt-2 px-4 h-screen w-[300px] border-r-[1.5px] border-[#DBDADA]">
    <div class="flex flex-col justify-center items-center">
        <img src="{{ asset('assets/img/loginpillar.png') }}" alt="Logo" class="w-[100px]">
    </div>
    <section class="flex flex-col mt-4 px-4">
        {{-- Home Tab --}}
        <div class="mt-2 flex-col">
            <label for="home" class="font-bold">HOME</label>
            <a href="{{ route('home') }}"
                class="flex flex-row items-center text-lg font-semibold gap-2 {{ request()->is('home') ? 'text-[#3D42DF]' : 'hover:text-[#3D42DF]' }}">
                <i class="ph-fill ph-squares-four"></i>
                <span>Dashboard</span>
            </a>
        </div>

        {{-- Proyek Tab --}}
        @if (Auth::user()->role === 'Super Admin' || Auth::user()->role === 'Divisi Teknikal' || Auth::user()->role === 'Direktur')
            <div class="mt-4 flex-col">
                <label for="proyek" class="font-bold">PROYEK</label>
                <a href="{{ route('projects.index') }}"
                    class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 {{ request()->is('projects*') ? 'text-[#3D42DF]' : 'hover:text-[#3D42DF]' }}">
                    <i class="ph-bold ph-article"></i>
                    <span>Daftar Proyek</span>
                </a>
                <a href="{{ route('schedules.index') }}"
                    class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 {{ request()->is('schedules*') ? 'text-[#3D42DF]' : 'hover:text-[#3D42DF]' }}">
                    <i class="ph-bold ph-calendar-blank"></i>
                    <span>Jadwal</span>
                </a>
                <a href="{{ route('progress-proyek.index') }}"
                    class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 {{ request()->is('progress-proyek*') ? 'text-[#3D42DF]' : 'hover:text-[#3D42DF]' }}">
                    <i class="ph-bold ph-circle-notch"></i>
                    <span>Progress Proyek</span>
                </a>
            </div>
        @endif

        {{-- Material Tab --}}
        @if (Auth::user()->role === 'Super Admin' || Auth::user()->role === 'Divisi Teknikal' || Auth::user()->role === 'Direktur' || Auth::user()->role === 'Divisi Purchasing')
            <div class="mt-4 flex-col">
                <label for="material" class="font-bold">MATERIAL</label>
                <a href="{{ route('material.index') }}"
                    class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 {{ request()->is('material*') ? 'text-[#3D42DF]' : 'hover:text-[#3D42DF]' }}">
                    <i class="ph-bold ph-check-square-offset"></i>
                    <span>Pengajuan & Status</span>
                </a>
            </div>
        @endif

        {{-- Keuangan Tab --}}
        @if (Auth::user()->role === 'Super Admin' || Auth::user()->role === 'Divisi Finance' || Auth::user()->role === 'Direktur')
            <div class="mt-4 flex-col">
                <label for="keuangan" class="font-bold">KEUANGAN</label>
                <a href="{{ route('anggaran-proyek.index') }}"
                    class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 {{ request()->is('anggaran-proyek*') ? 'text-[#3D42DF]' : 'hover:text-[#3D42DF]' }}">
                    <i class="ph-bold ph-coins"></i>
                    <span>Anggaran Proyek</span>
                </a>
            </div>
        @endif

        {{-- Arsip --}}
        <div class="mt-4 flex-col">
            <label for="arsip" class="font-bold">ARSIP</label>
            <a href="{{ route('arsip-proyek.index') }}"
                class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 {{ request()->is('arsip-proyek*') ? 'text-[#3D42DF]' : 'hover:text-[#3D42DF]' }}">
                <i class="ph-bold ph-box-arrow-down"></i>
                <span>Arsip Proyek</span>
            </a>
        </div>
    </section>
</nav>
