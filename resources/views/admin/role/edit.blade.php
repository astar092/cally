@extends('layouts.app')
@section('content')
    <div class="ui raised segment">
        @include('layouts.success')
        @include('layouts.errors')
        <form method="post" action="{{ route('admin.roles.update', $role->id) }}">
            @csrf
            @method('PUT')
            <div class="form-groups col-md-12">
                <div class="form-group required col-md-12">
                    <label for="name" class="control-label">{{ __('Name') }}:</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$role->name}}" required>
                </div>
                <hr />
                <h1>{{__('user.Permissions')}}</h1>
                <table class="ui table list-table">
                    <thead>
                    <tr>
                        <td>{{__('user.Title')}}</td>
                        <td></td>
                    </tr>
                    </thead>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{__($permission->name)}}</td>
                            <td><input 
                                class="ui checkbox"
                                type="checkbox" 
                                name="permissions[{{$permission->id}}]"
                                @if(in_array($permission->id, $selectedPermissionIds))
                                checked
                                @endif
                                />
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">{{__('Edit')}}</button>
                </div>
            </div>
        </form>
    </div>
@endsection