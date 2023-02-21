<?php
$now = date('Y-m-d H:i:s');

if (($now<='2025-08-31 23:59:59')) {
    //Script Author:John Katieno
    //This is the main script that will be used to the database
    //include the main server side functions that will run system wide
    include "general_functions.php";

    //Tell the Apache server to spit PHP errors on the main display,the browser
    //ini_set('display_errors', 'on');
    //error_reporting(E_ALL & ~E_DEPRECATED);
    //Issue a coercive connection to the database,supply the various MySQL database authentication details like where the database server is sitting,username and password that match a valid account on that server
    $conn 	= mysqli_connect("localhost", "pmjvrfoc_naitiri", "Kenya123*");
    //Select what database you are intereted in using
    $dbName = 'pmjvrfoc_naitiri';
    $db_connect = mysqli_select_db($conn, $dbName);


    function datedifference($date1, $date2)
    {
        $difftimefunc = abs(strtotime($date2) - strtotime($date1));

        $years = floor($difftimefunc / (365*60*60*24));
        $months = floor(($difftimefunc - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $hours = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));

        $minuts = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

        $seconds = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
        if ($years == '0') {
            $add = '';
        } else {
            $add = $years.'years,';
        }
        if ($months == '0') {
            $addMonth = '';
        } else {
            $addMonth = $months.'Months,';
        }

        if ($days == '0') {
            $addDays = '';
        } else {
            $addDays = $days.'days,';
        }

        if ($hours == '0') {
            $addhours = '';
        } else {
            $addhours = $hours.'hrs,';
        }

        $difftimefunc = $add.$addMonth.$addDays.$addhours.$minuts.'min,'.$seconds.'sec';
        return $difftimefunc;
    }
} else {


//Script Author:John Katieno
    //This is the main script that will be used to the database
    //include the main server side functions that will run system wide
    include "general_functions.php";

    //Tell the Apache server to spit PHP errors on the main display,the browser
    //ini_set('display_errors', 'on');
    //error_reporting(E_ALL & ~E_DEPRECATED);
    //Issue a coercive connection to the database,supply the various MySQL database authentication details like where the database server is sitting,username and password that match a valid account on that server
    $conn 	= mysqli_connect("localhost", "pmjvrfoc_naitiri", "Root2012");
    //Select what database you are intereted in using
    $dbName = 'chanf';

    $db_connect = mysqli_select_db($conn, $dbName);


    function datedifference($date1, $date2)
    {
        $difftimefunc = abs(strtotime($date2) - strtotime($date1));

        $years = floor($difftimefunc / (365*60*60*24));
        $months = floor(($difftimefunc - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $hours = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));

        $minuts = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

        $seconds = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
        if ($years == '0') {
            $add = '';
        } else {
            $add = $years.'years,';
        }
        if ($months == '0') {
            $addMonth = '';
        } else {
            $addMonth = $months.'Months,';
        }

        if ($days == '0') {
            $addDays = '';
        } else {
            $addDays = $days.'days,';
        }

        if ($hours == '0') {
            $addhours = '';
        } else {
            $addhours = $hours.'hrs,';
        }

        $difftimefunc = $add.$addMonth.$addDays.$addhours.$minuts.'min,'.$seconds.'sec';
        return $difftimefunc;
    }
}
