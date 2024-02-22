@section('navbar')
<nav class="navbar navbar-expand-lg bg-body-tertiary p-3 fixed-top">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">
            <img src="{{ asset('img/logo.png') }}" alt="">
        </a>

        <div class="collapse navbar-collapse justify-content-end nav-items">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/for-lease">For Lease</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Compare Properties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@show
