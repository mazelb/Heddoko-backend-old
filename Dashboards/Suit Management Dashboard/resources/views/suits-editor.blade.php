<!DOCTYPE html>
<html>
	<head>
		<title>Suits Editor v1.0.5</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ url('css/selectize.css') }}">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ url('js/bootbox.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/dirPagination.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/selectize.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/ng-selectize.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
    </head>
    <body data-ng-app="suit-editor" data-ng-controller="MainController">
        <div class="container">
			<div class="page-header">
				<h1>Heddoko Suit Editor <small>V1.0.5</small></h1>
			</div>

			{{-- Navigation tabs --}}
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#suits">Suits</a></li>
				<li><a data-toggle="tab" href="#equipment">Equipment</a></li>
			</ul>

			{{-- Tab content --}}
            <br />
			<div class="tab-content">
			    <div id="suits" class="tab-pane fade in active">
				    @include('partials/suits-tab')
				</div>

				<div id="equipment" class="tab-pane fade">
				    @include('partials/equipment-tab')
				</div>
			</div>

            <br />
            <br />

		</div>

		{{-- Loading dialog --}}
		<div class="modal" id="loading-dialog" data-backdrop="static" data-keyboard="false">
            <h1 style="position: relative; width: 200px; height: auto; margin: 0 auto; top: 50%; transform: translateY(-50%); color: white;">
                Working...
            </h1>
        </div>
	</body>
</html>
