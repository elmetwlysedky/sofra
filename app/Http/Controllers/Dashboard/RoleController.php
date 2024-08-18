<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {

        return view('Dashboard.Setting.Role.index', [
            'roles' => Role::all()
        ]);

    }

    public function create()
    {

        return view('Dashboard.Setting.Role.create', [
            'permission'=> Permission::all(),
        ]);

    }

    public function store(RoleRequest $request)
    {
        $data = $request->validated();

        $role= Role::create($data);
        $permissionIds = $data['permission_id'] ?? [];
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        $role->syncPermissions($permissions);
        session()->flash('success', __('main.added_success'));
        return to_route('role.index');
    }

    public function edit($id)
    {
        return view('Dashboard.Setting.Role.edit',[
            'role' => Role::findOrFail($id),
            'permissions' => Permission::all(),
        ]);
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validated();
        $role->update($data);

        $permissionIds = $data['permission_id'] ?? [];
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        $role->syncPermissions($permissions);

        session()->flash('success', __('main.edited_success'));
        return to_route('role.index');
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);

        session()->flash('success', __('main.deleted_success'));
        return redirect()->route('role.index');
    }

    public function userPermission($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('Dashboard.User.permission', [
            'user' => User::findOrFail($user_id),
            'roles' => Role::all(),
            'user_role' => $user->getRoleNames()
        ]);

    }


    public function addPermission(Request $request, $user_id)
    {


        $user =  User::findOrFail($user_id);
        $roles = $request->validate([
            'role_id'=>'required'
        ]);
        $user->syncRoles([$roles]);

        session()->flash('success', __('main.added_success'));
        return to_route('user.index');
    }

}
