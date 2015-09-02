
{{-- Search form --}}
@include('partials/_search-form', [
    'model_name' => 'materials',
    'data_object' => 'materials',
    'placeholder' => 'Enter the name or part # of a material'
])

{{-- New material form --}}
<div class="panel panel-success">

    @include('partials/_new-item-heading', [
        'model_name' => 'material',
        'data_object' => 'materials'
    ])

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
            <th><span class="pull-right">Actions</span></th>
        </tr>
    </thead>
    <tbody>
        <tr
            pagination-id="materials"
            dir-paginate="material in data.materials.list | itemsPerPage: data.materials.per_page"
            total-items="data.materials.total"
            current-page="data.materials.current_page">

            {{-- Name --}}
            <td>
                <div class="editable editable-material-@{{ material.id }}">
                    <span>@{{ material.name }}</span>
                    <input type="text" ng-model="material.name" class="form-control" />
                </div>
            </td>

            {{-- Part # --}}
            <td>
                <div class="editable editable-material-@{{ material.id }}">
                    <span>@{{ material.part_no }}</span>
                    <input type="text" ng-model="material.part_no" class="form-control" />
                </div>
            </td>

            {{-- Material type --}}
            <td>
                <div class="editable editable-material-@{{ material.id }}">
                    <span>@{{ material.material_type.identifier }}</span>
                    <select ng-model="material.material_type_id" class="form-control">
                        <option
                            ng-repeat="material_type in data.material_types.list"
                            ng-selected="material_type.id == material.material_type_id"
                            value="@{{material_type.id}}">

                            @{{material_type.identifier}}
                        </option>
                    </select>
                </div>
            </td>

            {{-- Actions --}}
            <td>
                <span class="actions actions-material-@{{ material.id }} pull-right">
                    <button class="btn btn-xs btn-warning edit" ng-click="data.materials.edit(material.id, 'material')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-xs btn-success update" ng-click="data.materials.update(material, 'material')">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                    <button class="btn btn-xs btn-danger destroy" ng-click="data.materials.destroy(material.id)">
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
        pagination-id="materials"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.materials.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
