@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/inn/inn.js') }}"></script>
@endsection
@section('content')
    <div class="ui raised segment">
        @include('layouts.success')
        @include('layouts.errors')
        <form method="post" action="{{ route('admin.users.store') }}">
            @csrf

            @if(isset($user))
                <input type="hidden" name="user_id" value="{{$user->id}}"/>
            @endif
            <div class="form-groups col-md-12">
                {{--error message--}}
                <div class="form-group col-md-12 ui negative message error-inn" style="display: none;">
                    <div class="header ul">
                    </div>
                </div>
                {{--inn--}}
                <div class="form-group col-md-12 ui fluid action input">
                    <input id="tin_inn" type="number"  name="tin_inn" placeholder="{{__('Enter TIN')}}" value="{{old('tin_inn')}}" @if(!isset($user))required @endif>
                    <a href="javascript:void(0)" onclick="getInn(innAjax)" class="ui button">{{__('Check')}}</a>
                </div>
                <div class="form-group required col-md-6">
                    <label for="name" class="control-label">{{ __('FullName') }}:</label>
                    <input id="name" type="text" class="form-control" name="name" value="@if(isset($user)) {{$user->name}} @else {{old('name')}} @endif" readonly required>
                </div>
                <div class="form-group required col-md-6">
                    <label for="identification" class="control-label">{{ __('INN') }}:</label>
                    <input id="identification" type="text" class="form-control" name="inn" value="@if(isset($user)) {{$user->inn}} @else {{old('inn')}} @endif" readonly required>
                </div>
<!--                <div class="form-group required col-md-6">
                    <label for="username" class="control-label">{{ __('Username') }}:</label>
                    <input id="username" type="text" class="form-control" name="username" value="@if(isset($user)) {{$user->username}} @else {{old('username')}} @endif">
                </div>-->
                <div class="form-group required col-md-6">
                    <label for="email" class="control-label">{{ __('E-Mail Address') }}:</label>
                    <input class="form-control" id="email" autocomplete="off" type="email" name="email" value="@if(isset($user)) {{$user->email}} @else {{old('email')}} @endif"/>
                </div>
                <div class="form-group required col-md-6">
                    <label for="user_roles" class="control-label">{{ __('User Role') }}:</label>
                    <select class="form-control" name="user_role_id">
                        @foreach ($user_roles as $role)
                            <option value="{{$role->id}}" @if (isset($user) && $role->id == $user->user_role_id) selected @endif>{{$role['role_name_'. Config::get('app.locale')]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group required col-md-6">
                    <label for="status" class="control-label">{{ @trans('Status') }}:</label>
                    <select class="form-control" name="status">
                        @foreach ($user_statuses as $key => $status)
                            <option value="{{$status}}" @if (isset($user) && $status == $user->status) selected @endif>{{ __( $key) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="branch" class="control-label">{{ __('Branch') }}:</label>
                    <input id="branch" type="text" class="form-control" name="branch" value="@if(isset($user)) {{$user->branch}} @else {{old('branch')}} @endif">
                </div>
                <div class="form-group col-md-6">
                    <label for="job-position" class="control-label">{{ __('Job Position') }}:</label>
                    <input id="job-position" type="text" class="form-control" name="job_position" value="@if(isset($user)) {{$user->job_position}} @else {{old('job_position')}} @endif">
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">@if(isset($user)) {{__('Edit')}}@else{{__('Create')}}@endif</button>
                </div>
            </div>
        </form>
    </div>

@endsection
