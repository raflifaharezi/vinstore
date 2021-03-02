@extends('layouts.dashboard')

@section('title')
    Dashboard - Product
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
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" 
                        style="display: none;">
                        @csrf
                    </form>
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
            <h2 class="dashboard-title">My Products</h2>
            <p class="dashboard-subtitle">
                Manage it well and get money
            </p>
            </div>
            <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                <a
                    href="{{ route('dashboard-product-create') }}"
                    class="btn btn-success"
                    >Add New Product</a
                >
                </div>
            </div>
            <div class="row mt-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a
                    class="card card-dashboard-product d-block"
                    href="{{ route('detail-products', $product->id )}}"
                >
                    <div class="card-body">
                    <img
                        src="{{ Storage::url($product->gallery->first()->photo ?? '') }}"
                        alt=""
                        class="w-50 mb-2"
                    />
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product-category">{{ $product->category->name }}</div>
                    </div>
                </a>
                </div>
            @endforeach 
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection