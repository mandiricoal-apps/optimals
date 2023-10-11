<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class InspectionApi extends Controller
{
    function sync()
    {
        $area = $area = Area::with(['question', 'question.answer'])->get();

        return response()->json(['area' => $area]);
    }
}
