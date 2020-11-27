<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 09/12/2017
 * Time: 12:11
 */

namespace App\Library;


use Carbon\Carbon;

class Helper
{
    public static function diffToHours(string $tmFrom, string $tmUntil) : int
    {
        $from = Carbon::createFromFormat('H:i', $tmFrom);
        $until = Carbon::createFromFormat('H:i', $tmUntil);

        return $from->diffInHours($until, false);
    }
    public static function diffToDays($dtFrom, $dtUntil) : int {

        $from = Carbon::createFromFormat('Y-m-d', substr($dtFrom, 0, 10));
        $until = Carbon::createFromFormat('Y-m-d', substr($dtUntil, 0, 10));

        $days = $from->diffInDays($until);

        if($days == 0){
            $days = 1;
        }

        $diff_hours = self::differenceInHours(date('H:i:s', strtotime($dtFrom)), date('H:i:s', strtotime($dtUntil)));

        if($diff_hours > 2){
            $days += 1;
        }

        return $days;
    }
    public static function differenceInHours($startdate,$enddate){
        $starttimestamp = strtotime($startdate);
        $endtimestamp = strtotime($enddate);
        $difference = ($endtimestamp - $starttimestamp)/3600;
        return $difference;
    }
    public static function extraDay($tmFrom, $tmUntil) :bool
    {
        $hours = self::diffToHours($tmFrom, $tmUntil);

        return $hours > 2;
    }

    public static function finalDays($request) :int
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $from = $request['pickupDate'] . $request['pickupTime'];
            $until = $request['dropoffDate'] . $request['dropoffTime'];
        }else {
            $from = $request->get('pickupDate') . $request->get('pickupTime');
            $until = $request->get('dropoffDate') . $request->get('dropoffTime');
        }
        $days  = self::diffToDays($from, $until);

        return $days;
    }
    public static function isCurrentPage(string $url) : bool {
        return $url === url()->current();
    }

}