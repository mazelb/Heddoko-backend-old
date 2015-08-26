
<form ng-submit="data.{{ $data_object }}.updatePage()">
    <div class="input-group">
        <span class="input-group-btn">
            <button
                class="btn btn-default"
                type="button"
                ng-click="data.{{ $data_object }}.search_term='';data.{{ $data_object }}.updatePage()">
                    Clear
            </button>
        </span>

        {{-- Search input --}}
        <input
            type="text"
            class="form-control"
            placeholder="{{ $placeholder }}"
            aria-describedby="search-bar-addon"
            ng-model="data.{{ $data_object }}.search_term">

        {{-- Search & per page buttons --}}
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" ng-click="data.{{ $data_object }}.updatePage()">Search</button>
            <button
                type="button"
                class="btn btn-default dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    Show <span>{{ data.<?= $data_object ?>.per_page }}</span> {{ $model_name }} per page
                    <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" ng-click="data.{{ $data_object }}.per_page=5">Show 5 {{ $model_name }} per page</a></li>
                <li><a href="#" ng-click="data.{{ $data_object }}.per_page=10">Show 10 {{ $model_name }} per page</a></li>
                <li><a href="#" ng-click="data.{{ $data_object }}.per_page=20">Show 20 {{ $model_name }} per page</a></li>
                <li><a href="#" ng-click="data.{{ $data_object }}.per_page=50">Show 50 {{ $model_name }} per page</a></li>
                <li><a href="#" ng-click="data.{{ $data_object }}.per_page=100">Show 100 {{ $model_name }} per page</a></li>
            </ul>
        </span>
    </div>
</form>
<br />

Total {{ $model_name }} matching this query: <span class="badge">{{ data.<?= $data_object ?>.total }}</span>
<br />
<br />
