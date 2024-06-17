<?php
session_start();
error_reporting(0);

include("blocks/path.php");

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['admin']);


header('location: ' . BASE_URL);
