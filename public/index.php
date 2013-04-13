<?php
error_log("/////////////////////////////////////////////////////////////////////////////////////////////////");
error_log("//////////////////////////////// [ BlackSea page load ] /////////////////////////////////////////");
error_log("/////////////////////////////////////////////////////////////////////////////////////////////////");
error_log("                                                                                                 ");

#xdebug_start_trace('../trace.txt');

    require_once('../protected/etc/config.php');
    require_once(fw_incPath.'GENERAL/core/LOG.php');
    $profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime());

//error_reporting(E_ALL);

//var_dump($core);
//echo $_SESSION['auth']->name;
//var_dump($_SESSION['auth']);

#xdebug_stop_trace();
require_once(fw_incPath.'GENERAL/core/index.php');

