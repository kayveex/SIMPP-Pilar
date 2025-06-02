<nav class="hidden md:flex lg:flex flex-col pb-6 pt-2 px-4 h-screen w-[300px] border-r-[1.5px] border-[#DBDADA]">
    <div class="flex flex-col justify-center items-center">
        <img src="{{ asset('assets/img/loginpillar.png') }}" alt="Logo" class="w-[100px]">
    </div>
    <section class="flex flex-col mt-4 px-4">
        {{-- Home Tab --}}
        <div class="mt-2 flex-col">
            <label for="home" class="font-bold">HOME</label>
            <a href="/" class="flex flex-row items-center text-lg font-semibold gap-2 hover:text-[#3D42DF]">
                <i class="ph-fill ph-squares-four"></i>
                <span>Dashboard</span>
            </a>
        </div>

        {{-- Proyek Tab --}}
        <div class="mt-4 flex-col">
            <label for="proyek" class="font-bold">PROYEK</label>
            <a href="/projects" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 hover:text-[#3D42DF]">
                <i class="ph-bold ph-article"></i>
                <span>Daftar Proyek</span>
            </a>
            <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 hover:text-[#3D42DF]">
                <i class="ph-bold ph-calendar-blank"></i>
                <span>Jadwal</span>
            </a>
            <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 hover:text-[#3D42DF]">
                <i class="ph-bold ph-circle-notch"></i>
                <span>Progress Proyek</span>
            </a>
            <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 hover:text-[#3D42DF]">
                <i class="ph-bold ph-user-check"></i>
                <span>Persetujuan Klien</span>
            </a>
        </div>

        {{-- Material Tab --}}
        <div class="mt-4 flex-col">
            <label for="material" class="font-bold">MATERIAL</label>
            <a href="/material" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 hover:text-[#3D42DF]">
                <i class="ph-bold ph-check-square-offset"></i>
                <span>Pengajuan Material</span>
            </a>
            <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 hover:text-[#3D42DF]">
                <i class="ph-fill ph-align-left"></i>
                <span>Status Material</span>
            </a>
        </div>

        {{-- Keuangan Tab --}}
        <div class="mt-4 flex-col">
            <label for="keuangan" class="font-bold">KEUANGAN</label>
            <a href="#" class="flex flex-row items-center text-lg font-semibold gap-2 hover:text-[#3D42DF]">
                <i class="ph-bold ph-coins"></i>
                <span>Anggaran Proyek</span>
            </a>
        </div>

        {{-- Arsip --}}
        <div class="mt-4 flex-col">
            <label for="arsip" class="font-bold">ARSIP</label>
            <a href="#" class="flex flex-row items-center text-lg font-semibold gap-2 hover:text-[#3D42DF]">
                <i class="ph-bold ph-box-arrow-down"></i>
                <span>Arsip Proyek</span>
            </a>
        </div>
    </section>

</nav>