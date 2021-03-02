@extends('layouts.dashboard')

@section('title')
    Dashboard - Account
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
            <h2 class="dashboard-title">My Account</h2>
            <p class="dashboard-subtitle">
                Update your current profile
            </p>
            </div>
            <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                <form action="{{ route('dashboard-redirect', 'dashboard-account') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="card" id="locations">
                    <div class="card-body">
                        <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="name">Your Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                aria-describedby="emailHelp"
                                name="name"
                                value="{{ $user->name }}"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="email">Your Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                aria-describedby="emailHelp"
                                name="email"
                                value="{{ $user->email }}"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="address_one">Address 1</label>
                            <input
                                type="text"
                                class="form-control"
                                id="address_one"
                                aria-describedby="emailHelp"
                                name="address_one"
                                value="{{ $user->address_one }}"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="address_two">Address 2</label>
                            <input
                                type="text"
                                class="form-control"
                                id="address_two"
                                aria-describedby="emailHelp"
                                name="address_two"
                                value="{{ $user->address_two }}"
                            />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Province</label>
                                <select name="provinces_id" id="provinces_id" class="form-control" 
                                        v-if="provinces" v-model="provinces_id">
                                <option v-for="province in provinces" :value="province.id">
                                    @{{ province.name }}
                                </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">City</label>
                                <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                                    <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="zip_code">Postal Code</label>
                            <input
                                type="text"
                                class="form-control"
                                id="zip_code"
                                name="zip_code"
                                value="{{ $user->zip_code }}"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="country">Country</label>
                            <input
                                type="text"
                                class="form-control"
                                id="country"
                                name="country"
                                value="{{ $user->country }}"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="phone_number">Mobile</label>
                            <input
                                type="text"
                                class="form-control"
                                id="phone_number"
                                name="phone_number"
                                value="{{ $user->phone_number }}"
                            />
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
@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
            this.getProvincesData();
            },
            data: {
            provinces: null,
            regencies: null,
            provinces_id: null,
            regencies_id: null,
            },
            methods: {
            getProvincesData() {
                var self = this;
                axios.get('{{ route('api-provincies') }}')
                .then(function (response) {
                    self.provinces = response.data;
                })
            },
            getRegenciesData() {
                var self = this;
                axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                .then(function (response) {
                    self.regencies = response.data;
                })
            },
            },
            //euntuk melihat data apakah ada perubahan maka akan dilakukan seseuatu
            //mengganti provinsi dan regencies juga akan ter reset
            watch: {
            provinces_id: function (val, oldVal) {
                this.regencies_id = null;
                this.getRegenciesData();
            },
            }
        });
    </script>
@endpush