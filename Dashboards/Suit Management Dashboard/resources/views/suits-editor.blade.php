<!DOCTYPE html>
<html>
    <head>
        <title>Suits Editor v1.0</title>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<script type="text/javascript" src="{{ url('js/app.js') }}"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    </head>
    <body data-ng-app="suit-editor" data-ng-controller="MainController">
        <div class="container">
			
			<div class="page-header">
			  <h1>Heddoko Suit Editor <small>V1.0</small></h1>
			</div>

			<a href="#">Suits <span class="badge">@{{suits.length}}</span></a>
			
			<div class="panel panel-primary" data-ng-repeat="suit in suits">
				<div class="panel-heading">
					<h3 class="panel-title pull-left">Heddoko Suit with @{{suit.sensors.length}} sensor(s)</h3>
					<button class="btn btn-danger pull-right" ng-click="DeleteSuit(suit)">Delete</button>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">
					
					<div class="col-sm-6">
						<div class="list-group">
							<button type="button" class="list-group-item" ng-repeat="sensor in suit.sensors"><b>@{{sensor.type.name}}</b> serial: @{{sensor.serial_no}}</button>
						</div>
					</div>
					
					<div class="col-sm-6">
						active sensor data here
					</div>
					
				</div>
			</div>
			
			
			


        </div>

        
    </body>
</html>
