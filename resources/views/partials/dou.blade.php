
<li class="nav-item">
    <a href="{{ route('dfms.index') }}" class="nav-link {{ Request::is('dfms*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-circle"></i>
        <p>@lang('models/dfms.plural')</p>
    </a>
</li>
