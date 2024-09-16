<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body">

            @livewire('meal-today-table', [])
        </div>
    </div>
</div>


