<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Request::is('vendeurs*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-mail-bulk"></i>
        <p>@lang('models/dfms.plural')
            <i class="fas fa-angle-left @if(app()->getLocale()=='en') right @else left @endif"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{ route('vendeurs.index') }}" class="nav-link {{ Request::is('vendeurs*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>@lang('models/vendeurs.plural')</p>
            </a>
        </li>
    </ul>
</li>


