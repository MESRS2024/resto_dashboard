<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyMeals;
use App\Exports\StatsExport;
use App\Http\Requests\HomePostRequest;
use App\Services\homeServices\HomeService;
use App\Services\StatisticsService;
use Auth;
use App\Services\ChartService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomePostRequest $request)
    {
        $month = (isset($request->month))?$request->month: Carbon::now()->month;
        $year = (isset($request->year))?$request->year: Carbon::now()->year;

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('dou'))
        {
            return (new HomeService())->adminDashboard($month, $year);
        }

        if(Auth::user()->hasRole('residence'))
        {
            return (new HomeService())->adminDashboard($month, $year);
        }

        if(Auth::user()->hasRole('dfm'))
        {
            return (new HomeService())->dfmDashboard();
        }

        if(Auth::user()->hasRole('vendeur'))
        {
            return (new HomeService())->vendeurDashboard();
        }

        if(Auth::user()->hasRole('dfm_onou'))
        {
            return (new HomeService())->dfmOnouDashboard();
        }

    }


    public function stats(HomePostRequest $request)
    {
        $page = $request->page;
        return view('Home.stats',
            [
                'page' => $page
            ]);
    }


    public function exportdata()
    {

        return Excel::download(new StatsExport, 'stats.xlsx');
    }
}
