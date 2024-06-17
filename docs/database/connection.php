<?php
$server = 'localhost';
$username = 'root';
$password = '';
$db_name = 'StickerWizard';;

$connection = new mysqli($server, $username, $password, $db_name);

if ($connection->connect_error) {
    die("Connection error" . $connection->connect_error);
}
