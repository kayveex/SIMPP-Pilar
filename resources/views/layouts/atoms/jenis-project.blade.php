@if ($project->project_type === 'onsite')
    <span class="badge p-2 rounded-lg bg-blue-500 text-white font-bold">On-Site</span>
@elseif ($project->project_type === 'bengkel')
    <span class="badge p-2 rounded-lg border-2 border-blue-500 text-blue-500 font-bold">Bengkel</span>
@endif