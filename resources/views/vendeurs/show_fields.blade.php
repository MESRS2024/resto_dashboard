<!-- Resto Id Field -->
<div class="col-sm-12">
    {!! Form::label('resto_id', __('models/vendeurs.fields.resto_id').':') !!}
    <p>{{ $vendeur->resto_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/vendeurs.fields.name').':') !!}
    <p>{{ $vendeur->name }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', __('models/vendeurs.fields.phone').':') !!}
    <p>{{ $vendeur->phone }}</p>
</div>



<!-- Device Id Field -->
<div class="col-sm-12">
    {!! Form::label('device_id', __('models/vendeurs.fields.device_id').':') !!}
    <p>{{ $vendeur->device_id }}</p>
</div>

<!-- Photo Field -->
<div class="col-sm-12">
    {!! Form::label('photo', __('models/vendeurs.fields.photo').':') !!}
    <p>{{ $vendeur->photo }}</p>
</div>

<!-- Ban Field -->
<div class="col-sm-12">
    {!! Form::label('ban', __('models/vendeurs.fields.ban').':') !!}
    <p>{{ $vendeur->ban }}</p>
</div>

