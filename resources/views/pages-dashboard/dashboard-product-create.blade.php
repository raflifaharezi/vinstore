@extends('layouts.dashboard')

@section('title')
    Dashboard - Product Create
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
                <h2 class="dashboard-title">Add New Product</h2>
                <p class="dashboard-subtitle">
                    Create your own product
                </p>
                </div>
                <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>    
                    @endif
                    <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="name">Product Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    aria-describedby="name"
                                    name="name"
                                />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="price">Price</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="price"
                                    aria-describedby="price"
                                    name="price"
                                />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="description">Description</label>
                                <textarea
                                    name="description"
                                    id=""
                                    cols="30"
                                    rows="4"
                                    class="ckeditor form-control"
                                >
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categories_id">Kategori</label>
                                    <select name="categories_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="photo">Thumbnails</label>
                                <input
                                    type="file"
                                    multiple
                                    class="form-control pt-1"
                                    id="thumbnails"
                                    aria-describedby="thumbnails"
                                    name="photo"
                                />
                                <small class="text-muted">
                                    Kamu dapat memilih lebih dari satu file
                                </small>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="row mt-2">
                        <div class="col text-right">
                            <button
                            type="submit"
                            class="btn btn-success px-5"
                            >
                            Save Now
                            </button>
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
@push('addon-script')
    <script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endpush