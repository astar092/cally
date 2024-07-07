@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
        @include('layouts.errors')
        @include('layouts.success')

        <form action="#" class="filter-form">
            <div class="filters form-groups col-md-12">
                {{-- <div class="filter-box col-md-3 row">
                    <input class="form-control datepicker @if(!isset($filters['date_from'])) empty-value @endif"
                        @if(isset($filters['date_from']))value="{{ $filters['date_from']}}"@endif
                        name="filters[date_from]" autocomplete="off" placeholder="{{ __('Date From') }}"/>
                </div> --}}

                <div class="filter-box form-group col-md-3">
                    <input class="form-control" type="text" name="filters[search]" placeholder="{{ __('Name')}}" @if(isset($filters['search'])) value="{{$filters['search']}}" @endif/>
                </div>
    
                <div class="filter-box form-group col-md-2">
                    <button type="submit" class="form-control btn btn-primary">{{__('Search')}}</button>
                </div>
            </div>
        </form>

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
            ['moduleName' => 'users', 'createButtonText' => trans('user.New User'), 'obj' => $users, 'isExcelExportIncluded' => true, 'filters' => $filters]
        )
    <div>
@endsection
