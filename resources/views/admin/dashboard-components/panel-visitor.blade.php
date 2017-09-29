<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-star fa-fw"></i> Most Popular Article On This Week
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

                <div class="list-group">
                    @foreach($visitor->popularArticle as $key => $value)
                        <a href="#!" class="list-group-item {{ $key <= 2 ? 'hight-light-popular' : '' }}">
                            {{ str_limit($value->title, 25) }}
                            <span class="pull-right text-muted small">
                                <b>{{ $value->total }}</b>
                            </span>
                        </a>
                    @endforeach
                </div>
            <!-- /.list-group -->
            <!-- <a href="#" class="btn btn-default btn-block">View All Alerts</a> -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Browser Usage Donut Chart
        </div>
        <div class="panel-body">
            <div id="morris-donut-chart"></div>
            <!-- <a href="#" class="btn btn-default btn-block">View Details</a> -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>