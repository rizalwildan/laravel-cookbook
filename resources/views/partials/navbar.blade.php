<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
    <a href="{{ url('/') }}" class="navbar-brand">CookBook</a>
    <div class="collapse navbar-collapse">
        <form class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="btn btn-outline-success" href="{{ route('login') }}">Login <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
    </div>
</nav>