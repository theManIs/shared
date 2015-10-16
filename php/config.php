<?php


//Настройки сервера
ini_set('error_reporting', E_ALL);
ini_set('display_errors','1');
setlocale(LC_ALL, "ru_RU.UTF-8");
mb_internal_encoding("UTF-8");
mb_http_output('UTF-8');
$hour = new DateTime('now + 4 hour');

//Динамическое подключение классов
function __autoload($name) 
{
	include_once('php/'.$name.'.php');
}

//Константы
define('HOST', 'localhost');
define('DB', 'bank');
define('USER', 'pie');
define('PASSWORD', 'pass');
define('ROOTDIR', '');

/*print_r(date_default_timezone_get().' '.ini_get('error_log').' '.
ini_get('error_reporting').' '.ini_get('default_charset').' '.
mb_http_output().' '.setlocale(LC_ALL, NULL).' '.ini_get('display_errors')
.' '.date('H:i:s O I', time()+3600)); exit;*/
?>