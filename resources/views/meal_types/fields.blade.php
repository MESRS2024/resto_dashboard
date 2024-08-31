<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/mealTypes.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/mealTypes.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', __('models/mealTypes.fields.start').':') !!}
    {!! Form::text('start', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end', __('models/mealTypes.fields.end').':') !!}
    {!! Form::text('end', null, ['class' => 'form-control', 'required']) !!}
</div>