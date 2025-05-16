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
    {{-- Import Font - Nunito Sans --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    {{-- Import anything --}}
    @stack('styles-head')
</head>
<body>
    <div id="wrapper">

        {{-- Sidebar --}}
        @yield('sidebar')
        {{-- End of sidebar --}}

        <div id="content-wrapper">
            <div id="content">
                {{-- Topbar --}}
                @yield('topbar')
                {{-- End of topbar --}}

                {{-- Main Content --}}
                @yield('page-content')

            </div>
        </div>

        {{-- Footer --}}

        {{-- End of footer --}}
    </div>

    {{-- Import Scripts --}}
    @yield('scripts')
</body>
</html>