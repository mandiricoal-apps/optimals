<?php

namespace App\Http\Controllers;

use App\Models\NotificationEmail;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class NotificationEmailController extends Controller
{
    function index()
    {
        $data['title'] = "Notification Email";
        $data['breadcrumb'] = 'notif_email';
        $data['emails'] = NotificationEmail::get();

        return view('dashboard.notification_email', $data);
    }

    function create(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('notification_email', 'email')->whereNull('deleted_at'),

            ],
            'company' => 'required'
        ]);
        $data = $request->except(['_token']);

        $save = NotificationEmail::create($data);

        if ($save) {
            return back()->with('message', 'Berhasil mendaftarkan email baru');
        }
        return back()->onlyInput();
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('notification_email', 'email')->whereNull('deleted_at')->ignore($id),
            ],
            'company' => 'required'
        ]);
        $data = $request->except(['_token']);

        $save = NotificationEmail::find($id)->update($data);
        if ($save) {
            return back()->with('message', 'Berhasil menrubah email');
        }
        return back()->onlyInput();
    }

    function delete($id)
    {
        $email = NotificationEmail::find($id);
        $email->delete();
        return redirect('/notif-email')->with('message', 'Berhasil menghapus email');
    }
}
