<!DOCTYPE html>
<html>
	<head>
		<title>Suits Editor v1.0.3</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/bootbox.min.js') }}"></script>
    </head>
    <body data-ng-app="suit-editor" data-ng-controller="MainController">
        <div class="container">
			<div class="page-header">
				<h1>Heddoko Suit Editor <small>V1.0.3</small></h1>
			</div>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#suits">Suits</a></li>
				<li><a data-toggle="tab" href="#equipment">Equipment</a></li>
				<li><a data-toggle="tab" href="#upload-file">Upload File</a></li>
			</ul>
			<div class="tab-content">
				<div id="suits" class="tab-pane fade in active">
					</br>
					<div class="input-group">
						<span class="input-group-addon" id="search-bar-addon">Search</span>
						<input type="text" class="form-control" placeholder="Enter sensor serial, name, or physical location" aria-describedby="search-bar-addon" ng-model="search_term">
					</div>
					</br>
					<a href="">Suits <span class="badge">@{{filtered_suits_list.length}}</span></a>
					</br>
					</br>
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
					<div class="panel panel-primary" ng-repeat="suit in filtered_suits_list track by suit.id">
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
				</div>
				<div id="upload-file" class="tab-pane fade">
					<h3>Upload CSV File</h3>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>
				<div id="equipment" class="tab-pane fade">
					<h3>Equipment</h3>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>
			</div>
		</div>
	</body>
</html>
