<section class="content">
    <div class="container-fluid">
        <!-- Small boxes live stats about the actual openMeal by resto (Stat box) -->
        <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box {{getRandomBackground()}}">
                        <div class="inner">
                            <h3>
                                {{
                                    formatBalance(auth()->user()->wallet->balance/100) .
                                    ' ' . __('home/dashboard.currency')
                                }}
                            </h3>
                            <p>{{__('models/dfms.balance')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>

        </div>
        <!-- /.row -->


    </div>
</section>

