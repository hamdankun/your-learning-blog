@extends('admin.layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category Create</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.category.store') }}" method="POST" class="form-horizontal disabled-when-submit">
                    @include('admin.pages.category.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-var')

@endsection

@section('scripts')
    <script src="{{ config('your.dist_path') }}/dist/js/sb-admin-2.js"></script>
@endsection