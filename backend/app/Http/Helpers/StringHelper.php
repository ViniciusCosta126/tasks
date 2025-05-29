<?php

namespace App\Http\Helpers;


class StringHelper
{

    public static function convertDateDayMonthYearHours($date)
    {
        return date('d/m/Y H:m', strtotime($date));
    }

    public static function convertDateDayMonthYear($date)
    {
        return date('d/m/Y', strtotime($date));
    }
}