
<div class="panel-heading">
    <h3 class="panel-title pull-left">Add a new {{ $model_name }}</h3>
    <div class="btn-group pull-right" role="group">
        <button type="button" class="btn btn-sm btn-warning" ng-click="data.{{ $data_object }}.new_item.reset()">Reset</button>
        <button type="button" class="btn btn-sm btn-success" ng-click="data.{{ $data_object }}.create()">Submit</button>
    </div>
    <div class="clearfix"></div>
</div>
