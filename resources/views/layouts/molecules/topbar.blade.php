<nav class="flex flex-row py-2 px-6 h-[75px] w-full relative z-10 shadow-lg items-center justify-end">
    {{-- Left side --}}
    <div class="flex flex-row w-1/2">
        {{-- Mobile Drawer --}}
        <div class="drawer md:hidden lg:hidden">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <!-- Page content here -->
                <label for="my-drawer" class="btn btn-ghost border-none bg-none text-xl text-[#3D42DF] drawer-button">
                    <i class="ph-bold ph-list"></i>
                </label>
            </div>
            <div class="drawer-side">
                <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="menu bg-[#3D42DF] text-slate-50 min-h-full w-80 p-4">
                    <!-- Sidebar content here -->
                    <div class="mt-2 flex-col">
                        <label for="home" class="font-bold">HOME</label>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold gap-2">
                            <i class="ph-fill ph-squares-four"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>

                    {{-- Proyek Tab --}}
                    <div class="mt-4 flex-col">
                        <label for="home" class="font-bold">PROYEK</label>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 ">
                            <i class="ph-bold ph-article"></i>
                            <span>Detail Proyek</span>
                        </a>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 ">
                            <i class="ph-bold ph-calendar-blank"></i>
                            <span>Jadwal</span>
                        </a>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 ">
                            <i class="ph-bold ph-circle-notch"></i>
                            <span>Progress Proyek</span>
                        </a>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 ">
                            <i class="ph-bold ph-user-check"></i>
                            <span>Persetujuan Klien</span>
                        </a>
                    </div>

                    {{-- Material Tab --}}
                    <div class="mt-4 flex-col">
                        <label for="home" class="font-bold">MATERIAL</label>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold mt-2 gap-2 ">
                            <i class="ph-bold ph-check-square-offset"></i>
                            <span>Pengajuan & Status</span>
                        </a>

                    </div>

                    {{-- Keuangan Tab --}}
                    <div class="mt-4 flex-col">
                        <label for="home" class="font-bold">KEUANGAN</label>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold gap-2 ">
                            <i class="ph-bold ph-coins"></i>
                            <span>Anggaran Proyek</span>
                        </a>
                    </div>

                    {{-- Arsip --}}
                    <div class="mt-4 flex-col">
                        <label for="home" class="font-bold">ARSIP</label>
                        <a href="#" class="flex flex-row items-center text-lg font-semibold gap-2 ">
                            <i class="ph-bold ph-box-arrow-down"></i>
                            <span>Arsip Proyek</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Right side  --}}
    <div class="flex flex-row w-1/2 h-fit items-center justify-end">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="avatar btn border-none bg-none hover:bg-[#3D42DF]/20 rounded-lg py-6 w-full flex flex-row items-center gap-3 hover:cursor-pointer">
                <div class="w-10 rounded-full flex flex-col items-center justify-center border-2 border-[#3D42DF] hover:cursor-pointer">
                    <img alt="Profile Avatar" src="https://placehold.co/300x300" />
                </div>
                <h3 class="text-[12px] font-semibold text-start">{{ Str::limit(Auth::user()->name, 16) }} <br/><p class="text-xs font-normal text-gray-500 text-start">{{ Auth::user()->role }}</p></h3>
                {{-- Custom Icons --}}
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 0.900391C15.0258 0.900391 19.0996 4.97421 19.0996 10C19.0996 15.0258 15.0258 19.0996 10 19.0996C4.97421 19.0996 0.900391 15.0258 0.900391 10C0.900391 4.97421 4.97421 0.900391 10 0.900391Z" stroke="#5C5C5C" stroke-width="0.2"/>
                    <path d="M10 10.7929L7.73162 8.14645C7.56425 7.95118 7.29289 7.95118 7.12553 8.14645C6.95816 8.34171 6.95816 8.65829 7.12553 8.85355L9.69695 11.8536C9.86432 12.0488 10.1357 12.0488 10.303 11.8536L12.8745 8.85355C13.0418 8.65829 13.0418 8.34171 12.8745 8.14645C12.7071 7.95118 12.4358 7.95118 12.2684 8.14645L10 10.7929Z" fill="#565656"/>
                    <mask id="mask0_20_385" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="7" y="8" width="6" height="4">
                    <path d="M10 10.7929L7.73162 8.14645C7.56425 7.95118 7.29289 7.95118 7.12553 8.14645C6.95816 8.34171 6.95816 8.65829 7.12553 8.85355L9.69695 11.8536C9.86432 12.0488 10.1357 12.0488 10.303 11.8536L12.8745 8.85355C13.0418 8.65829 13.0418 8.34171 12.8745 8.14645C12.7071 7.95118 12.4358 7.95118 12.2684 8.14645L10 10.7929Z" fill="white"/>
                    </mask>
                    <g mask="url(#mask0_20_385)">
                    </g>
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-[#FFFFFF] rounded-box rounded-lg z-1 mt-3 w-52 p-2 shadow">
                <li class="hover:bg-[#3D42DF]/30 hover:border-1 hover:border-[#3D42DF] hover:cursor-pointer rounded-lg flex flex-row items-center">
                    <i class="ph-bold ph-user-gear"></i>
                    <a class="font-bold" href="">Pengaturan</a>
                </li>
                <li class="hover:bg-[#3D42DF]/30 hover:border-1 text-red-700 hover:border-[#3D42DF] hover:cursor-pointer rounded-lg flex flex-row items-center">
                    <i class="ph-fill ph-sign-out"></i>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="font-bold hover:cursor-pointer">Sign Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>