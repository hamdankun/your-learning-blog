 @extends('admin.layouts.main')

 @section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        @include('admin.dashboard-components.kpi')
        <!-- /.row -->
        <div class="row">
            @include('admin.dashboard-components.chart')
            <!-- /.col-lg-8 -->
            @include('admin.dashboard-components.panel-visitor')
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('js-var')
    var visitorChart = JSON.parse('{!! $visitor->statisticChart !!}')
    var visitorDonut = JSON.parse('{!! $visitor->donutChart !!}')
@endsection

@section('scripts')
    <script src="{{ env('DIST_PATH') }}/vendor/raphael/raphael.min.js"></script>
    <script src="{{ env('DIST_PATH') }}/vendor/morrisjs/morris.min.js"></script>
    <script src="{{ env('DIST_PATH') }}/data/morris-data.js"></script>
    <script src="{{ env('DIST_PATH') }}/dist/js/sb-admin-2.js"></script>
@endsection