
<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('administration*') ? 'active' : '' }} ">
        <i class="nav-icon fas fa-home"></i>
        <p>@lang('nav.settings')
            <i class="fas fa-angle-left @if(app()->getLocale()=='en') right @else left @endif"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" >
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('administration/users*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>@lang('models/users.plural')</p>
            </a>
        </li>
        @role('super-admin')
        <!-- need to remove -->
        <li class="nav-item">
            <a href="{{ route('laravelroles::roles.index') }}"
               class="nav-link {{ Request::is('administration/roles') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>{{__('nav.roles')}}</p>
            </a>
        </li>
        @endrole
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('clients.index') }}" class="nav-link {{ Request::is('clients*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>@lang('models/clients.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('meal-types.index') }}" class="nav-link {{ Request::is('mealTypes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cart-plus"></i>
        <p>@lang('models/mealTypes.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('residences.index') }}" class="nav-link {{ Request::is('residences*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-restroom"></i>
        <p>@lang('models/residences.plural')</p>
    </a>
</li>
