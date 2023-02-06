@can('create-'.$moduleName)
    <div class="creation-buttons">
        <a href="{{ route('admin.'.$moduleName.'.create')}}" class="btn btn-normal">{{$createButtonText}}</a>
    </div>
@endcan
<div class="ui right floated float-right">
    <div class="page-button">
        {{ $obj->withQueryString()->links() }}
    </div>
</div>