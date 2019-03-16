<div class="row" ng-show="!$storage.logowanieView && !$storage.test">
    
    <div class="content-page danger">
        <div class="col-sm">
        {!! $page->content !!}
        
        
            <div class="text-right">
                
                <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Egzamin
                </button>
                <div class="dropdown-menu">
                      <div class="form-group" style="margin:10px;">
                        <label for="exampleInputPassword1">Hasło dziekana</label>
                        <input type="password" ng-model="dziekanpass" class="form-control">
                      </div>
                </div>
              </div>
                <span type="button" class="btn btn-success" ng-click="rozpocznijtest()">Rozpoczynamy test</span>
            </div>
        </div>
    </div>
</div>

