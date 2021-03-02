@extends('layouts.dashboard')

@section('title')
    Dashboard - Setting
@endsection

@section('content')
    <div id="page-content-wrapper">
            <nav
            class="navbar navbar-store navbar-expand-lg navbar-light fixed-top"
            data-aos="fade-down"
            >
            <button
                class="btn btn-secondary d-md-none mr-auto mr-2"
                id="menu-toggle"
            >
                &laquo; Menu
            </button>

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto d-none d-lg-flex">
                <li class="nav-item dropdown">
                    <a
                    class="nav-link"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <img
                        src="/images/icon-user.png"
                        alt=""
                        class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('/') }}"
                        >Back to Store</a
                    >
                    <a class="dropdown-item" href="{{ route('dashboard-account') }}"
                        >Settings</a
                    >
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                Logout
                    </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-inline-block mt-2" href="#">
                    <img src="/images/icon-cart-empty.svg" alt="" />
                    </a>
                </li>
                </ul>
                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item dropdown">
                    <a
                        class="nav-link"
                        href="#"
                        id="navbarDropdown"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <img
                        src="/images/icon-user.png"
                        alt=""
                        class="rounded-circle mr-2 profile-picture"
                        />
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home') }}">Bact to Store</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('dashboard-account') }}"
                        >Settings</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                Logout
                        </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" 
                        style="display: none;">
                        @csrf
                    </form>
                    </div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link d-inline-block" href="#">
                        @php
                        // memanggil model cart yang tidak ada di controller Cart
                        /* where('user_id', Auth::user()->id->count()) untuk melihat jumlah 
                        cart iconnya kondisi harus login tedahulu
                        */
                        $carts =\App\Cart::where('user_id', Auth::user()->id)->count();
                        @endphp
                        @if ($carts > 0)
                            <img src="/images/icon-cart-filled.svg" alt="" />
                            <div class="cart-badge">{{ $carts }}</div>
                        @else()
                        <img src="/images/icon-cart-empty.svg" alt="" />
                        @endif
                    </a>
                    </li>
                </ul>
            </div>
            </nav>

            <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
            >
            <div class="container-fluid">
                <div class="dashboard-heading">
                <h2 class="dashboard-title">Store Settings</h2>
                <p class="dashboard-subtitle">
                    Make store that profitable
                </p>
                </div>
                <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                    <form action="{{ route('dashboard-redirect', 'dashboard-setting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="store_name">Store Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="store_name"
                                    name="store_name"
                                    value="{{ $user->store_name }}"
                                />
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="categories_id">Category</label>
                                <select
                                    name="categories_id"
                                    id="categories_id"
                                    class="form-control"
                                >
                                <option value="{{ $user->categories_id }}">Tidak diganti</option>
                                @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                </select>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="is_store_open">Store Status</label>
                                <p class="text-muted">
                                    Apakah saat ini toko Anda buka?
                                </p>
                                <div
                                    class="custom-control custom-radio custom-control-inline"
                                >
                                    <input
                                    class="custom-control-input"
                                    type="radio"
                                    name="store_status"
                                    id="openStoreTrue"
                                    value="1"
                                    {{-- jika status toko  bernilai 1 atau tokonya terbuka maka akan terceklis otomatis --}}
                                    {{ $user->store_status == 1 ? 'checked' :'' }}
                                    checked
                                    />
                                    <label
                                    class="custom-control-label"
                                    for="openStoreTrue"
                                    >Buka</label
                                    >
                                </div>
                                <div
                                    class="custom-control custom-radio custom-control-inline"
                                >
                                    <input
                                    class="custom-control-input"
                                    type="radio"
                                    name="store_status"
                                    id="openStoreFalse"
                                    value="0"
                                    {{-- jika status toko bernilai 0 atau tokonya tertutup maka akan terceklis otomatis --}}
                                    {{ $user->store_status == 0 || $user->store_status == NULL ?  'checked' :'' }}
                                    />
                                    <label
                                    makasih
                                    class="custom-control-label"
                                    for="openStoreFalse"
                                    >Tutup Sementara</label
                                    >
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col text-right">
                                <button
                                type="submit"
                                class="btn btn-success px-5"
                                >
                                Save Now
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
    </div>
@endsection