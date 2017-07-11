<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Tables
        </h1>
        <ol class="breadcrumb">
            @if(isset($breadcrumbs) && is_array($breadcrumbs))
                @foreach($breadcrumbs as $key => $list)
                    <li class="{{ active_link($list['active']) }}" >
                        <i class="fa {{ $list['icon'] }}"></i>  {!! ucwords(define_link($list)) !!}
                    </li>
                @endforeach
            @endif
        </ol>
    </div>
</div>