@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
        @include('layouts.errors')
        @include('layouts.success')

        <table class="table table-striped list-table">
            <thead>
            <tr>
                <td>{{__('ID')}}</td>
                <td>{{__('user.Name')}}</td>
                <td>{{__('user.Email')}}</td>
                <td>{{__('user.User Role')}}</td>
                <td>{{__('user.Status')}}</td>
                <td>{{__('Actions')}}</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>@if($user->roles->first()){{$user->roles->first()->name}}@endif</td>
                    <td>{{$user->is_active ? 'Active' : 'Not active'}}</td>
                    <td>
                        @include('layouts.admin.action-buttons', ['moduleName' => 'users', 'obj' => $user])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('layouts.admin.table-footer', 
            ['moduleName' => 'users', 'createButtonText' => trans('user.New User'), 'obj' => $users]
        )
    <div>
@endsection
