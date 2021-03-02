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
                Hi, Admin  {{ Auth::user()->name }}
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
                Edit Category
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
                            <form action="{{ route('categories.update', $item->id) }}" method="post" 
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nama Kategori</label>
                                            <input type="text" name="name" class="form-control" 
                                            value="{{ $item->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="photo">Foto</label>
                                            <input type="file" name="photo" class="form-control">
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
