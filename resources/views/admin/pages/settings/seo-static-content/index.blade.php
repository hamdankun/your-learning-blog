@extends('admin.layouts.main')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">SEO Static Page</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mb-10 seo-static-form-btn-area">
                <button class="btn btn-primary right save-seo" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-home"></i> Home</a></li>
                <li><a data-toggle="tab" href="#sitemap"><i class="fa fa-map"></i> Site Map</a></li>
                <li><a data-toggle="tab" href="#privacy-police"><i class="fa fa-warning"></i> Privacy Police</a></li>
                <li><a data-toggle="tab" href="#contact-us"><i class="fa fa-glass"></i> Contact Us</a></li>
                <li><a data-toggle="tab" href="#about-us"><i class="fa fa-info-circle"></i> Aboust Us</a></li>
            </ul>
        </div>
        <div class="col-lg-9 col-md-10 col-sm-11 col-xs-12">
            <form class="form-horizontal form-seo-static">
                <div class="tab-content">
                    <div id="home" class="tab-pane active">
                        @include('admin.pages.settings.seo-static-content.tab-content.home')
                    </div>
                    <div id="sitemap" class="tab-pane">
                        @include('admin.pages.settings.seo-static-content.tab-content.site-map')
                    </div>
                    <div id="privacy-police" class="tab-pane">
                        @include('admin.pages.settings.seo-static-content.tab-content.privacy-police')
                    </div>
                    <div id="contact-us" class="tab-pane">
                        @include('admin.pages.settings.seo-static-content.tab-content.contact-us')
                    </div>
                    <div id="about-us" class="tab-pane">
                        @include('admin.pages.settings.seo-static-content.tab-content.about-us')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js-var')
    _prefixUrl = _baseUrl + '/admin/setting/seo/static'
@endsection

@section('scripts')
    <script src="{{ config('your.dist_path') . mix('/js/seo-static.js') }}"></script>
@endsection