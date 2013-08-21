<?php

define('PROFILER', '0');
define('UMASK', '0755');
define('AVATAR', false);

define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('BASE_PATH', dirname($_SERVER['DOCUMENT_ROOT']).'/');

define('INC_PATH', BASE_PATH.'protected/');

define('PUBLIC_URL', BASE_URL.'');
define('PUBLIC_PATH', BASE_PATH.'public/');

//========================[ Data Base ]=========================================

//define('DB_HOST', 'dev.linuxd.net');
define('DB_HOST', '10.10.0.28');
define('DB_NAME', 'blacksea_dev');
define('DB_USER', 'blacksea');
define('DB_PASS', 'XTfUyJ7DsvWfjcDy');

define('DB_RO_USER', 'roblacksea');
define('DB_RO_PASS', 'Z3FE2bPH9uyw3Sn3');


define('DSN', 'mysqli://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME);
define('DSN_RO', 'mysqli://'.DB_RO_USER.':'.DB_RO_PASS.'@'.DB_HOST.'/'.DB_NAME);

//========================[ pt mail ]===========================================
define('SMTP_SERVER', 'mail.serenitymedia.ro');
define('SMTP_USER', 'noreply@serenitymedia.ro');
define('SMTP_PASS', 'donotreply');
define('SMTP_PORT', 587);
//define('SMTP_SERVER', 'mail.theblacksea.eu');
//define('SMTP_USER', 'noreply@theblacksea.eu');
//define('SMTP_PASS', 'busDohab6');
//define('SMTP_PORT', 25);


//set_include_path(get_include_path() . ':' . BASE_PATH . 'protected');


