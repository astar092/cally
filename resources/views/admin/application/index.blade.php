@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
        @include('layouts.errors')
        @include('layouts.success')

        <form action="#" class="filter-form">
            <div class="filters form-groups col-md-12">
                <div class="filter-box form-group col-md-3">
                    <select class="form-control" name="filters[application_status]">
                        <option value="">{{__('Not selected')}}</option>
                        @foreach ($applicationStatusses as $key => $status)
                            <option value="{{$status}}" @if ($status === ($filters['application_status'] ?? null)) selected @endif>
                                {{__("application.APPLICATION_STATUSSES.".$key)}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-box form-group col-md-3">
                    <select class="form-control" name="filters[application_type]">
                        <option value="">{{__('Not selected')}}</option>
                        @foreach ($applicationTypes as $key => $type)
                            <option value="{{$type}}" @if ($type === ($filters['types'] ?? null)) selected @endif>
                                {{__("application.TYPES.".$key)}}
                            </option>
                        @endforeach
                    </select>
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
                    <td>{{__('application.Service Name')}}</td>
                    <td>{{__('application.Status')}}</td>
                    <td>{{__('application.Created By')}}</td>
                    <td>{{__('application.Confirmed By')}}</td>
                    <td>{{__('Actions')}}</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td>{{$application->id}}</td>
                        <td>{{$application->service?->name}}</td>
                        <td>{{__("application.".$statuses[$application->status])}}</td>
                        <td>{{$application->createdBy?->name}}</td>
                        <td>{{$application->confirmedBy?->name}}</td>
                        <td>
                            @include('layouts.admin.action-buttons', ['moduleName' => 'applications', 'obj' => $application])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('admin.application.layouts.table-footer', ['obj' => $applications])
    <div>
@endsection