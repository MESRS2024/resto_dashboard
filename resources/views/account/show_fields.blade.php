<div class="row">
    <div class="col-md-3">

        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{config('app.logo')}}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

            </div>

        </div>

    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">
                            @lang('home/account.settings')
                        </a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" method="post" action="{{route('account.update')}}">
                          @csrf
                            @include('account.fields')
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
