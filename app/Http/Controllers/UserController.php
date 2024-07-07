<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Exports\UserExport;

use Carbon\Carbon;

class UserController extends Controller
{
    private int $perpage;

    public function __construct()
    {
    	$this->perpage = config('constants.perpage');
    }

    public function index(Request $request)
    {
        Gate::authorize('view-users');

        $users = User::with('roles');
        $filters = $request->input('filters', []);
        $this->applyFilters($filters, $users);

        $users = $users->orderBy('id', 'asc')->paginate($this->perpage);

        return view(
            'admin.user.index', 
            [
                'page_title' => trans('Users'),
                'users' => $users,
                'filters' => $filters,
            ]
        );
    }

    public function create()
    {
        Gate::authorize('create-users');

        $roles = Role::all();

        return view(
            'admin.user.create', 
            [
                'page_title' => trans('user.New User'),
                'roles' => $roles,
            ]
        );
    }

    public function store(StoreUserRequest $request)
    {
        $inputs = $request->validated();
        $inputs['is_active'] = $inputs['is_active'] === "true" ? 1 : 0;
        $inputs['password'] = Hash::make(Str::random(40));

        $user = User::create($inputs);
        $this->assignToRoleFromRoleId($inputs['role_id'], $user);

        return redirect()->route('admin.users.index')->withSuccess(trans('user.success_creation'));
    }

    public function edit($id)
    {
        Gate::authorize('edit-users');

        $user = User::with('roles')->find($id);
        $roles = Role::all();

        return view(
            'admin.user.edit', 
            [
                'page_title' => trans('user.Edit User'),
                'roles' => $roles,
                'user' => $user,
            ]
        );
    }
    
    public function update(UpdateUserRequest $request, User $user)
    {
        $inputs = $request->validated();
        $inputs['is_active'] = $inputs['is_active'] === "true" ? 1 : 0;

        $user->fill($inputs)->save();
        $user->syncRoles([$inputs['role_id']]);

        return redirect()->route('admin.users.index')->withSuccess(trans('user.success_edition'));
    }

    public function destroy($id)
    {
        Gate::authorize('delete-users');

        $user = User::find($id);
        $user->is_active = false;
        $user->save();

        return redirect()->route('admin.users.index')->withSuccess(trans('user.success_deletion'));
    }

    public function exportExcel(Request $request) {
        Gate::authorize('view-users');
        
        $users = User::with(['roles']);

        $filters = $request->input('filters');
        $this->applyFilters($filters, $users);

        $users = $users->orderBy('updated_at', 'DESC')->get();
        $formattedTodayDate = Carbon::now()->format('d.m.Y');

        return (new UserExport($users))
            ->download('user_'.$formattedTodayDate.'.xlsx');
    }

    private function assignToRoleFromRoleId(int $roleId, User $user): void {
        $role = Role::find($roleId);
        $user->assignRole($role->name);
    }

    private function applyFilters(&$filters, $users) {
        if (isset($filters['search'])) {
            $users = $users->where('name', 'LIKE', '%'.$filters['search'].'%');
        }
    }
}
