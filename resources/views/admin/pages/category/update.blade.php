@extends('admin.layouts.main')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category Update</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($category)
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="form-horizontal disabled-when-submit">
                        {{ method_field('PUT') }}
                        @include('admin.pages.category.form')
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js-var')

@endsection

@section('scripts')
    <script src="{{ env('DIST_PATH') }}/dist/js/sb-admin-2.js"></script>
@endsection