<div class="panel panel-default">
    <div class="panel-heading">
        About Us
    </div>
    <div class="panel-body">
        <div class="row mb-10">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"></div>
            <div class="col-lg-1 col-md-2 col-sm-6 col-xs-12">
                <button type="button" class="btn btn-primary btn-sm add-seo-attribute" data-type="about_us">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                Total Meta : <span class="count-meta-about_us" data-count="{{ count($seo->aboutUs) }}" >{{ count($seo->aboutUs) }}</span>                
            </div>
        </div>
        <div class="about_us-seo-form-group">
            @foreach($seo->aboutUs as $key => $value)
                <div class="form-group">
                    <div class="col-sm-10 col-md-3 col-lg-3 col-xs-12">
                        <input type="text" name="about_us[attribute_key][]"  value="{{ $value->attribute_key }}" class="form-control" placeholder="Attribute Key"/>
                    </div>
                    <div class="col-sm-10 col-md-3 col-lg-3 col-xs-12">
                        <input type="text" name="about_us[attribute_name][]"  value="{{ $value->attribute_name }}" class="form-control" placeholder="Attribute Name"/>
                    </div>
                    <div class="col-sm-10 col-md-4 col-lg-5 col-xs-12">
                        <textarea 
                            name="about_us[attribute_content][]" 
                            class="form-control" 
                            placeholder="Attribute Content">{{ $value->attribute_content }}</textarea>                    
                    </div>
                    <div class="col-sm-10 col-md-3 col-lg-1 col-xs-12">
                        <button type="button" data-type="about_us" class="btn btn-danger btn-sm remove-seo"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>