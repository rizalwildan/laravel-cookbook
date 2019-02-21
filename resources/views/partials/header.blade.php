<header class="app-header navbar">
    <a href="#" class="navbar-brand">
        <h4>Admin Template</h4>
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" class="img-avatar" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Setting</strong>
                </div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user-alt"></i>
                    Accounts
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-lock"></i>
                    Password
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</header>