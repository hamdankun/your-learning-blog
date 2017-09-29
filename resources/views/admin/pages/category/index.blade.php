@extends('admin.layouts.main')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Category List</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary add-btn disabled-when-click" title="Create Category"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            <table width="100%" class="table table-striped table-bordered table-hover" id="category">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
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
    var _urlAjaxDatatable = '{!! route('admin.datatable.category') !!}';
    var _baseUrl = '{{ url('/') }}';
    var _prefixUrl = _baseUrl+'/admin/category';
@endsection

@section('scripts')
    <script src="{{ env('DIST_PATH') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ env('DIST_PATH') }}/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="{{ env('DIST_PATH') }}/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="{{ env('DIST_PATH') }}/dist/js/sb-admin-2.js"></script>
    <script src="{{ env('DIST_PATH') . mix('/js/category.js') }}"></script>
@endsection