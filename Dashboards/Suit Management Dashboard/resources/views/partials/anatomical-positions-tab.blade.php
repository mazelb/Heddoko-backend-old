
{{-- Search form --}}
@include('partials/_search-form', [
    'model_name' => 'anatomical positions',
    'data_object' => 'anatomical_positions',
    'placeholder' => 'Enter the name or part # of a material'
])

{{-- New anatomical position form --}}
<div class="panel panel-success">

    @include('partials/_new-item-heading', [
        'model_name' => 'anatomical position',
        'data_object' => 'anatomical_positions'
    ])

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <input type="text" ng-model="data.anatomical_positions.new_item.id" placeholder="ID" class="form-control" />
            </div>
            <div class="col-sm-10">
                <input type="text" ng-model="data.anatomical_positions.new_item.name" placeholder="Name" class="form-control" />
            </div>
        </div>
    </div>
</div>

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
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <tr
            pagination-id="anatomical_positions"
            dir-paginate="anatomical_position in data.anatomical_positions.list | itemsPerPage: data.anatomical_positions.per_page"
            total-items="data.anatomical_positions.total"
            current-page="data.anatomical_positions.current_page">

            <td>@{{ anatomical_position.id }}</td>
            <td>
                @{{ anatomical_position.name }}
                <span class="pull-right delete-button">
                    <button class="btn btn-xs btn-warning" ng-click="data.anatomical_positions.destroy(anatomical_position.id)">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </span>
            </td>
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
