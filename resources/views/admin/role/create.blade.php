@extends('layouts.app')
@section('content')
    <div class="ui raised segment">
        @include('layouts.success')
        @include('layouts.errors')
        <form method="post" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="form-groups col-md-12">
                <div class="form-group required col-md-12">
                    <label for="name" class="control-label">{{ __('Name') }}:</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required>
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
                            <td><input class="ui checkbox" type="checkbox" name="permissions[{{$permission->id}}]"/></td>
                        </tr>
                    @endforeach
                </table>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                </div>
            </div>
        </form>
    </div>

@endsection
