<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/residences.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 30, 'maxlength' => 30, 'maxlength' => 30]) !!}
</div>

<!-- Wilaya Field -->
<div class="form-group col-sm-6">
    {!! Form::label('wilaya', __('models/residences.fields.wilaya').':') !!}
    {!! Form::text('wilaya', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Id Residence Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_residence', __('models/residences.fields.id_residence').':') !!}
    {!! Form::number('id_residence', null, ['class' => 'form-control']) !!}
</div>

<!-- Denomination Fr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('denomination_fr', __('models/residences.fields.denomination_fr').':') !!}
    {!! Form::text('denomination_fr', null, ['class' => 'form-control', 'maxlength' => 250, 'maxlength' => 250, 'maxlength' => 250]) !!}
</div>

<!-- Denomination Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('denomination_ar', __('models/residences.fields.denomination_ar').':') !!}
    {!! Form::text('denomination_ar', null, ['class' => 'form-control', 'maxlength' => 250, 'maxlength' => 250, 'maxlength' => 250]) !!}
</div>

<!-- Dou Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dou', __('models/residences.fields.dou').':') !!}
    {!! Form::text('dou', null, ['class' => 'form-control', 'maxlength' => 250, 'maxlength' => 250, 'maxlength' => 250]) !!}
</div>

<!-- Type Residence Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_residence', __('models/residences.fields.type_residence').':') !!}
    {!! Form::text('type_residence', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>