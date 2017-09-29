<div class="panel panel-default">
    <div class="panel-heading">
        Privacy Police
    </div>
    <div class="panel-body">
        <div class="row mb-10">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12"></div>
            <div class="col-lg-1 col-md-2 col-sm-6 col-xs-12">
                <button type="button" class="btn btn-primary btn-sm add-seo-attribute" data-type="privacy_police">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                Total Meta : <span class="count-meta-privacy_police" data-count="{{ count($seo->privacyPolice) }}" >{{ count($seo->privacyPolice) }}</span>
            </div>
        </div>
        <div class="privacy_police-seo-form-group">
            @foreach($seo->privacyPolice as $key => $value)
                <div class="form-group">
                    <div class="col-sm-10 col-md-3 col-lg-3 col-xs-12">
                        <input type="text" name="privacy_police[attribute_key][]"  value="{{ $value->attribute_key }}" class="form-control" placeholder="Attribute Key"/>
                    </div>
                    <div class="col-sm-10 col-md-3 col-lg-3 col-xs-12">
                        <input type="text" name="privacy_police[attribute_name][]"  value="{{ $value->attribute_name }}" class="form-control" placeholder="Attribute Name"/>
                    </div>
                    <div class="col-sm-10 col-md-4 col-lg-5 col-xs-12">
                        <textarea 
                            name="privacy_police[attribute_content][]" 
                            class="form-control" 
                            placeholder="Attribute Content">{{ $value->attribute_content }}</textarea>                    
                    </div>
                    <div class="col-sm-10 col-md-3 col-lg-1 col-xs-12">
                        <button type="button" data-type="privacy_police" class="btn btn-danger btn-sm remove-seo"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>