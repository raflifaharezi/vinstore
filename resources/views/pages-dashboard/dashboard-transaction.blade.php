@extends('layouts.dashboard')

@section('title')
    Dashboard - Transaction
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
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">
                    Big result start from the small one
                </p>
                </div>
                <div class="dashboard-content">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <a
                        class="nav-link active"
                        id="sell-tab"
                        data-toggle="tab"
                        href="#sell"
                        role="tab"
                        aria-controls="sell"
                        aria-selected="true"
                        >Sell Product</a
                    >
                    </li>
                    <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="buy-tab"
                        data-toggle="tab"
                        href="#buy"
                        role="tab"
                        aria-controls="buy"
                        aria-selected="false"
                        >Buy Product</a
                    >
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div
                    class="tab-pane fade show active"
                    id="sell"
                    role="tabpanel"
                    aria-labelledby="sell-tab"
                    >
                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                        @foreach ($SellTransaction as $transaction)
                            <a
                            class="card card-list d-block"
                            href="{{ route('dashboard-transaction-detail', $transaction->id) }}"
                        >
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                <img
                                    src="{{ Storage::url($transaction->product->gallery->first()->photo ?? '') }}"
                                    class="w-50"
                                />
                                </div>
                                <div class="col-md-4">
                                {{ $transaction->product->name }}
                                </div>
                                <div class="col-md-3">
                                {{ $transaction->product->user->store_name }}
                                </div>
                                <div class="col-md-3">
                                {{ $transaction->created_ad }}
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
                    <div
                    class="tab-pane fade"
                    id="buy"
                    role="tabpanel"
                    aria-labelledby="buy-tab"
                    >
                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                        @foreach ($BuyTransaction as $transaction)
                            <a
                            class="card card-list d-block"
                            href="{{ route('dashboard-transaction-detail', $transaction->id) }}"
                        >
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                <img
                                    src="{{ Storage::url($transaction->product->gallery->first()->photo ?? '') }}"
                                    class="w-50"
                                />
                                </div>
                                <div class="col-md-4">
                                {{ $transaction->product->name }}
                                </div>
                                <div class="col-md-3">
                                {{ $transaction->product->user->store_name }}
                                </div>
                                <div class="col-md-3">
                                {{ $transaction->created_at }}
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
            </div>
    </div>
@endsection