
{{-- Search form --}}
<form ng-submit="data.equipment.updatePage()">
    <div class="input-group">
        <span class="input-group-addon" id="search-bar-addon">Search</span>
        <input
            type="text"
            class="form-control"
            placeholder="Enter the serial # or location of an equipment"
            aria-describedby="search-bar-addon"
            ng-model="data.equipment.search_term">

        <span class="input-group-btn">
            <button class="btn btn-default" type="button" ng-click="data.equipment.updatePage()">Search</button>
            <button
                type="button"
                class="btn btn-default dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    Show <span>@{{ data.equipment.per_page }}</span> equipment per page
                    <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" ng-click="data.equipment.per_page=5">Show 5 equipment per page</a></li>
                <li><a href="#" ng-click="data.equipment.per_page=10">Show 10 equipment per page</a></li>
                <li><a href="#" ng-click="data.equipment.per_page=20">Show 20 equipment per page</a></li>
                <li><a href="#" ng-click="data.equipment.per_page=50">Show 50 equipment per page</a></li>
                <li><a href="#" ng-click="data.equipment.per_page=100">Show 100 equipment per page</a></li>
            </ul>
        </span>
    </div>
</form>
<br />

Total equipment matching this query: <span class="badge">@{{data.equipment.total}}</span>
<br />
<br />

{{-- New equipment form --}}
<h3>Hello</h3>
<p>Use this page to view the status of stored equipment</p>
<p>You can also upload a CSV file to add to this page</p>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Add equipment</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-warning" ng-click="ResetNewEquipmentForm()">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="SubmitNewEquipmentForm()">Submit</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <select
                    ng-model="new_equipment_data.material_id"
                    ng-selected="new_equipment_data.material_id"
                    ng-options="material.name for material in materials_list"
                    class="form-control">
                </select>
            </div>
            <div class="col-sm-3">
                <input type="text" ng-model="new_equipment_data.serial_no" class="form-control" placeholder="Serial #" />
            </div>
            <div class="col-sm-3">
                <input type="text" ng-model="new_equipment_data.physical_location" class="form-control" placeholder="Physical location" />
            </div>
            <div class="col-sm-3">
                @{{new_equipment_data.status_id}}
                <select
                    ng-model="new_equipment_data.status_id"
                    ng-selected="new_equipment_data.status_id"
                    ng-options="status.name for status in status_types track by status.id"
                    class="form-control">
                </select>
            </div>
        </div>
    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="equipment"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.equipment.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>

{{-- Equipment table --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th>Material</th>
            <th>Serial #</th>
            <th>Location</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        {{--<tr ng-repeat="equipment in data.equipment.list">--}}
        <tr
            pagination-id="equipment"
            dir-paginate="equipment in data.equipment.list | itemsPerPage: data.equipment.per_page"
            total-items="data.equipment.total"
            current-page="data.equipment.current_page">

            <td>@{{ equipment.material.name }}</td>
            <td>@{{ equipment.serial_no }}</td>
            <td>@{{ equipment.physical_location }}</td>
            <td>@{{ equipment.status.name }}</td>
        </tr>
    </tbody>
</table>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="equipment"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.equipment.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
