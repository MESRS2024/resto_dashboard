@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/users.plural')</h1>
                </div>
                @role('admin')
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('users.create') }}">
                         @lang('crud.add_new')
                    </a>
                </div>
                @endrole
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @livewire('users-table', [])
            </div>
        </div>
    </div>
    @include('livewire.modal')


@endsection

@push(
    'page_scripts'
)
    <script >
        function loadeditform(url, title){
            $('#editModal .modal-body').load(url, function(e) {
                $('#editModal').modal('show');
                $('.modal-title').text(title);
            });
        }
    </script>


@endpush
