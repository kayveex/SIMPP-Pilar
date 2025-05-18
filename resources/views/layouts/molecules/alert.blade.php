{{-- This is for small alert, like form checking, etc --}}

{{-- Success Indicator --}}
@if (session('success'))
    <div class="">
        {{ session('success') }}
    </div>
@endif

{{-- Validator --}}
@if ($errors->any())
    <div class="">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif