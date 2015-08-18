
{{-- Search form --}}
<form ng-submit="data.suits.updatePage()">
    <div class="input-group">
        <span class="input-group-addon" id="search-bar-addon">Search</span>
        <input
            type="text"
            class="form-control"
            placeholder="Enter sensor serial # or physical location"
            aria-describedby="search-bar-addon"
            ng-model="data.suits.search_term">

        <span class="input-group-btn">
            <button class="btn btn-default" type="button" ng-click="data.suits.updatePage()">Search</button>
            <button
                type="button"
                class="btn btn-default dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    Show <span>@{{ data.suits.per_page }}</span> suits per page
                    <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" ng-click="data.suits.per_page=5">Show 5 suits per page</a></li>
                <li><a href="#" ng-click="data.suits.per_page=10">Show 10 suits per page</a></li>
                <li><a href="#" ng-click="data.suits.per_page=20">Show 20 suits per page</a></li>
                <li><a href="#" ng-click="data.suits.per_page=50">Show 50 suits per page</a></li>
                <li><a href="#" ng-click="data.suits.per_page=100">Show 100 suits per page</a></li>
            </ul>
        </span>
    </div>
</form>
<br />

Total suits matching this query: <span class="badge">@{{data.suits.total}}</span>
<br />
<br />

{{-- New suit form --}}
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Add new suit</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-warning" ng-click="data.suits.new_item.reset()">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="data.suits.add()">Submit</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">

        {{-- Input box --}}
        <div class="row">
            <div class="col-sm-12">
                <selectize
                    id="new-suit-select"
                    config="data.suits.selectize.config"
                    ng-model="data.suits.selectize.models['new-item']"
                    data-item-id="new-item"
                    data-equipment-list="{}">
                </selectize>

                <br/>
            </div>
        </div>

        <div class="row">

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

            {{-- Equipment details --}}
            <div class="col-sm-6" ng-hide="data.suits.new_item.current_equipment== null">
                Serial #: <b>@{{ data.suits.new_item.current_equipment.serial_no }}</b><br/>
                Material: <b>@{{ data.suits.new_item.current_equipment.material.name }}</b><br/>
                Location: <b>@{{ data.suits.new_item.current_equipment.physical_location }}</b><br/>
            </div>
        </div>
    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.suits.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>

{{-- List of suits --}}
<div
    class="panel panel-primary"
    dir-paginate="suit in data.suits.list | itemsPerPage: data.suits.per_page track by suit.id"
    total-items="data.suits.total"
    current-page="pagination.current">

    <div class="panel-heading">
        <h3 class="panel-title pull-left">
            <span class="badge">@{{$index + 1}}</span> Heddoko Suit with @{{suit.equipment.length}} sensor(s)
        </h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-danger" ng-click="data.suits.destroy(suit.id)">Delete Suit</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="data.suits.update(suit)">Save</button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">

        {{-- Input box --}}
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
                    <div class="list-group-item clearfix" ng-repeat="equipment in suit.equipment" ng-class="{'list-group-item-info': equipment == suit.current_equipment}" ng-click="$parent.suit.current_equipment = equipment">
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
            <div class="col-sm-6" ng-hide="suit.current_equipment == null">
                Serial #: <b>@{{ suit.current_equipment.serial_no }}</b><br/>
                Material: <b>@{{ suit.current_equipment.material.name }}</b><br/>
                Location: <b>@{{ suit.current_equipment.physical_location }}</b><br/>
            </div>
        </div>

    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        template-url="views/dirPagination.tpl.html"
        on-page-change="data.suits.updatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
