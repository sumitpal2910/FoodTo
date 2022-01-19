<?php

function slug($string)
{
    return  str_replace(["--", "---", "----"],   "-",   strtolower(preg_replace("/[^a-z0-9]/i", "-", $string)));
}

/**
 * calculate distance between 2 point
 */
function distance($lng1, $lat1, $lng2, $lat2, $unit = 'km')
{
    if ($lat1 == $lat2 && $lng1 == $lng2) {
        return 0;
    }

    $theta = $lng1 - $lng2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles =  $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "KM") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
    switch ($unit) {
        case 'KM':
            return $miles * 1.609344;
            break;

        case 'M':
            return $miles * 1.609344 * 1000;
            break;

        case 'N':
            return $miles * 0.8684;
            break;

        case 'MI':
            return $miles;
            break;
    }
}

/**
 * get distance time
 */
function travelTime($dist, $time = 5)
{
    $nbSec = $time * 60;

    $totalDuration = $nbSec * $dist;

    return round($totalDuration / 60);
}

/**
 * Round Time
 */
function roundNumber($time)
{
    if (!$time) return 0;
    $factor = $time % 5;
    $result = 0;

    if ($factor == 0) {
        $result = $time;
    } else if ($factor <= 2) {
        $result = $time - $factor;
    } else {
        $result = $time - $factor + 5;
    }
    return $result;
}
