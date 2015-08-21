
{{-- Search form --}}
<form ng-submit="data.materials.updatePage()">
    <div class="input-group">
        <span class="input-group-addon" id="search-bar-addon">Search</span>
        <input
            type="text"
            class="form-control"
            placeholder="Enter the name or part # of a material"
            aria-describedby="search-bar-addon"
            ng-model="data.materials.search_term">

        <span class="input-group-btn">
            <button class="btn btn-default" type="button" ng-click="data.materials.updatePage()">Search</button>
            <button
                type="button"
                class="btn btn-default dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    Show <span>@{{ data.materials.per_page }}</span> materials per page
                    <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" ng-click="data.materials.per_page=5">Show 5 materials per page</a></li>
                <li><a href="#" ng-click="data.materials.per_page=10">Show 10 materials per page</a></li>
                <li><a href="#" ng-click="data.materials.per_page=20">Show 20 materials per page</a></li>
                <li><a href="#" ng-click="data.materials.per_page=50">Show 50 materials per page</a></li>
                <li><a href="#" ng-click="data.materials.per_page=100">Show 100 materials per page</a></li>
            </ul>
        </span>
    </div>
</form>
<br />

Total materials matching this query: <span class="badge">@{{data.materials.total}}</span>
<br />
<br />

{{-- New material form --}}
<h3>Hello</h3>
<p>Use this page to view the status of stored equipment</p>
<p>You can also upload a CSV file to add to this page</p>
<div class="panel panel-success">

    <div class="panel-heading">
        <h3 class="panel-title pull-left">Add a material</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-warning" ng-click="">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="">Submit</button>
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
                <select
                    ng-model="data.materials.new_item.material_type_id"
                    ng-selected="data.materials.new_item.material_type_id"
                    ng-options="material_type.identifier for material_type in data.material_type.list track by material_type.id"
                    class="form-control">
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
