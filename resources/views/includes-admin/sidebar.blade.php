<!-- Sidebar -->
    <div class="border-right" id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
        <img src="/images/user-avatar-admin.svg" alt="" class="my-4 w-50" />
        </div>
        <div class="list-group list-group-flush">
        <a
            href="{{ route('admin-dashboard') }}"
            class="list-group-item list-group-item-action             
            {{ (request()->is('admin')) ? 'active' : '' }}" 
            >Dashboard</a
        >
        <a
            href="{{ route('product.index') }}"
            class="list-group-item list-group-item-action 
            {{ (request()->is('admin/product*')) ? 'active' : '' }}" 
            >My Products</a
        >
        <a
            href="{{ route('categories.index') }}"
            class="list-group-item list-group-item-action 
            {{ (request()->is('admin/categories*')) ? 'active' : '' }}" 
            >Categories</a
        >
        <a
            href="{{ route('gallery.index') }}"
            class="list-group-item list-group-item-action
            {{ (request()->is('admin/gallery*')) ? 'active' : '' }}"
            >Product Gallery</a
        >
        <a
            href="{{ route('transaction.index') }}"
            class="list-group-item list-group-item-action 
            {{ (request()->is('admin/transaction*')) ? 'active' : '' }}""
            >Transactions</a
        >
        <a
            href="{{ route('user.index') }}"
            class="list-group-item list-group-item-action 
            {{ (request()->is('admin/user*')) ? 'active' : '' }}" 
            >Users</a
        >
        <a class="list-group-item list-group-item-action" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Sign-Out
                    </a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->
