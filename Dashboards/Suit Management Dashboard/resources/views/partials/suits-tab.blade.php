
{{-- Search form --}}
@include('partials/_search-form', [
    'model_name' => 'suits',
    'data_object' => 'suits',
    'placeholder' => 'Enter a MAC address, a physical location, or a sensor\'s serial #'
])

{{-- New suit form --}}
<div class="panel panel-success">

    @include('partials/_new-item-heading', [
        'model_name' => 'suit',
        'data_object' => 'suits'
    ])

    <div class="panel-body">
        <div class="row">

            {{-- Equipment details --}}
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">

                        {{-- Equipment search form --}}
                        <selectize
                            id="new-suit-select"
                            config="data.suits.selectize.config"
                            ng-model="data.suits.selectize.models['new-item']"
                            data-suit-id="new-item"
                            data-equipment-list="{}">
                        </selectize>
                        <hr />

                        {{-- Status --}}
                        <select ng-model="data.suits.new_item.status_id" class="form-control">
                            <option value="0">-- select a status --</option>
                            <option ng-repeat="status in data.statuses.list" value="@{{status.id}}">
                                @{{status.name}}
                            </option>
                        </select>
                        <br>

                        {{-- Serial Number --}}
                        <input
                            type="text"
                            class="form-control"
                            ng-model="data.suits.new_item.serial_no"
                            placeholder="Serial #" />
                        <br />

                        {{-- MAC Address --}}
                        <input
                            type="text"
                            class="form-control"
                            ng-model="data.suits.new_item.mac_address"
                            placeholder="MAC address" />
                        <br />

                        {{-- Physical Location --}}
                        <input
                            type="text"
                            class="form-control"
                            ng-model="data.suits.new_item.physical_location"
                            placeholder="Physical location" />
                        <br>

                        {{-- Notes --}}
                        <textarea ng-model="data.suits.new_item.notes" class="form-control" placeholder="Notes"></textarea>
                    </div>
                </div>
            </div>

            {{-- Equipment list --}}
            <div class="col-sm-6">
                <div class="list-group">

                    <div
                        class="list-group-item clearfix"
                        ng-repeat="equipment in data.suits.new_item.equipment"
                        ng-class="{'list-group-item-info': equipment == data.suits.new_item.current_equipment}"
                        ng-click="data.suits.new_item.current_equipment = equipment">

                        <b>@{{equipment.serial_no}}</b>
                        <span class="pull-right">
                            <button class="btn btn-xs btn-warning"
                                ng-click="RemoveExistingSensor(data.suits.new_item.equipment, equipment, data.suits.new_item.current_equipment)">

                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="suits"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.suits.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>

{{-- List of suits --}}
<div
    class="panel panel-primary"
    pagination-id="suits"
    dir-paginate="suit in data.suits.list | itemsPerPage: data.suits.per_page"
    total-items="data.suits.total"
    current-page="data.suits.current_page">

    <div class="panel-heading">
        <h3 class="panel-title pull-left">
            <span class="badge">@{{$index + 1}}</span> Heddoko Suit with @{{suit.equipment.length}} sensor(s)
        </h3>

        {{-- Action buttons --}}
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-success" ng-click="data.suits.update(suit)">
                <span class="glyphicon glyphicon-floppy-disk"></span>
            </button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="data.suits.edit(suit.id, 'suit')">
                <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button type="button" class="btn btn-sm btn-danger" ng-click="data.suits.destroy(suit.id)">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">

        {{-- Equipment search form --}}
        <div class="row">
            <div class="col-sm-12">
                <selectize
                    id="suit-select-@{{$index}}"
                    config="data.suits.selectize.config"
                    ng-model="data.suits.selectize.models[$index]"
                    data-suit-id="@{{suit.id}}"
                    data-equipment-list="@{{suit.equipment}}">
                </selectize>

                <br/>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="list-group">

                    {{-- Equipment list --}}
                    <div
                        class="list-group-item clearfix"
                        ng-repeat="equipment in suit.equipment"
                        ng-class="{'list-group-item-info': equipment == suit.current_equipment}"
                        ng-click="$parent.suit.current_equipment = equipment">

                        <b>@{{equipment.serial_no}}</b>
                        <span class="pull-right">
                            <button class="btn btn-xs btn-warning" ng-click="data.suits.removeEquipment(suit, equipment)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Equipment details --}}
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-3" style="text-align: right;">
                        Suit details:
                    </div>
                    <div class="col-sm-9">
                        <div class="editable editable-suit-@{{ suit.id }}">

                            <span>MAC Address: <b>@{{ suit.mac_address }}</b></span>
                            <input type="text" class="form-control" ng-model="suit.mac_address" placeholder="MAC address" />
                            <br />

                            <span>Physical location: <b>@{{ suit.physical_location }}</b></span>
                            <input type="text" class="form-control" ng-model="suit.physical_location" placeholder="Physical location" />
                        </div>
                    </div>
                </div>
                <div class="row" ng-hide="suit.current_equipment == null">
                    <hr />
                    <div class="col-sm-3" style="text-align: right;">
                        Selected equipment:
                    </div>
                    <div class="col-sm-9">
                        Serial #: <b>@{{ suit.current_equipment.serial_no }}</b><br/>
                        Material: <b>@{{ suit.current_equipment.material.name }}</b><br/>
                        Location: <b>@{{ suit.current_equipment.physical_location }}</b>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        pagination-id="suits"
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.suits.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
