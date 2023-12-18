<?php

use Illuminate\Support\Facades\DB;

function test()
{
    return "test";
}

function tanggalTable($date)
{
    $tanggal = date('d M Y', strtotime($date));
    $jam = date('H:i', strtotime($date));

    return "$tanggal <br> <b>$jam</b> WITA";
}

function tanggalText($date)
{
    $tanggal = date('d M Y', strtotime($date));
    $jam = date('H:i', strtotime($date));

    return "$tanggal $jam WITA";
}

function tanggal2bulandepan($date)
{
    $nextMotnh = date('Y-m-02 23:59:59', strtotime($date . ' +1 months'));
    $today = date(now());

    return $today > $nextMotnh;
}

function areaImage()
{
    return ['OB.jpg', 'COAL.jpg', 'DEWATERING.jpg',   'DISPOSAL.jpg', 'HAULROAD.jpg', 'default.png'];
}

function maxScore()
{
    $results = DB::table('question as q')
        ->select('q.area_id as area', DB::raw('SUM(a.max_point * q.weight) as total_score'))
        ->joinSub(
            DB::table('answer')
                ->select('question_id', DB::raw('MAX(point) as max_point'))
                ->groupBy('question_id'),
            'a',
            'q.id',
            '=',
            'a.question_id'
        )
        ->groupBy('q.area_id')
        ->get();
    return $results;
}

function colorScore($val)
{
    if ($val <= 60) {
        return 'danger';
    } else if ($val >= 61 && $val <= 69) {
        return 'warning';
    } else if ($val >= 70 && $val <= 79) {
        return 'primary';
    } else {
        return 'success';
    }
    
}

function issue()
{
    return [
        'open' => 'Open',
        'close' => 'Closed',
        'progress' => 'On Progress',
        'reject' => 'Cancelled',
    ];
}

function issueColor($status){
    if ($status == 'progress') {
            $color = 'primary';
        } else if ($status == 'close') {
            $color = 'success';
        } else if ($status == 'reject') {
            $color = 'danger';
        } else {
            $color = 'warning';
        }

    return $color;
}

function company()
{
    return ['MIP', 'MKP', 'RML'];
}
