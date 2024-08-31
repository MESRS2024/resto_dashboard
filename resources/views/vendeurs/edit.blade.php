<div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($vendeur, ['route' => ['vendeurs.update', $vendeur->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('vendeurs.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('vendeurs.index') }}" class="btn btn-default"> @lang('crud.cancel') </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

