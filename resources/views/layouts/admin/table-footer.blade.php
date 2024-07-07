@can('create-'.$moduleName)
    <div class="creation-buttons">
        <a href="{{ route('admin.'.$moduleName.'.create')}}" class="btn btn-normal">{{$createButtonText}}</a>
        @if(isset($isExcelExportIncluded) && $isExcelExportIncluded != null) 
            <a href="{{ route('admin.'.$moduleName.'.export.excel', $filters)}}" class="btn btn-primary">{{__('Excel Export')}}</a>
        @endif
    </div>
@endcan
<div class="ui right floated float-right">
    <div class="page-button">
        {{ $obj->withQueryString()->links() }}
    </div>
</div>