<!DOCTYPE html>
<html>
	<head>
		<title>Suits Editor v1.0.4</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/bootbox.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/dirPagination.js') }}"></script>
    </head>
    <body data-ng-app="suit-editor" data-ng-controller="MainController">
        <div class="container">
			<div class="page-header">
				<h1>Heddoko Suit Editor <small>V1.0.4</small></h1>
			</div>

			{{-- Search form --}}
            <form ng-submit="updatePage()">
                <div class="input-group">
                    <span class="input-group-addon" id="search-bar-addon">Search</span>
                    <input type="text" class="form-control" placeholder="Enter sensor serial, name, or physical location" aria-describedby="search-bar-addon" ng-model="search_term">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" ng-click="updatePage()">Search</button>
                        <button
                            type="button"
                            class="btn btn-default dropdown-toggle"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                                Show <span>@{{ suits_per_page }}</span> suits per page
                                <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#" ng-click="suits_per_page=5">Show 5 suits per page</a></li>
                            <li><a href="#" ng-click="suits_per_page=10">Show 10 suits per page</a></li>
                            <li><a href="#" ng-click="suits_per_page=20">Show 20 suits per page</a></li>
                            <li><a href="#" ng-click="suits_per_page=50">Show 50 suits per page</a></li>
                            <li><a href="#" ng-click="suits_per_page=100">Show 100 suits per page</a></li>
                        </ul>
                    </span>
                </div>
            </form>

			<br />
			Total: <span class="badge">@{{total_suits}}</span>
			<br />
			<br />

			{{-- Form for new suit --}}
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title pull-left">Add new suit</h3>
					<div ng-show="new_suit_sensors.length > 0" class="btn-group pull-right" role="group">
						<button type="button" class="btn btn-sm btn-warning" ng-click="new_suit_sensors = []">Reset</button>
						<button type="button" class="btn btn-sm btn-success" ng-click="AddNewSuit()">Submit</button>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">
					<div class="col-sm-6">
						<div class="list-group">
							<a href="javascript:;" class="list-group-item clearfix" ng-repeat="sensor in new_suit_sensors track by $index" ng-class="{'list-group-item-info': sensor == current_sensor}" ng-click="$parent.current_sensor = sensor">
								<b>@{{sensor.type.name}}</b> @{{sensor.name}}
								<span class="pull-right">
									<button class="btn btn-xs btn-warning" ng-click="RemoveExistingSensor(new_suit_sensors, sensor, current_sensor)">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</span>
							</a>
							<a href="javascript:;" class="list-group-item active clearfix" ng-click="AddNewSensor(new_suit_sensors, current_sensor)">
								<span class="glyphicon glyphicon-plus"></span>
								Add sensor
							</a>
						</div>
					</div>
					<div class="col-sm-6" ng-hide="current_sensor == null">
						<select class="form-control" 
							ng-model="current_sensor.type"
							ng-selected="current_sensor.type"
							ng-options="sensor_type.name for sensor_type in sensor_types track by sensor_type.id">
						</select>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" class="form-control" placeholder="Serial No." ng-model="current_sensor.serial_no">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" class="form-control" placeholder="Name, eg. nod-1234" ng-model="current_sensor.name">
							</div>
						</div>
						<input type="text" class="form-control" placeholder="Part No." ng-model="current_sensor.part_no">
						<select class="form-control" 
							ng-model="current_sensor.anatomical_position"
							ng-selected="current_sensor.anatomical_position"
							ng-options="anatomical_position.name for anatomical_position in anatomical_positions track by anatomical_position.id">
						</select>
						<input type="text" class="form-control" placeholder="Physical Location." ng-model="current_sensor.physical_location">
					</div>
				</div>
			</div>

			{{-- List of suits --}}
			<div class="panel panel-primary" dir-paginate="suit in filtered_suits_list | itemsPerPage: suits_per_page track by suit.id" total-items="total_suits" current-page="pagination.current">
				<div class="panel-heading">
					<h3 class="panel-title pull-left"><span class="badge">@{{$index + 1}}</span> Heddoko Suit with @{{suit.sensors.length}} sensor(s)</h3>
					<div class="btn-group pull-right" role="group">
						<button type="button" class="btn btn-sm btn-danger" ng-click="DeleteSuit(suit)">Delete Suit</button>
						<button type="button" class="btn btn-sm btn-success" ng-click="UpdateExistingSuit(suit)">Save</button>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="panel-body">
					<div class="col-sm-6">
						<div class="list-group">
							<a href="javascript:;" class="list-group-item clearfix" ng-repeat="sensor in suit.sensors" ng-class="{'list-group-item-info': sensor == suit.current_sensor}" ng-click="$parent.suit.current_sensor = sensor">
								<b>@{{sensor.type.name}}</b> @{{sensor.name}}
								<span class="pull-right">
									<button class="btn btn-xs btn-warning" ng-click="RemoveExistingSensor(suit.sensors, sensor, suit.current_sensor)">
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
					<div class="col-sm-6" ng-hide="suit.current_sensor == null">
						<select class="form-control" 
							ng-model="suit.current_sensor.type"
							ng-selected="suit.current_sensor.type"
							ng-options="sensor_type.name for sensor_type in sensor_types track by sensor_type.id">
						</select>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" class="form-control" placeholder="Serial No." ng-model="suit.current_sensor.serial_no">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<input type="text" class="form-control" placeholder="Name, eg. nod-1234" ng-model="suit.current_sensor.name">
							</div>
						</div>
						<input type="text" class="form-control" placeholder="Part No." ng-model="suit.current_sensor.part_no">
						<select class="form-control" 
							ng-model="suit.current_sensor.anatomical_position"
							ng-selected="suit.current_sensor.anatomical_position"
							ng-options="anatomical_position.name for anatomical_position in anatomical_positions track by anatomical_position.id">
						</select>
						<input type="text" class="form-control" placeholder="Physical Location." ng-model="suit.current_sensor.physical_location">
					</div>
				</div>
			</div>

            {{-- Pagination controls --}}
            <dir-pagination-controls
                template-url="views/dirPagination.tpl.html"
                on-page-change="updatePage(newPageNumber)"
                style="text-align: center"></dir-pagination-controls>
		</div>
	</body>
</html>
