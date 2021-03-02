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
                Welcome to Dashboard Admin - Product
            </p>
            </div>
            <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                            + Tambah Produk Baru
                            </a>
                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal w-100" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>User</th>
                                        <th>Kategori Produk</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
        var datatable = $('#crudTable').DataTable({
            processing : true,
            serverSide : true,
            ordering : true,
            ajax : {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name:'id' },
                { data: 'name', name:'name' },
                //relasi dari table users dari model product
                { data: 'user.name', name:'user.name' },
                //relasi dari table categories dari model product
                { data: 'category.name', name:'category.name' },
                { data: 'price', name:'price' },

                {
                    data: 'action', 
                    name:'action',
                    orderable: false,
                    searchable:false,
                    width:'15%'
                },
        ]
        });
    </script>

@endpush