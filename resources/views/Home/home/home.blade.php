@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            {{__('home/dashboard.welcome') }}
            {{Auth::user()->name}}
        </h1>
    </div>

    @include('Home.partials.home.today-stats', ['mealsPerDou' => $mealsPerDou])
    @include('Home.partials.home.charts-stats', ['chart' => $chart, 'month' => $month, 'year' => $year])
@endsection

@
