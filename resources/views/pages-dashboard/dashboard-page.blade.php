@extends('layouts.dashboard')

@section('title')
    Dashboard - Page
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
            <h2 class="dashboard-title">Dashboard</h2>
            <p class="dashboard-subtitle">
                Look what you have made today!
            </p>
            </div>
            <div class="dashboard-content">
            <div class="row">
                <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-body">
                    <div class="dashboard-card-title">
                        Customer
                    </div>
                    <div class="dashboard-card-subtitle">
                        {{ number_format($customer) }}
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-body">
                    <div class="dashboard-card-title">
                        Revenue
                    </div>
                    <div class="dashboard-card-subtitle">
                Rp.{{ number_format($revenue) }}
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-body">
                    <div class="dashboard-card-title">
                        Transaction
                    </div>
                    <div class="dashboard-card-subtitle">
                        {{ number_format($transaction_count) }}
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mt-2">
                <h5 class="mb-3">Recent Transactions</h5>
                @foreach ($transaction_data as $transaction)
                    <a
                    class="card card-list d-block"
                    href="{{ route('dashboard-transaction-detail', $transaction->id) }}"
                >
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                        <img
                            src="{{ Storage::url($transaction->product->gallery->first()->photo ?? '') }}"
                            class="w-75"
                        />
                        </div>
                        <div class="col-md-4">
                        {{ $transaction->product->name ?? ''}}
                        </div>
                        <div class="col-md-3">
                        {{ $transaction->transation->user->name ??''}}
                        </div>
                        <div class="col-md-3">
                        {{ $transaction->created_at ?? '' }}
                        </div>
                        <div class="col-md-1 d-none d-md-block">
                        <img
                            src="/images/dashboard-arrow-right.svg"
                            alt=""
                        />
                        </div>
                    </div>
                    </div>
                </a>
                @endforeach
                
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection