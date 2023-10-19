<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    function index()
    {
        $data['title'] = 'Data Role';
        $data['breadcrumb'] = 'data-roles';
        $data['roles'] = Role::whereNot('name', 'admin')->get();

        return view('dashboard.roles', $data);
    }

    function createRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles',
        ]);
        $data = $request->except(['_token']);

        if (Role::create($data)) {
            return redirect('/roles')->with('message', 'Berhasil mendaftarkan role baru');
        }
        return back()->onlyInput();
    }
    function editRole(Request $request, $id)
    {
        $role = Role::find($id);
        $role->description = $request->description;

        if ($role->save()) {
            return redirect('/roles')->with('message', 'Berhasil merubah role');
        }
        return back()->onlyInput();
    }

    function roleManagement($id)
    {
        $role = Role::find($id);
        $data['title'] = 'Role Management - ' . ucfirst($role->name);
        $data['breadcrumb'] = 'role-management';
        $data['parents'] = Permission::select('parent')->groupBy('parent')->orderBy('id')->get();
        $data['permissions'] = Permission::get();
        $data['role'] = $role;
        return view('dashboard.role_management', $data);
    }

    function halamanCreatePermission()
    {
        return view('dashboard.create_permission');
    }

    function createPermission(Request $request)
    {
        $data = $request->except('_token');
        if (Permission::create($data)) {
            echo 'Berhasil';
        } else {
            echo 'gagal';
        }
    }

    function updatePermission(Request $request, $id)
    {
        $data = $request->permissions;

        $role = Role::find($id);
        if ($role->syncPermissions($data)) {
            return redirect("/role-management/$id")->with('message', 'Berhasil merubah role permission');
        } else {
            return back()->onlyInput();
        }
    }
}
