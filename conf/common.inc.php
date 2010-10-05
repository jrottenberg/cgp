<?php


$CONFIG['webdir'] = preg_replace('/\/[a-z\.]+$/', '', $_SERVER['SCRIPT_FILENAME']);
$CONFIG['weburl'] = preg_replace('/\/[a-z\.]+$/', '', $_SERVER['SCRIPT_NAME']);

require_once 'config.php';

?>
