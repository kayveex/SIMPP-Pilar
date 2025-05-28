
@if ($project->status === 'belum_dimulai')
    <span class="badge p-2 rounded-lg bg-gray-500 text-white font-bold">Belum Dimulai</span>
@elseif ($project->status === 'berlangsung')
    <span class="badge p-2 rounded-lg bg-yellow-500 text-white font-bold">Berlangsung</span>
@elseif ($project->status === 'tertunda')
    <span class="badge p-2 rounded-lg bg-orange-500 text-white font-bold">Tertunda</span>
@elseif ($project->status === 'selesai')
    <span class="badge p-2 rounded-lg bg-green-500 text-white font-bold">Selesai</span>
@elseif ($project->status === 'dibatalkan')
    <span class="badge p-2 rounded-lg bg-red-500 text-white font-bold">Dibatalkan</span>
@endif


