<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body">
            <a href="{{route('stats.export')}}" class="
                 float-left
                btn btn-success">
                Export
            </a>
            @livewire('meal-table', [])
        </div>
    </div>
</div>


