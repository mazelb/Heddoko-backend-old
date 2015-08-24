
{{-- Search form --}}
@include('partials/_search-form', [
    'model_name' => 'material types',
    'data_object' => 'material_types',
    'placeholder' => 'Enter an identifier'
])

{{-- New material type form --}}
<div class="panel panel-success">

    @include('partials/_new-item-heading', [
        'model_name' => 'material type',
        'data_object' => 'material_types'
    ])

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <input type="text" ng-model="data.material_types.new_item.identifier" placeholder="Name" class="form-control" />
            </div>
        </div>
    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="material_types"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.material_types.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>

{{-- Material types table --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th>Identifier</th>
        </tr>
    </thead>
    <tbody>
        <tr
            pagination-id="material_types"
            dir-paginate="material_type in data.material_types.list | itemsPerPage: data.material_types.per_page"
            total-items="data.material_types.total"
            current-page="data.material_types.current_page">

            <td>@{{ material_type.identifier }}</td>
        </tr>
    </tbody>
</table>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="material_types"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.material_types.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
