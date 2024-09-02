<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyMeals;
use App\Http\Requests\HomePostRequest;
use App\Services\homeServices\HomeService;
use App\Services\StatisticsService;
use Auth;
use App\Services\ChartService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        if(Auth::user()->hasRole('admin'))
        {
            return (new HomeService())->adminDashboard($request->month, $request->year);
        }
        if(Auth::user()->hasRole('dou'))
        {
            return (new HomeService())->adminDashboard($request->month, $request->year);
        }
        if(Auth::user()->hasRole('residence'))
        {
            return (new HomeService())->adminDashboard($request->month, $request->year);
        }
        if(Auth::user()->hasRole('dfm'))
        {
            return (new HomeService())->dfmDashboard($request->month, $request->year);
        }

    }


    public function stats(HomePostRequest $request)
    {
        $page = $request->page;
        return view('Home.stats');
    }
}
