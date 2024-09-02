<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/vendeurs.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('solde', __('models/dfms.fields.solde').':') !!}
    {!! Form::text('solde', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

