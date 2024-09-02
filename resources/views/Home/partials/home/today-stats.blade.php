<section class="content">
    <div class="container-fluid">
        <!-- Small boxes live stats about the actual openMeal by resto (Stat box) -->
        <div class="row">
            @foreach($mealsPerDou as $key=>$data)
                <div class="col-lg-4 col-6">
                    <div class="small-box {{getRandomBackground()}}">
                        <div class="inner">

                                <h3>
                                    @foreach($data as $d)
                                        {{$d->number}}
                                    @endforeach</h3>
                            <p>{{$key}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.row -->


    </div>
</section>

@push('page_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
@endpush
