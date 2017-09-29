<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                         <i class="fa fa-street-view fa-5x"></i> 
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $visitor->today ? number_format($visitor->today) : 0}}</div>
                        <div>Today</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                         <i class="fa fa-history fa-5x"></i> 
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $visitor->yesterday ? number_format($visitor->yesterday) : 0}}</div>
                        <div>Yesterday!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                         <i class="fa fa-calendar fa-5x"></i> 
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $visitor->prevMonth ? number_format($visitor->prevMonth) : 0}}</div>
                        <div>Previous Month</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <div class="huge">{{ $visitor->allOfTime ? number_format($visitor->allOfTime) : 0}}</div>
                        <div>All Of Time</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>