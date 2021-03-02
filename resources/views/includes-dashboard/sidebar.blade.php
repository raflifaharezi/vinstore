<!-- Sidebar -->
    <div class="border-right" id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
        <img src="/images/online-shoping.svg" alt="" class="my-4" />
        </div>
        <div class="list-group list-group-flush">
        <a
            href="{{ route('dashboard') }}"
            class="list-group-item list-group-item-action           
            {{ (request()->is('dashboard')) ? 'active' : '' }}"
            >Dashboard</a
        >
        <a
            href="{{ route('dashboard-product') }}"
            class="list-group-item list-group-item-action             
            {{ (request()->is('dashboard/product*')) ? 'active' : '' }}"
            >My Products</a
        >
        <a
            href="{{ route('dashboard-transaction') }}"
            class="list-group-item list-group-item-action
            {{ (request()->is('dashboard/transaction*')) ? 'active' : '' }}"
            >Transactions</a
        >
        <a
            href="{{ route('dashboard-setting') }}"
            class="list-group-item list-group-item-action             
            {{ (request()->is('dashboard/setting*')) ? 'active' : '' }}"

            >Store Settings</a
        >
        <a
            href="{{ route('dashboard-account') }}"
            class="list-group-item list-group-item-action           
            {{ (request()->is('dashboard/account*')) ? 'active' : '' }}"
            >My Account</a
        >
        </div>
    </div>
    <!-- /#sidebar-wrapper -->
