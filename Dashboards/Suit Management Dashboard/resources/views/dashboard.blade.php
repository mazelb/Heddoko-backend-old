<!DOCTYPE html>
<html>
	<head>
		<title>Heddoko Inventory v{{ $version }}</title>
        <meta name="api-endpoint" content="{{ config('services.heddoko.endpoint') }}">
        <meta name="api-id" content="{{ config('services.heddoko.id') }}">
        <meta name="api-access-token" content="{{ Session::get('access-token') }}">
        <meta name="api-refresh-token" content="{{ Session::get('refresh-token') }}">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('css/selectize.css') }}">
		<link rel="stylesheet" href="{{ asset('css/suits-editor.css') .'?'. $version }}">
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
				<h1>Heddoko Inventory <small>v{{ $version }}</small></h1>
			</div>

			{{-- Navigation tabs --}}
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#suits">Suits</a></li>
				<li><a data-toggle="tab" href="#equipment">Equipment</a></li>
				<li><a data-toggle="tab" href="#materials">Materials</a></li>
				<li><a data-toggle="tab" href="#material_types">Material Types</a></li>
				<li><a data-toggle="tab" href="#anatomical_positions">Anatomical Positions</a></li>
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

				<div id="materials" class="tab-pane fade">
				    @include('partials/materials-tab')
				</div>

				<div id="material_types" class="tab-pane fade">
				    @include('partials/material-types-tab')
				</div>

				<div id="anatomical_positions" class="tab-pane fade">
				    @include('partials/anatomical-positions-tab')
				</div>
			</div>

            <br />
            <br />

		</div>

		{{-- Loading dialog --}}
		<div class="modal" id="loading-dialog" data-backdrop="static" data-keyboard="false">
            <h1 style="position: absolute; width: 200px; height: auto; margin: 0 auto; top: 50%; left: 50%; transform: translate(-50%); color: white;">
                Working...
            </h1>
        </div>
	</body>
</html>
