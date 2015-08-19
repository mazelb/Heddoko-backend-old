
<h3>hello</h3>
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
                <!--<input type="text" ng-model="new_equipment_data.material_id" />-->
                <select
                    ng-model="new_equipment_data.material_id"
                    ng-selected="new_equipment_data.material_id"
                    ng-options="material.name for material in materials_list">
                </select>
            </div>
            <div class="col-sm-3">
                <input type="text" ng-model="new_equipment_data.serial_no" />
            </div>
            <div class="col-sm-3">
                <input type="text" ng-model="new_equipment_data.physical_location" />
            </div>
            <div class="col-sm-3">
                @{{new_equipment_data.status_id}}
                <select
                    ng-model="new_equipment_data.status_id"
                    ng-selected="new_equipment_data.status_id"
                    ng-options="status.name for status in status_types track by status.id">
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
