<!DOCTYPE html>
<html>
	<head>
		<title>Heddoko Inventory v{{ $version }}</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ url('js/admin.js') }}"></script>
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
				    @include('admin/partials/suits-tab')
				</div>

				<div id="equipment" class="tab-pane fade">
				    @include('admin/partials/equipment-tab')
				</div>

				<div id="materials" class="tab-pane fade">
				    @include('admin/partials/materials-tab')
				</div>

				<div id="material_types" class="tab-pane fade">
				    @include('admin/partials/material-types-tab')
				</div>

				<div id="anatomical_positions" class="tab-pane fade">
				    @include('admin/partials/anatomical-positions-tab')
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
