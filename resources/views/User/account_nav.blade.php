<div class="col-lg-3">
    <ul class="account-nav">
        <li><a href="{{route('user.index') }}" class="menu-link menu-link_us-s">Dashboard</a></li>
        <li><a href="{{route('user.orders')}}" class="menu-link menu-link_us-s">Orders</a></li>
        <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
        <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
        <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li>

        <form method="POST" action="{{ asset ('logout') }}" id="logout-form">
            @csrf
            <li><a href="{{ asset ('logout') }}" class="menu-link menu-link_us-s" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </form>
    </ul>
</div>