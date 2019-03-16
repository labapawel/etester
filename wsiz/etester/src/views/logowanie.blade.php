<div class="row" ng-show="$storage.logowanieView">
                    
                    <div class="offset-sm-4 col-sm-4" style="margin-top: 30vh">
                        <h3>Logowanie do dziekanatu</h3>
                    </div>
                    <div class="col-auto"></div>    
                        
                        
                    <div class="offset-sm-4 col-sm-4" ng-show="errmess!=''">
                        <div class="alert alert-danger">@{{errmess}}</div>
                        
                    </div>
                    <div class="offset-sm-4 col-sm-4">
                    Album: <input type="text" class="form-control" ng-model="albumnr"><br>
                    Hasło: <input type="password" class="form-control" ng-model="albumpass"><br>
                    </div>
                    
                    <div class="offset-sm-4 col-sm-4 text-right">
                        <button class="btn btn-success" ng-click="logowanie()">Logowanie</button>
                    </div>
</div>