<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">
        @lang('home/account.fields.name')
    </label>
    <div class="col-sm-10">
        <input type="text"
               name="name"
               value="{{auth()->user()->name}}"
               class="form-control" id="name"
               placeholder="@lang('home/account.fields.name')" readonly>
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-sm-2 col-form-label">
        @lang('home/account.fields.phone')
    </label>
    <div class="col-sm-10">
        <input type="text"
               name="phone"
               value="{{auth()->user()->email}}"
               class="form-control @error('phone') is-invalid @enderror"
               id="phone" placeholder=" @lang('home/account.fields.phone')" readonly>
        @error('phone')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

</div>

<div class="form-group row">
    <label for="password_old" class="col-sm-2 col-form-label">
        @lang('home/account.fields.password_old')
    </label>
    <div class="col-sm-10">
        <input type="password" name="password_old"
               class="form-control @error('password_old') is-invalid @enderror" id="inputEmail" placeholder="@lang('home/account.fields.password_old')">
        @error('password_old')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

</div>

<div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">
        @lang('home/account.fields.password')
    </label>
    <div class="col-sm-10">
        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror"
               id="inputEmail"
               placeholder="@lang('home/account.fields.password')">
        @error('password')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

</div>

<div class="form-group row">
    <label for="password_confirmation" class="col-sm-2 col-form-label">
        @lang('home/account.fields.password_confirmation')
    </label>
    <div class="col-sm-10">
        <input type="password" name="password_confirmation"
               class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="@lang('home/account.fields.password_confirmation')">
        @error('password_confirmation')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

</div>

<div class="form-group row">
    <div class="offset-sm-2 col-sm-10">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="accept"> @lang('home/account.accept')</a>
            </label>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-primary">
            @lang('home/account.save')
        </button>
    </div>
</div>
