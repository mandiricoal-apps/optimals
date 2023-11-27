<?php

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
    $nextMotnh = date('Y-m-02 H:i:s', strtotime($date . ' +1 months'));
    $today = date(now());

    return $today > $nextMotnh;
}
