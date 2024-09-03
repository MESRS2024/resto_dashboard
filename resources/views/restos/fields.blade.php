<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/restos.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/restos.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>



<!-- Is Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_active', __('models/restos.fields.is_active').':') !!}
    {!! Form::select('is_active', $activeItems,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Breakfast Field -->
<div class="form-group col-sm-6">
    {!! Form::label('breakfast', __('models/restos.fields.breakfast').':') !!}
    {!! Form::select('breakfast', $activeItems,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Lunch Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lunch', __('models/restos.fields.lunch').':') !!}
    {!! Form::select('lunch', $activeItems,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Dinner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dinner', __('models/restos.fields.dinner').':') !!}
    {!! Form::select('dinner', $activeItems, null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- B Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('b_start', __('models/restos.fields.b_start').':') !!}
    {!! Form::text('b_start', null, ['class' => 'form-control']) !!}
</div>

<!-- B End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('b_end', __('models/restos.fields.b_end').':') !!}
    {!! Form::text('b_end', null, ['class' => 'form-control']) !!}
</div>

<!-- L Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('l_start', __('models/restos.fields.l_start').':') !!}
    {!! Form::text('l_start', null, ['class' => 'form-control']) !!}
</div>

<!-- L End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('l_end', __('models/restos.fields.l_end').':') !!}
    {!! Form::text('l_end', null, ['class' => 'form-control']) !!}
</div>

<!-- D Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('d_start', __('models/restos.fields.d_start').':') !!}
    {!! Form::text('d_start', null, ['class' => 'form-control']) !!}
</div>

<!-- D End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('d_end', __('models/restos.fields.d_end').':') !!}
    {!! Form::text('d_end', null, ['class' => 'form-control']) !!}
</div>

<!-- Dou Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dou_code', __('models/restos.fields.dou_code').':') !!}
    {!! Form::select('dou_code', $douItems ,null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Resto Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('resto_type', __('models/restos.fields.resto_type').':') !!}
    {!! Form::select('resto_type', $restoTypeItems,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Id Progres Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_progres', __('models/restos.fields.id_progres').':') !!}
    {!! Form::select('id_progres', $residenceItems, null, ['class' => 'form-control']) !!}
</div>
