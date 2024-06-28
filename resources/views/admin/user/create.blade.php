@extends('layouts.app')
@section('content')
    <div class="ui raised segment">
        @include('layouts.success')
        @include('layouts.errors')
        <form method="post" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="form-groups col-md-12">
                <div class="form-group required col-md-6">
                    <label for="name" class="control-label">{{ __('user.Name') }}:</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required>
                </div>
                <div class="form-group required col-md-6">
                    <label for="email" class="control-label">{{ __('user.Email') }}:</label>
                    <input class="form-control" id="email" autocomplete="off" type="email" name="email" value="{{old('email')}}"/>
                </div>
                <div class="form-group required col-md-6">
                    <label for="user_roles" class="control-label">{{ __('Role') }}:</label>
                    <select class="form-control" name="role_id" id="user_roles">
                        @foreach ($roles as $role)
                            <option value="0">
                                {{__('Not selected')}}
                            </option>
                            <option value="{{$role->id}}" @if ($role->id == old('role_id')) selected @endif>
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
                        <option value="false" @if (old('role_id') === 'false') selected @endif>
                            {{__('Not Active')}}
                        </option>
                    </select>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                </div>
            </div>
        </form>
    </div>

@endsection
