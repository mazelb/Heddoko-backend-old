
{{-- Search form --}}
@include('partials/_search-form', [
    'model_name' => 'equipment',
    'data_object' => 'equipment',
    'placeholder' => 'Enter the serial # or location of an equipment'
])
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
            <button type="button" class="btn btn-sm btn-warning" ng-click="data.equipment.new_item.reset()">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="data.equipment.create()">Submit</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <select ng-model="data.equipment.new_item.material_id" class="form-control">
                    <option value="0">-- select a material --</option>
                    <option ng-repeat="material in data.materials.list" value="@{{material.id}}">@{{material.name}}</option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="text" ng-model="data.equipment.new_item.serial_no" class="form-control" placeholder="Serial #" />
            </div>
            <div class="col-sm-3">
                <input type="text" ng-model="data.equipment.new_item.physical_location" class="form-control" placeholder="Physical location" />
            </div>
            <div class="col-sm-3">
                <select ng-model="data.equipment.new_item.status_id" class="form-control">
                    <option value="0">-- select a status --</option>
                    <option ng-repeat="status in data.statuses.list" value="@{{status.id}}">@{{status.name}}</option>
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
