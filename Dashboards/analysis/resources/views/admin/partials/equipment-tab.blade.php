
{{-- Search form --}}
@include('admin/partials/_search-form', [
    'model_name' => 'equipment',
    'data_object' => 'equipment',
    'placeholder' => 'Enter the serial # or location of an equipment'
])

{{-- New equipment form --}}
<div class="panel panel-success">

    @include('admin/partials/_new-item-heading', [
        'model_name' => 'equipment',
        'data_object' => 'equipment'
    ])

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4">
                <select ng-model="data.equipment.new_item.material_id" class="form-control">
                    <option value="0">-- select a material --</option>
                    <option ng-repeat="material in data.materials.list" value="@{{material.id}}">
                        @{{material.name}} (@{{material.part_no}})
                    </option>
                </select>
            </div>

            <div class="col-sm-4">
                <select ng-model="data.equipment.new_item.anatomical_position_id" class="form-control">
                    <option value="0">-- select an anatomical position --</option>
                    <option ng-repeat="position in data.anatomical_positions.list" value="@{{position.id}}">
                        @{{position.name}}
                    </option>
                </select>
            </div>

            <div class="col-sm-4">
                <select ng-model="data.equipment.new_item.status_id" class="form-control">
                    <option value="0">-- select a status --</option>
                    <option ng-repeat="status in data.statuses.list" value="@{{status.id}}">
                        @{{status.name}}
                    </option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-2">
                <select ng-model="data.equipment.new_item.prototype" class="form-control">
                    <option value="0">-- select a prototype --</option>
                    <option ng-repeat="prototype in data.prototypes.list" value="@{{prototype.id}}">
                        @{{prototype.name}}
                    </option>
                </select>
            </div>
            <div class="col-sm-2">
                <select ng-model="data.equipment.new_item.condition" class="form-control">
                    <option value="0">-- select a condition --</option>
                    <option ng-repeat="condition in data.conditions.list" value="@{{condition.id}}">
                        @{{condition.name}}
                    </option>
                </select>
            </div>
            <div class="col-sm-2">
                <select ng-model="data.equipment.new_item.numbers" class="form-control">
                    <option value="0">-- select a number --</option>
                    <option ng-repeat="number in data.numbers.list" value="@{{number.id}}">
                        @{{number.name}}
                    </option>
                </select>
            </div>
            <div class="col-sm-2">
                <select ng-model="data.equipment.new_item.heats_shrink" class="form-control">
                    <option value="0">-- select a number --</option>
                    <option ng-repeat="heats_shrink in data.heats_shrinks.list" value="@{{heats_shrink.id}}">
                        @{{heats_shrink.name}}
                    </option>
                </select>
            </div>
            <div class="col-sm-2">
                <select ng-model="data.equipment.new_item.ship" class="form-control">
                    <option value="0">-- select a ready ship --</option>
                    <option ng-repeat="ship in data.ships.list" value="@{{ship.id}}">
                        @{{ship.name}}
                    </option>
                </select>
            </div>
            <div class="col-sm-2">
                <selectize
                    id="new-equipment-select"
                    config="data.equipment.selectize.config"
                    ng-model="data.equipment.new_item.verified_by">
                </selectize>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
                <input type="text" ng-model="data.equipment.new_item.serial_no" class="form-control" placeholder="Serial #" />
            </div>

            <div class="col-sm-3">
                <input type="text" ng-model="data.equipment.new_item.mac_address" class="form-control" placeholder="MAC Address" />
            </div>

            <div class="col-sm-6">
                <input type="text" ng-model="data.equipment.new_item.physical_location" class="form-control" placeholder="Physical location" />
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-12">
                <textarea ng-model="data.equipment.new_item.notes" class="form-control" placeholder="Notes"></textarea>
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
            <th>Prototype</th>
            <th><span class="pull-right">Actions</span></th>
        </tr>
    </thead>
    <tbody>
        <tr
            pagination-id="equipment"
            dir-paginate="equipment in data.equipment.list | itemsPerPage: data.equipment.per_page"
            total-items="data.equipment.total"
            current-page="data.equipment.current_page">

            <td>
                <div class="editable editable-equipment-@{{ equipment.id }}">
                    <span>@{{ equipment.material.name }}</span>
                    <select ng-model="equipment.material_id" class="form-control">
                        <option
                            ng-repeat="material in data.materials.list"
                            ng-selected="material.id == equipment.material_id"
                            value="@{{material.id}}">

                            @{{material.name}} (@{{material.part_no}})
                        </option>
                    </select>
                </div>
            </td>
            <td>
                <div class="editable editable-equipment-@{{ equipment.id }}">
                    <span>@{{ equipment.serial_no }}</span>
                    <input type="text" ng-model="equipment.serial_no" class="form-control" />
                </div>
            </td>
            <td>
                <div class="editable editable-equipment-@{{ equipment.id }}">
                    <span>@{{ equipment.physical_location }}</span>
                    <input type="text" ng-model="equipment.physical_location" class="form-control" />
                </div>
            </td>
            <td>
                <div class="editable editable-equipment-@{{ equipment.id }}">
                    <span>@{{ equipment.status.name }}</span>
                    <select ng-model="equipment.status_id" class="form-control">
                        <option
                            ng-repeat="status in data.statuses.list"
                            ng-selected="status.id == equipment.status_id"
                            value="@{{status.id}}">

                            @{{status.name}}
                        </option>
                    </select>
                </div>
            </td>
            <td>
                <div class="editable editable-equipment-@{{ equipment.id }}">
                    <span>@{{ equipment.prototype.name }}</span>
                    <select ng-model="equipment.prototype" class="form-control">
                        <option
                                ng-repeat="prototype in data.prototypes.list"
                                ng-selected="prototype.id == equipment.prototype"
                                value="@{{prototype.id}}">

                            @{{prototype.name}}
                        </option>
                    </select>
                </div>
            </td>
            <td>
                <span class="actions actions-equipment-@{{ equipment.id }} pull-right">
                    <button class="btn btn-xs btn-warning edit" ng-click="data.equipment.edit(equipment.id, 'equipment')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-xs btn-success update" ng-click="data.equipment.update(equipment, 'equipment')">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                    <button class="btn btn-xs btn-danger destroy" ng-click="data.equipment.destroy(equipment.id)">
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
        pagination-id="equipment"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.equipment.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
