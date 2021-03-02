@extends('layouts.dashboard')

@section('title')
    Dashboard - Detail Product
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
            <h2 class="dashboard-title">Shirup Marzan</h2>
            <p class="dashboard-subtitle">
                Product Details
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
                <form action="{{ route('detail-products-update', $products->id) }}" method="POST" enctype="multipart/form-data">
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
                                name="name"
                                id="name"
                                aria-describedby="name"
                                value="{{ $products->name }}"
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
                                value="{{ $products->price }}"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories_id">Kategori</label>
                                    <select name="categories_id" class="form-control">
                                        <option value="{{ $products->categories_id }}">Tidak diganti {{ $products->category->name }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="description">Description</label>
                            <textarea
                                name="description"
                                id=""
                                class="ckeditor form-control"
                            >
                                {!! $products->description !!}
                            </textarea>
                            </div>
                        </div>
                        <div class="col">
                            <button
                            type="submit"
                            class="btn btn-success btn-block px-5"
                            >
                            Update Product
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        @foreach ($products->gallery as $gallery)
                        <div class="col-md-4">
                        <div class="gallery-container">
                            <img
                            src="{{ Storage::url($gallery->photo ?? '') }}"
                            alt=""
                            class="w-100"
                            />
                            <a class="delete-gallery" href="{{ route('detail-products-gallery-delete', $gallery->id) }}" >
                            <img src="/images/icon-delete.svg" class="w-10" >
                            </a>
                        </div>
                        </div>
                        @endforeach
                        <div class="col-12">
                            <form action="{{ route('detail-products-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $products->id }}" name="product_id">
                                <input
                                type="file"
                                name="photo"
                                id="file"
                                style="display: none;"
                                multiple
                                onchange="form.submit()"
                                />
                                <button
                                type="button"
                                class="btn btn-secondary btn-block mt-3"
                                onclick="thisFileUpload()"
                                >
                                Add Photo
                                </button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
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
    <script>
        $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        function thisFileUpload() {
        document.getElementById("file").click();
        }
    </script>
@endpush