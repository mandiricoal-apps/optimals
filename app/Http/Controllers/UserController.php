<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Data User ' . ucfirst($request->status);
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

        $data['user'] = $user->whereNot('id', 1)->get();
        $data['status'] = $request->status;

        return view('dashboard.user', $data);
    }


    function modalViewUser($id)
    {
        $data['user'] = User::withTrashed()->find($id);

        return view('modal.view_user', $data);
    }

    function modalAdduser()
    {
        $data['roles'] = Role::whereNot('id', 1)->get();

        return view('modal.add_user', $data);
    }


    function createUser(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:users',
            'email' => 'required|email',
        ]);
        $data = $request->except(['_token', 'roles', 'password']);

        $data['password'] = Hash::make($request->password);
        $newUser = User::create($data);
        $role = Role::find($request->input('roles'));
        if ($newUser->assignRole($role)) {
            return redirect('/user?status=active')->with('message', 'Berhasil mendaftarkan user baru');
        }
        return back()->onlyInput();
    }

    function modalEdituser($id)
    {
        $data['roles'] = Role::get();
        $data['user'] = User::find($id);

        return view('modal.edit_user', $data);
    }

    function editUser(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::find($id);
        $user->email = $request->email;
        $user->save();
        if ($user->syncRoles([$request->input('roles')])) {
            return redirect('/user?status=active')->with('message', 'Berhasil mengedit user');
        }
        return back()->onlyInput();
    }

    function activeUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect('/user?status=inactive')->with('message', 'Berhasil mengaktifkan user');
    }

    function inactiveUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user?status=active')->with('message', 'Berhasil menonaktifkan user');
    }

    function companyApi()
    {
        $url = "http://mandiricoal.co.id:1880/sisakty/company/";
        $company = file_get_contents($url);

        return $company;
    }

    function employeeApi(Request $request)
    {
        $url = "http://mandiricoal.co.id:1880/sisakty/employee?company=" . $request->company . "&search=" . $request->search;
        if ($employee = file_get_contents($url)) {
            return json_decode($employee);
        }
    }

    function changePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);


        #Match The Old Password
        if (!Hash::check(md5($request->old_password), auth()->user()->password)) {
            return back()->withErrors(['Old password is wrong.']);
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make(md5($request->new_password))
        ]);

        return back()->with('message', 'Successfully changed password.');
    }

    function resetPassword($idUser)
    {
        $user = User::find($idUser);
        $user->password = Hash::make(md5('Optimals2023!'));
        if ($user->save()) {
            return back()->with('message', 'Successfully changed password.');
        }
    }
}
