<?php

use Carbon\Carbon;

function getTimeShort($time) {
    if ($time) {
        $result = substr($time, 0, 5);   
        return $result;
    } else {
        return '-';
    }
}

function getIndonesianMonth($month, $full=true) {
    if ($full) {
        $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    } else {
        $months = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
    }
    return $months[(int) $month];
}

function IndonesianDate($date, $full=true) {
    if ($date) {
        $exp = explode('-', $date);
        $month = (int) $exp[1];
        $result = $exp[2] . ' ' . getIndonesianMonth($month, $full) . ' ' . $exp[0];  

        return $result;
    } else {
        return '-';
    }
}

function IndonesianDateTime($datetime, $full=true) {
    if ($datetime) {        
        $exp = explode(' ', $datetime);
        $date = explode('-', $exp[0]);
        $time = explode(':', $exp[1]);
        $month = (int) $date[1];
     
        $result = $date[2] . ' ' . getIndonesianMonth($month, $full) . ' ' . $date[0] . ' ' . $time[0] . ':' . $time[1];    
        return $result;
    } else {
        return '-';
    }
}

function intervalTime($datetime) {
    $result = Carbon::parse($datetime)->diffForHumans();
    return $result;
}

function amount_day($start,$end){
    $start = strtotime($start);
    $end = strtotime($end);

    $day = array();
    $satMon = array();

    for ($i=$start; $i <= $end; $i += (60 * 60 * 24)) {
        if (date('w', $i) !== '0' && date('w', $i) !== '6') {
            $day[] = $i;
        } else {
            $satMon[] = $i;
        }

    }

    $count = count($day);

    return $count;
}