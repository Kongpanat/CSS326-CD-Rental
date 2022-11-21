<?php
session_start();
session_destroy();
// Logged out, return home.
header("Location: login.php");
?>