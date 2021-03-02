<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

  {{--  Halaman Style --}}
    @stack('preferend-style')
    @include('includes.style')
    @stack('addon-style')

  </head>

  <body>
    {{-- Halaman Navbar --}}
    @include('includes.navbar')

    {{-- Halaman Page COntent yang ada di di file home.blade.php --}}
    @yield('content')
  
    {{--  Halaman Footer --}}
    @include('includes.footer')

    {{-- Halaman Script --}}
    @stack('preferend-script')
    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
