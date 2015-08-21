
{{-- Search form --}}
<form ng-submit="data.anatomical_positions.updatePage()">
    <div class="input-group">
        <span class="input-group-addon" id="search-bar-addon">Search</span>
        <input
            type="text"
            class="form-control"
            placeholder="Enter the name or part # of a material"
            aria-describedby="search-bar-addon"
            ng-model="data.anatomical_positions.search_term">

        <span class="input-group-btn">
            <button class="btn btn-default" type="button" ng-click="data.anatomical_positions.updatePage()">Search</button>
            <button
                type="button"
                class="btn btn-default dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    Show <span>@{{ data.anatomical_positions.per_page }}</span> anatomical positions per page
                    <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" ng-click="data.anatomical_positions.per_page=5">Show 5 anatomical positions per page</a></li>
                <li><a href="#" ng-click="data.anatomical_positions.per_page=10">Show 10 anatomical positions per page</a></li>
                <li><a href="#" ng-click="data.anatomical_positions.per_page=20">Show 20 anatomical positions per page</a></li>
                <li><a href="#" ng-click="data.anatomical_positions.per_page=50">Show 50 anatomical positions per page</a></li>
                <li><a href="#" ng-click="data.anatomical_positions.per_page=100">Show 100 anatomical positions per page</a></li>
            </ul>
        </span>
    </div>
</form>
<br />

Total anatomical positions matching this query: <span class="badge">@{{data.anatomical_positions.total}}</span>
<br />
<br />

{{-- New anatomical position form --}}
<div class="panel panel-success">

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
