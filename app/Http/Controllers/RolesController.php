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
        $data['roles'] = Role::get();

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
        $data['title'] = 'Role Management';
        $data['breadcrumb'] = 'role-management';

        return view('dashboard.role_management', $data);
    }
}
