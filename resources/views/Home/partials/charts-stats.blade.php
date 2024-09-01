<!-- Graph about meals per day over all restos-->
<div class="row">

    <section class="col-lg-9 connectedSortable ui-sortable">

        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    {{__('home/dashboard.monthly_meals')}} '{{$month}} - {{$year}}'
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active " href="#sales-chart" data-toggle="tab">{{__('home/dashboard.chart')}}</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="col-lg-3 connectedSortable ui-sortable">

        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    {{__('home/dashboard.search_per_month')}}
                </h3>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <p class="text-center text-danger">{{__('home/dashboard.choose_month_and_year')}}</p>
                    <form action="{{route('home')}}" method="get">
                        @csrf
                        <div class="form-group row">
                            <label for="month" class="col-sm-4 col-form-label">{{__('home/dashboard.month')}}</label>
                            <div class="col-sm-8">
                                <select name="month" id="month" class="form-control">
                                    <option value="---">--------</option>
                                    <option value="1">{{__('home/dashboard.january')}}</option>
                                    <option value="2">{{__('home/dashboard.february')}}</option>
                                    <option value="3">{{__('home/dashboard.march')}}</option>
                                    <option value="4">{{__('home/dashboard.april')}}</option>
                                    <option value="5">{{__('home/dashboard.may')}}</option>
                                    <option value="6">{{__('home/dashboard.june')}}</option>
                                    <option value="7">{{__('home/dashboard.july')}}</option>
                                    <option value="8">{{__('home/dashboard.august')}}</option>
                                    <option value="9">{{__('home/dashboard.september')}}</option>
                                    <option value="10">{{__('home/dashboard.october')}}</option>
                                    <option value="11">{{__('home/dashboard.november')}}</option>
                                    <option value="12">{{__('home/dashboard.december')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year" class="col-sm-4 col-form-label">{{__('home/dashboard.year')}}</label>
                            <div class="col-sm-8">
                                <select name="year" id="year" class="form-control">
                                    <option value="---">--------</option>
                                    @for($i = 2023; $i <= date('Y'); $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">{{__('home/dashboard.search')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
