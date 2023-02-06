
@can('edit-'.$moduleName)
    <a href="{{ route('admin.'.$moduleName.'.edit', $obj->id)}}" class="icon"><i class="edit icon"></i></a>
@endcan
@can('delete-'.$moduleName)
    <form action="{{ route('admin.'.$moduleName.'.destroy', $obj)}}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        
        <button type="submit" data-toggle="confirmation"><i class="trash alternate outline icon"></i></a>
    </form>
@endcan