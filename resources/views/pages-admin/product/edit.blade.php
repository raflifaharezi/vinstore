@extends('layouts.admin')

@section('title')
    Dashboard-Admin - Page
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
                Hi, Admin {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
            </ul>
            <!-- Mobile Menu -->
            <ul class="navbar-nav d-block d-lg-none mt-3">
            <li class="nav-item">
                <a class="nav-link" href="#">
                Hi, Admin {{ Auth::user()->name }}
                </a>
                <a class="nav-link" href="/">Logout</a>
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
            <h2 class="dashboard-title">Dashboard-Admin</h2>
            <p class="dashboard-subtitle">
                Create New User
            </p>
            </div>
            <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>    
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('product.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nama Produk</label>
                                            <input type="text" name="name" class="form-control" 
                                                    value="{{ $item->name }}" placeholder="Nama User" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user_id">User</label>
                                            <select name="user_id" class="form-control">
                                                    <option value="{{ $item->user_id }}" selected>{{ $item->user->name }}</option>
                                                <option value="" disabled>----------------</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categories_id">Kategori</label>
                                            <select name="categories_id" class="form-control">
                                                    <option value="{{ $item->categories_id }}" selected>{{ $item->category->name }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="price">Harga</label>
                                            <input type="number" name="price" class="form-control" value="{{ $item->price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="editor" class="editor form-control">
                                                {{ $item->description }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
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
        </div>
        </div>
    </div>
@endsection
@push('after-script')
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endpush