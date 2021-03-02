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
    @include('includes-dashboard.style')
    @stack('addon-style')
</head>

<body>
<div class="page-dashboard">
    <div class="d-flex" id="wrapper" data-aos="fade-right">

{{-- Halaman Sidebar --}}
    @include('includes-dashboard.sidebar')

{{-- Halaman Page Content --}}
    @yield('content')

    </div>
</div>
{{-- Halaman Script --}}
    @stack('preferend-script')
    @include('includes-dashboard.script')
    @stack('addon-script')
</body>
</html>
