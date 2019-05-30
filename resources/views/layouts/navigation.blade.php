<ul class="sidebar-menu tree" data-widget="tree">
    <li class="header">MENU</li>
    <li class="{{ Request::is('/') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Pulpit</span></a>
    </li>

    @if(auth()->user()->isAdmin())
    <li class="{{ Request::is('new-admin') ? 'active' : '' }}">
        <a href=""><i class="fa fa-user" aria-hidden="true"></i><span>Dodaj administratora</span></a>
    </li>
    <li class="{{ Request::is('deals') ? 'active' : '' }}">
        <a href="{{route('deals')}}"><i class="fa fa-star" aria-hidden="true"></i><span>Promocje</span></a>
    </li>
    @endif
</ul>
