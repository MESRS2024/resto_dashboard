@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            {{__('home/dashboard.welcome') }}
            {{Auth::user()->name}}
        </h1>
    </div>

    @include('Home.partials.today-stats', ['mealsPerDou' => $mealsPerDou])
    @include('Home.partials.charts-stats', ['chart' => $chart, 'month' => $month, 'year' => $year])
@endsection

@
