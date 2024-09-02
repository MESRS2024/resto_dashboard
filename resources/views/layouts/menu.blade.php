<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>{{__('nav.home')}}</p>
    </a>
</li>
@role('admin')
@include('partials.admin')
@include('partials.residence')
@include('partials.dou')

@endrole

@role('dou')
@include('partials.residence')
@include('partials.dou')
@endrole

@role('residence')
@include('partials.residence')
@endrole

@role('dfm')
@include('partials.dfm')
@endrole
