
{{-- Search form --}}
@include('partials/_search-form', [
    'model_name' => 'anatomical positions',
    'data_object' => 'anatomical_positions',
    'placeholder' => 'Enter the name or part # of a material'
])
<br />

Total anatomical positions matching this query: <span class="badge">@{{data.anatomical_positions.total}}</span>
<br />
<br />

{{-- New anatomical position form --}}
{{-- Disabled until we actually need this... --}}
<!-- <div class="panel panel-success">

    <div class="panel-heading">
        <h3 class="panel-title pull-left">Add an anatomical position</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-warning" ng-click="">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="">Submit</button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <input type="text" ng-model="data.anatomical_positions.new_item.name" placeholder="Name" class="form-control" />
            </div>
        </div>
    </div>
</div> -->

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="anatomical_positions"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.anatomical_positions.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>

{{-- Materials table --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <tr
            pagination-id="anatomical_positions"
            dir-paginate="anatomical_position in data.anatomical_positions.list | itemsPerPage: data.anatomical_positions.per_page"
            total-items="data.anatomical_positions.total"
            current-page="data.anatomical_positions.current_page">

            <td>@{{ anatomical_position.name }}</td>
        </tr>
    </tbody>
</table>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="anatomical_positions"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.anatomical_positions.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
