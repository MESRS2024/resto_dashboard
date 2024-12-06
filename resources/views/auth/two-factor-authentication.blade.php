@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">



                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                           <h1>{{__('auth.2fa')}}</h1>
                            @if(
                                session('status') == 'two-factor-authentication-enabled'
                            )
                                <div class="alert alert-success">
                                    {{__('auth.2fa_enabled')}}.
                                </div>
                            @else
                                <p>{{__('auth.2fa_enable')}}.</p>
                                <div>
                                    <p>{{__('auth.2fa_scan')}}.</p>
                                    {!! $qrCodeUrl !!}
                                </div>

                                <form method="POST" action="{{ route ('2fa.verify') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="otp">{{__('auth.2fa_entre_code')}}.</label>
                                        <input type="text" name="otp" id="otp" class="form-control @error('code') is-invalid @enderror">
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__('auth.2fa_enable_code')}}</button>
                                </form>
                            @endif
                          <a class=" btn btn-default" href="{{ route('account.show') }}">{{__('auth.profile')}}</a>

                        </div>


            </div>

        </div>

    </div>

</div>
@endsection
