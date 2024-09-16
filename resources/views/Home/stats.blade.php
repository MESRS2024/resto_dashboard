@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            {{__('home/dashboard.welcome') }}
            {{Auth::user()->name_en}}
        </h1>
    </div>
   @switch($page)
       @case('todays_stats')
           @include('Home.partials.todays_stats')
           @break
       @case('home')
           @include('Home.partials.all_by_resto')
              @break
   @endswitch

@endsection
