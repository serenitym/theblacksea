<?php
error_log("[ ivy ] "."/////////////////////////////////////////////////");
error_log("[ ivy ] "."//////////// [ BlackSea page load ] /////////////");
error_log("[ ivy ] "."/////////////////////////////////////////////////");
error_log("[ ivy ] "."                                                 ");
error_log("[ ivy ] "."                                                 ");

if (ENV == 'production') {
    error_reporting(0);
    @ini_set('display_errors', 0);
}

//xdebug_start_trace('../trace.txt');

    error_reporting(E_ERROR);

    @require_once '../protected/etc/config.base.php';
    @require_once FW_INC_PATH.'GENERAL/core/scripts/ivyStart.php';
    $profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());


//var_dump($core);
//echo $_SESSION['auth']->name;
//var_dump($_SESSION['auth']);

//xdebug_stop_trace();

@require_once FW_INC_PATH.'GENERAL/core/scripts/index.php';

