
{{-- Search form --}}
@include('partials/_search-form', [
    'model_name' => 'materials',
    'data_object' => 'materials',
    'placeholder' => 'Enter the name or part # of a material'
])

{{-- New material form --}}
<h3>Hello</h3>
<p>Use this page to view the status of stored equipment</p>
<p>You can also upload a CSV file to add to this page</p>
<div class="panel panel-success">

    <div class="panel-heading">
        <h3 class="panel-title pull-left">Add a material</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-warning" ng-click="data.materials.new_item.reset()">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="data.materials.create()">Submit</button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4">
                <input type="text" ng-model="data.materials.new_item.name" class="form-control" placeholder="Name" />
            </div>
            <div class="col-sm-4">
                <input type="text" ng-model="data.materials.new_item.part_no" class="form-control" placeholder="Part #" />
            </div>
            <div class="col-sm-4">
                <select ng-model="data.materials.new_item.material_type_id" class="form-control">
                    <option value="0">-- select a material type --</option>
                    <option ng-repeat="material_type in data.material_types.list" value="@{{material_type.id}}">@{{material_type.identifier}}</option>
                </select>
            </div>
        </div>
    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="materials"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.materials.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>

{{-- Materials table --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Part #</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
        {{--<tr ng-repeat="equipment in data.equipment.list">--}}
        <tr
            pagination-id="materials"
            dir-paginate="material in data.materials.list | itemsPerPage: data.materials.per_page"
            total-items="data.materials.total"
            current-page="data.materials.current_page">

            <td>@{{ material.name }}</td>
            <td>@{{ material.part_no }}</td>
            <td>@{{ material.material_type.identifier }}</td>
        </tr>
    </tbody>
</table>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="materials"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.materials.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
