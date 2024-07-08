<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Application\StoreRoleRequest;
use App\Http\Requests\Web\Application\UpdateRoleRequest;

use App\Models\Application;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    private int $perpage;

    public function __construct()
    {
    	$this->perpage = config('constants.perpage');
    }

    public function index(Request $request)
    {
        Gate::authorize('view-applications');

        $applications = Application::with('createdBy')->orderBy('updated_at', 'desc');

        $filters = $request->input('filters');
        if(isset($filters)) {
            if(isset($filters['application_status'])) {
                $applications->where('status', $filters['application_status']);
            }
        }
            
        $applications = $applications->paginate($this->perpage);
        $statuses = config('constants.application_status');

        return view('admin.application.index', [
            'page_title' => __('application.Applications'),
            'applications' => $applications,
            'filters' => $filters,
            'statuses' => $statuses,
        ]);
    }

    public function create()
    {
        Gate::authorize('create-roles');

        $permissions = Permission::all();

        return view(
            'admin.role.create', 
            [
                'page_title' => trans('user.New Role'),
                'permissions' => $permissions,
            ]
        );
    }

    public function store(StoreRoleRequest $request)
    {
        $inputs = $request->validated();
        $role = Role::create($inputs);
        $role->syncPermissions(array_keys($inputs['permissions']));

        return redirect()->route('admin.roles.index')->withSuccess(trans('user.role_success_creation'));
    }

    public function edit($id)
    {
        Gate::authorize('edit-roles');

        $permissions = Permission::all();
        $role = Role::with('permissions')->find($id);
        $selectedPermissionIds = $role->permissions->pluck('id')->toArray();

        return view(
            'admin.role.edit', 
            [
                'page_title' => trans('user.Edit Role'),
                'role' => $role,
                'permissions' => $permissions,
                'selectedPermissionIds' => $selectedPermissionIds,
            ]
        );
    }
    
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $inputs = $request->validated();
        $role->fill($inputs)->save();
        $role->syncPermissions(array_keys($inputs['permissions']));

        return redirect()->route('admin.roles.index')->withSuccess(trans('user.role_success_edition'));
    }

    public function destroy($id)
    {
        Gate::authorize('delete-roles');

        $role = Role::find($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->withSuccess(trans('user.role_success_deletion'));
    }
}
