<li class="nav-item menu-is-opening menu-open">
    <a href="#" class="nav-link {{ Request::is('stats/*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-mail-bulk"></i>
        <p>@lang('models/stat.menu_title')
            <i class="fas fa-angle-left @if(app()->getLocale()=='en') right @else left @endif"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{route('stats', ['page'=>'home'])}}" class="nav-link {{Request::is('stats/home') ? 'active' : '' }} ">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>@lang('models/stat.all_by_resto')
                </p>
            </a>
        </li>


    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('vendeurs.index') }}" class="nav-link {{ Request::is('vendeurs*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>@lang('models/vendeurs.plural')</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('restos.index') }}" class="nav-link {{ Request::is('restos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-building"></i>
        <p>@lang('models/restos.plural')</p>
    </a>
</li>

