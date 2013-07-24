<?php
error_log("[ ivy ] "."/////////////////////////////////////////////////");
error_log("[ ivy ] "."//////////// [ BlackSea page load ] /////////////");
error_log("[ ivy ] "."/////////////////////////////////////////////////");
error_log("[ ivy ] "."                                                 ");
error_log("[ ivy ] "."                                                 ");

//xdebug_start_trace('../trace.txt');

    require_once '../protected/etc/config.php';
    require_once FW_INC_PATH.'GENERAL/core/scripts/ivyStart.php';
    $profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());

//error_reporting(E_ALL);

//var_dump($core);
//echo $_SESSION['auth']->name;
//var_dump($_SESSION['auth']);

//xdebug_stop_trace();

require_once FW_INC_PATH.'GENERAL/core/scripts/index.php';

