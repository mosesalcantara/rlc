@section('navbar')
<nav class="navbar navbar-expand-lg bg-body-tertiary p-3 fixed-top">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">
            <img src="{{ asset('img/pages/logo.png') }}" alt="">
        </a>

        <div class="collapse navbar-collapse justify-content-end nav-items">
            <ul class="navbar-nav">
                @if (count($nav_items) > 0)
                    @foreach ($nav_items as $nav_item)
                        <li class="nav-item">
                            <a class="nav-link" href="/{{ $nav_item->link }}">{{ $nav_item->title }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</nav>
@show
