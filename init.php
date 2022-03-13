<?php

include 'connect.php';

ob_start();
session_start();

$App = 'inc/App/';

include $App . 'header.php';
include $App . 'nav.php';
