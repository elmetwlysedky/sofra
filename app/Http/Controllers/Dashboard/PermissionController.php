<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        return view('Dashboard.Setting.permission.index', [
            'permissions' => Permission::all()
        ]);

    }

    public function create()
    {
        return view('Dashboard.Setting.permission.create');
    }

    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
//        $data['guard_name']= 'admin';

        Permission::create($data);
        session()->flash('success', __('main.added_success'));
        return to_route('permission.index');
    }

    public function edit($id)
    {
        return view('Dashboard.Setting.Permission.edit',[
           'permission' => Permission::findOrFail($id)
        ]);
    }

    public function update(PermissionRequest $request,$id)
    {
        $permission = Permission::findOrFail($id);
        $data = $request->validated();
        $permission->update($data);
        session()->flash('success', __('main.edited_success'));
        return to_route('permission.index');
    }

    public function destroy($id)
    {
        // العثور على الإذن بواسطة المعرف
        $permission = Permission::findOrFail($id);
        $permission->delete();
        session()->flash('success', __('main.deleted_success'));
        return redirect()->back();

    }






//
//        $permission = Permission::findOrFail($id);
//        $permission->delete();
//        session()->flash('success',__('main.deleted_success'));
//        return redirect()->back();










}
