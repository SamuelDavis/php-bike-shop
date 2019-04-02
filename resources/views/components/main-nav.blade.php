<?php /** @var App\Views\Components\MainNav $vm */ ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{!! $vm->homeHref !!}">{{ $vm->brand }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#{!! $vm->id !!}"
            aria-controls="{!! $vm->id !!}" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="{!! $vm->id !!}">
        <ul class="navbar-nav mr-auto">
            @foreach ($vm->mainNav as [$href, $label])
                <li class="nav-item {{ $vm->renderActiveClass($href) }}">
                    <a class="nav-link" href="{!! $href !!}">{{ $label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Admin</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @foreach ($vm->adminNav as [$href, $label])
                        <a class="dropdown-item" href="{!! $href !!}">{{ $label }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</nav>
