@extends('admin.layouts.main')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Article List</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="article">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js-var')
    var _urlAjaxDatatable = '{!! route('admin.datatable.article') !!}';
    var _baseUrl = '{{ url('/') }}';
    var _prefixUrl = _baseUrl+'/admin/article';
    var mode = 'index';
@endsection

@section('scripts')
    <script src="/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="/dist/js/sb-admin-2.js"></script>
    <script src="{{ mix('/js/artickle.js') }}"></script>
@endsection