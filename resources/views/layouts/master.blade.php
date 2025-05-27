<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>SIMPP - Pilar Presisi</title> --}}
    <title>@yield('page_title')</title>
    {{-- Import vite --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    {{-- Import Icons --}}
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2/src/bold/style.css"
    />
    {{-- Import Font - Nunito Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

    {{-- Import AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Import anything --}}
    @stack('styles-head')
</head>
<body>
    <div class="flex flex-row" id="wrapper">

        {{-- Sidebar --}}
        @yield('sidebar')
        {{-- End of sidebar --}}

        <div class="flex flex-col w-full h-screen" id="content-wrapper">
            {{-- Topbar --}}
            @yield('topbar')
            {{-- End of topbar --}}

            {{-- Main Content --}}
            <section class="flex flex-col bg-[#F1F4F9] w-full h-full overflow-y-auto">
                {{-- Page Content --}}
                @yield('page-content')
            </section>

        </div>

        {{-- Footer --}}

        {{-- End of footer --}}
    </div>

    {{-- Import Scripts --}}
    @yield('scripts')
</body>
</html>