@if ($material->approval_status === "diproses")
    <span class="badge p-2 rounded-lg bg-yellow-500 text-white font-bold">
        Diproses
    </span>
@elseif ($material->approval_status === "dipesan")
    <span class="badge p-2 rounded-lg bg-blue-500 text-white font-bold">
        Dipesan
    </span>
@elseif ($material->approval_status === "ditolak")
    <span class="badge p-2 rounded-lg bg-red-500 text-white font-bold">
        Ditolak
    </span>
@elseif ($material->approval_status === "diterima")
    <span class="badge p-2 rounded-lg bg-violet-500 text-white font-bold">
        Diterima
    </span>
@elseif ($material->approval_status === "disetujui")
    <span class="badge p-2 rounded-lg bg-green-500 text-white font-bold">
        Disetujui
    </span>
@endif