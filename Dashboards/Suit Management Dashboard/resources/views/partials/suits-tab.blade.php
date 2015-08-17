
{{-- Search form --}}
<form ng-submit="UpdatePage()">
    <div class="input-group">
        <span class="input-group-addon" id="search-bar-addon">Search</span>
        <input
            type="text"
            class="form-control"
            placeholder="Enter sensor serial # or physical location"
            aria-describedby="search-bar-addon"
            ng-model="suits_search_term">

        <span class="input-group-btn">
            <button class="btn btn-default" type="button" ng-click="UpdatePage()">Search</button>
            <button
                type="button"
                class="btn btn-default dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    Show <span>@{{ suits_per_page }}</span> suits per page
                    <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" ng-click="suits_per_page=5">Show 5 suits per page</a></li>
                <li><a href="#" ng-click="suits_per_page=10">Show 10 suits per page</a></li>
                <li><a href="#" ng-click="suits_per_page=20">Show 20 suits per page</a></li>
                <li><a href="#" ng-click="suits_per_page=50">Show 50 suits per page</a></li>
                <li><a href="#" ng-click="suits_per_page=100">Show 100 suits per page</a></li>
            </ul>
        </span>
    </div>
</form>
<br />

Total suits matching this query: <span class="badge">@{{total_suits}}</span>
<br />
<br />

{{-- New suit form --}}
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Add new suit</h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-warning" ng-click="new_suit.equipment = []">Reset</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="AddNewSuit()">Submit</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">

        {{-- Input box --}}
        <div class="row">
            <div class="col-sm-12">
                <selectize
                    id="new-suit-select"
                    config="selectize_container.config"
                    ng-model="selectize_container.models['new-suit']"
                    data-suit-id="new-suit"
                    data-equipment-list="{}">
                </selectize>

                <br/>
            </div>
        </div>

        <div class="row">

            {{-- Equipment list --}}
            <div class="col-sm-6">
                <div class="list-group">

                    <div class="list-group-item clearfix" ng-repeat="equipment in new_suit.equipment" ng-class="{'list-group-item-info': equipment == new_suit.current_equipment}" ng-click="new_suit.current_equipment = equipment">
                        <b>@{{equipment.serial_no}}</b>
                        <span class="pull-right">
                            <button class="btn btn-xs btn-warning" ng-click="RemoveExistingSensor(new_suit.equipment, equipment, new_suit.current_equipment)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </span>
                    </div>

                </div>
            </div>

            {{-- Equipment details --}}
            <div class="col-sm-6" ng-hide="new_suit.current_equipment == null">
                Serial #: <b>@{{ new_suit.current_equipment.serial_no }}</b><br/>
                Material: <b>@{{ new_suit.current_equipment.material.name }}</b><br/>
                Location: <b>@{{ new_suit.current_equipment.physical_location }}</b><br/>
            </div>
        </div>
    </div>
</div>

{{-- Pagination controls --}}
<div class="row" style="text-align: center">
    <dir-pagination-controls
        template-url="views/dirPagination.tpl.html"
        on-page-change="UpdatePage(newPageNumber)">
    </dir-pagination-controls>
</div>

{{-- List of suits --}}
<div
    class="panel panel-primary"
    dir-paginate="suit in suits | itemsPerPage: suits_per_page track by suit.id"
    total-items="total_suits"
    current-page="pagination.current">

    <div class="panel-heading">
        <h3 class="panel-title pull-left">
            <span class="badge">@{{$index + 1}}</span> Heddoko Suit with @{{suit.equipment.length}} sensor(s)
        </h3>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-sm btn-danger" ng-click="DeleteSuit(suit.id)">Delete Suit</button>
            <button type="button" class="btn btn-sm btn-success" ng-click="UpdateExistingSuit(suit)">Save</button>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">

        {{-- Input box --}}
        <div class="row">
            <div class="col-sm-12">
                <selectize
                    id="suit-select-@{{$index}}"
                    config="selectize_container.config"
                    ng-model="selectize_container.models[$index]"
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
                            <button class="btn btn-xs btn-warning" ng-click="RemoveEquipmentFromSuit(suit, equipment)">
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
        on-page-change="UpdatePage(newPageNumber)">
    </dir-pagination-controls>
</div>
