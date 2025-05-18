{{-- This is for small alert, like form checking, etc --}}

{{-- Validator --}}
@if ($errors->any())
    <section class="flex flex-col w-full bg-red-600/20 text-red-600 border-2 border-red-600 rounded-md p-2 mb-4">
        <div class="flex flex-row items-center gap-2 text-xl">
            <i class="ph-fill ph-siren"></i>
            <h1 class="font-bold">Error!</h1>
        </div>
        <ul class="list-disc list-inside pl-5 space-y-1 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </section>
@endif