<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Area ' . ucfirst($request->status);
        $data['breadcrumb'] = 'data-area';

        $area = new Area();

        if ($request->status) {
            $status = $request->status;
            if ($status == 'inactive') {
                $area = $area->onlyTrashed();
            }
        } else {
            $area = $area->withTrashed();
        }
        $area = $area->get();
        $data['area'] = $area;
        $data['status'] = $request->status;
        return view('dashboard.area', $data);
    }

    function createArea(Request $request)
    {
        $data = $request->except('_token');

        if (Area::create($data)) {
            return redirect('/area?status=active')->with('message', 'Berhasil mendaftarkan area baru');
        }

        return back()->onlyInput();
    }

    function editArea(Request $request, $id)
    {
        $area = Area::find($id);
        $area->description = $request->description;
        if ($area->save()) {
            return redirect('/area?status=active')->with('message', 'Berhasil mengedit area');
        }
        return back()->onlyInput();
    }
    function activeArea($id)
    {
        $area = Area::withTrashed()->find($id);
        $area->restore();
        return redirect('/area?status=inactive')->with('message', 'Berhasil mengaktifkan area');
    }

    function inactiveArea($id)
    {
        $area = Area::find($id);
        $area->delete();
        return redirect('/area?status=active')->with('message', 'Berhasil menonaktifkan area');
    }
}
