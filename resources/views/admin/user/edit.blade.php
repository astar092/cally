@extends('layouts.app')
@section('content')
    <div class="ui raised segment">
        @include('layouts.success')
        @include('layouts.errors')
        <form method="post" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-groups col-md-12">
                <div class="form-group required col-md-6">
                    <label for="name" class="control-label">{{ __('user.Name') }}:</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required>
                </div>
                <div class="form-group required col-md-6">
                    <label for="email" class="control-label">{{ __('user.Email') }}:</label>
                    <input class="form-control" id="email" autocomplete="off" type="email" name="email" value="{{$user->email}}"/>
                </div>
                <div class="form-group required col-md-6">
                    <label for="user_roles" class="control-label">{{ __('Role') }}:</label>
                    <select class="form-control" name="role_id">
                        @foreach ($roles as $role)
                            <option value="0">
                                {{__('Not selected')}}
                            </option>
                            <option value="{{$role->id}}" @if ($role->id == $user->roles->first()?->id) selected @endif>
                                {{$role->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group required col-md-6">
                    <label for="status" class="control-label">{{ __('Status') }}:</label>
                    <select class="form-control" name="is_active" id="status">
                        <option value="true">
                            {{__('Active')}}
                        </option>
                        <option value="false" @if (!$user->is_active) selected @endif>
                            {{__('Not Active')}}
                        </option>
                    </select>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">{{__('Edit')}}</button>
                </div>
            </div>
        </form>
    </div>
@endsection