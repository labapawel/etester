<div class="row" ng-show="!$storage.logowanieView && $storage.test">
    
    <div class="content-page danger">
        <div class="col-sm" ng-hide="$storage.test === false">
        {!! str_replace(['{|','|}'],['@{{','}}'],$page->content) !!}
        
        
            <div class="text-right">
                
                
                <span type="button" class="btn btn-success" ng-click="rozpocznijtest()">Startujemy</span>
            </div>
        </div>
    </div>
</div>

