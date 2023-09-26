<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    function index(Request $request)
    {

        $data['title'] = 'Data User';
        $data['breadcrumb'] = 'data-user';
        $data['roles'] = Role::get();

        $user = new User;
        if ($request->status) {
            $status = $request->status;
            if ($status == 'inactive') {
                $user = $user->onlyTrashed();
            }
        } else {
            $user = $user->withTrashed();
        }

        $data['user'] = $user->get();

        return view('dashboard.user', $data);
    }


    function modalViewUser($id)
    {
        $data['user'] = User::withTrashed()->find($id);

        return view('modal.view_user', $data);
    }

    function modalAdduser()
    {
        $data['roles'] = Role::get();

        return view('modal.add_user', $data);
    }

    function createUser(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:users',
        ]);
        $data = $request->except(['_token', 'roles']);

        $data['password'] = Hash::make('Optimal2023');
        $newUser = User::create($data);
        $role = Role::find($request->input('roles'));
        if ($newUser->assignRole($role)) {
            return redirect('/user')->with('message', 'Berhasil mendaftarkan user baru');
        }
        return back()->onlyInput();
    }
}
