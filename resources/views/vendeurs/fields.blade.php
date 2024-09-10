<!-- Resto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('resto_id', __('models/vendeurs.fields.resto_id').':') !!}
    {!! Form::select('resto_id', $RestoItems,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/vendeurs.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/vendeurs.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Device Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_id', __('models/vendeurs.fields.device_id').':') !!}
    {!! Form::text('device_id', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/vendeurs.fields.photo').':') !!}
    {!! Form::text('photo', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Ban Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ban', __('models/vendeurs.fields.ban').':') !!}
    {!! Form::number('ban', null, ['class' => 'form-control', 'required']) !!}
</div>
