<nav class="navbar top-navbar navbar-light bg-light px-5">
    <a class="btn border-0" id="menu-btn"><i class="bx bx-menu"></i></a>
    <div class="d-flex justify-content-end">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>
