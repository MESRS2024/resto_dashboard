<!-- Resto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('resto_id', __('models/clients.fields.resto_id').':') !!}
    {!! Form::number('resto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', __('models/clients.fields.type').':') !!}
    {!! Form::number('type', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/clients.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Card Field -->
<div class="form-group col-sm-6">
    {!! Form::label('card', __('models/clients.fields.card').':') !!}
    {!! Form::text('card', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/clients.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Duplicate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duplicate', __('models/clients.fields.duplicate').':') !!}
    {!! Form::number('duplicate', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Progres Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('progres_id', __('models/clients.fields.progres_id').':') !!}
    {!! Form::number('progres_id', null, ['class' => 'form-control']) !!}
</div>