<?php
require_once "session.php";

$_SESSION = array();
session_destroy();

header("location: index.php");
exit;
?>
