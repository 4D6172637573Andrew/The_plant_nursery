<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

const HOST = 'localhost';
const DBUSER = 'root';
const DBPASS = '';
const DBNAME = 'plant_db';

date_default_timezone_set("Australia/Melbourne");

?>

