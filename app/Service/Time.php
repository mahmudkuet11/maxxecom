<?php

namespace App\Service;


use Carbon\Carbon;

class Time
{
    public static function getDateFromISO8061Duration(Carbon $from, $iso8061Duration){
        $matches = self::parseIso8061Duration($iso8061Duration);
        $year = isset($matches[1]) ? (int)$matches[1] : 0;
        $month = isset($matches[2]) ? (int)$matches[2] : 0;
        $day = isset($matches[3]) ? (int)$matches[3] : 0;
        $hour = isset($matches[4]) ? (int)$matches[4] : 0;
        $minute = isset($matches[5]) ? (int)$matches[5] : 0;
        $second = isset($matches[6]) ? (int)$matches[6] : 0;
        return $from->addYears($year)
            ->addMonths($month)
            ->addDays($day)
            ->addHours($hour)
            ->addMinutes($minute)
            ->addSeconds($second);
    }

    public static function parseIso8061Duration($iso8061Duration){
        $iso8061DurationPattern = '/P(?:(\d+)Y)?(?:(\d+)M)?(?:(\d+)D)?T(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/';
        preg_match($iso8061DurationPattern, $iso8061Duration, $matches);
        return $matches;
    }
}