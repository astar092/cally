<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    private int $perpage;

    public function __construct()
    {
    	$this->perpage = config('constants.perpage');
    }

    public function index()
    {
        Gate::authorize('view-roles');

        $roles = Role::orderBy('id', 'asc')->paginate($this->perpage);

        return view(
            'admin.role.index', 
            [
                'page_title' => trans('Roles'),
                'roles' => $roles
            ]
        );
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
