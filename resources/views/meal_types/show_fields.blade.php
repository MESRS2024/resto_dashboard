<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/mealTypes.fields.name').':') !!}
    <p>{{ $mealType->name }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('models/mealTypes.fields.code').':') !!}
    <p>{{ $mealType->code }}</p>
</div>

<!-- Start Field -->
<div class="col-sm-12">
    {!! Form::label('start', __('models/mealTypes.fields.start').':') !!}
    <p>{{ $mealType->start }}</p>
</div>

<!-- End Field -->
<div class="col-sm-12">
    {!! Form::label('end', __('models/mealTypes.fields.end').':') !!}
    <p>{{ $mealType->end }}</p>
</div>

