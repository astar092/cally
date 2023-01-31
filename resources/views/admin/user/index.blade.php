@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
        @include('layouts.errors')
        @include('layouts.success')

        <table class="table table-striped list-table">
            <thead>
            <tr>
                <td>{{__('ID')}}</td>
                <td>{{@trans('user.Name')}}</td>
                <td>{{@trans('user.Email')}}</td>
                <td>{{@trans('user.User Role')}}</td>
                <td>{{@trans('user.Status')}}</td>
                <td>{{__('Actions')}}</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{$users->firstItem() + $index}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->user_role['role_name_'. Config::get('app.locale')] ?? ''}}</td>
                    <td></td>
                    <td>
                        @can('edit-users')
                            <a href="{{ route('admin.users.edit', $user->id)}}" class="icon"><i class="edit icon"></i></a>
                        @endcan
                        @can('delete-users')
                            <form action="{{ route('admin.users.destroy', $user)}}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" data-toggle="confirmation"><i class="trash alternate outline icon"></i></a>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @can('user', 'create')
            <div class="creation-buttons">
                <a href="{{ route('admin.users.create')}}" class="btn btn-normal">{{@trans('user.New User')}}</a>
            </div>
        @endcan
        <div>
@endsection
