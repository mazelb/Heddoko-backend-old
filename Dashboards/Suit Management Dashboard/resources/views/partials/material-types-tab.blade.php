
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
            <th><span class="pull-right">Actions</span></th>
        </tr>
    </thead>
    <tbody>
        <tr
            pagination-id="material_types"
            dir-paginate="material_type in data.material_types.list | itemsPerPage: data.material_types.per_page"
            total-items="data.material_types.total"
            current-page="data.material_types.current_page">

            <td>
                <div class="editable editable-material_type-@{{ material_type.id }}">
                    <span>@{{ material_type.identifier }}</span>
                    <input type="text" ng-model="material_type.identifier" class="form-control" />
                </div>
            </td>
            <td>
                <span class="actions actions-material_type-@{{ material_type.id }} pull-right">
                    <button class="btn btn-xs btn-warning edit" ng-click="data.material_types.edit(material_type.id, 'material_type')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-xs btn-success update" ng-click="data.material_types.update(material_type, 'material_type')">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                    <button class="btn btn-xs btn-danger destroy" ng-click="data.material_types.destroy(material_type.id)">
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
        pagination-id="material_types"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.material_types.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
