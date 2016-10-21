<?php
include("../_config.php");
session_start();
unset($_SESSION['id']);
header("Location: ".SITE_URL);