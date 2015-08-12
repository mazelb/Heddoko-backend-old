
</br>
<div class="input-group">
    <span class="input-group-addon" id="search-bar-addon">Search</span>
    <input type="text" class="form-control" placeholder="Enter sensor serial, name, or physical location" aria-describedby="search-bar-addon" ng-model="search_term">
</div>
</br>
<a href="">Suits <span class="badge">@{{suits.length}}</span></a>
</br>
</br>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Add new suit</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-warning" ng-click="new_suit_equipment_ids = []">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="AddNewSuit()">Submit</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <div class="list-group">
                @{{new_suit_equipment_ids}}
                <selectize id='asdfg' options="equipment_list" config="new_equipment_config" ng-model="new_suit_equipment_ids"></selectize>
                <!--<a href="javascript:;" class="list-group-item clearfix" ng-repeat="sensor in new_suit_sensors track by $index" ng-class="{'list-group-item-info': sensor == current_sensor}" ng-click="$parent.current_sensor = sensor">
                    <b>@{{sensor.type.name}}</b> @{{sensor.name}}
                    <span class="pull-right">
                        <button class="btn btn-xs btn-warning" ng-click="RemoveExistingSensor(new_suit_sensors, sensor, current_sensor)">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </span>
                </a>-->
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary" ng-repeat="suit in suits track by suit.id">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"><span class="badge">@{{$index + 1}}</span> Heddoko Suit with @{{suit.equipment.length}} sensor(s)</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-danger" ng-click="DeleteSuit(suit.id)">Delete Suit</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="UpdateExistingSuit(suit)">Save</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="col-sm-6">
            <div class="list-group">
                <a href="javascript:;" class="list-group-item clearfix" ng-repeat="equipment in suit.equipment" ng-class="{'list-group-item-info': equipment == suit.current_equipment}" ng-click="$parent.suit.current_equipment = equipment">
                    <b>@{{equipment.serial_no}}</b> @{{equipment.name}}
                    <span class="pull-right">
                        <button class="btn btn-xs btn-warning" ng-click="RemoveExistingSensor(suit.equipment, equipment, suit.current_equipment)">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </span>
                </a>
                <a href="javascript:;" class="list-group-item active clearfix" ng-click="AddNewSensor(suit.sensors, suit.current_sensor)">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add sensor
                </a>
            </div>
        </div>
    </div>
</div>