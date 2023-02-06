@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
        @include('layouts.errors')
        @include('layouts.success')

        <table class="table table-striped list-table">
            <thead>
            <tr>
                <td>{{__('ID')}}</td>
                <td>{{__('Name')}}</td>
                <td>{{__('Actions')}}</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        @include('layouts.admin.action-buttons', ['moduleName' => 'roles', 'obj' => $role])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('layouts.admin.table-footer', 
            ['moduleName' => 'roles', 'createButtonText' => trans('user.New Role'), 'obj' => $roles]
        )
    <div>
@endsection
