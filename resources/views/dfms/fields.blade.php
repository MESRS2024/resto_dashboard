<!-- Dou Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dou_code', __('models/dfms.fields.dou_code').':') !!}
    {!! Form::text('dou_code', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/dfms.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/dfms.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/dfms.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Device Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_id', __('models/dfms.fields.device_id').':') !!}
    {!! Form::text('device_id', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/dfms.fields.photo').':') !!}
    {!! Form::text('photo', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Ban Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ban', __('models/dfms.fields.ban').':') !!}
    {!! Form::number('ban', null, ['class' => 'form-control', 'required']) !!}
</div>