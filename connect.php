<?php

$dsn        = "mysql:host=localhost;dbname=sarhny";
$dbUsername = "root";
$dbPass     = "";


try {
    $conn = new PDO($dsn, $dbUsername, $dbPass);
} catch (PDOException $e) {
    echo '<div dir="ltr"><h2>Failed to connect</h2>' . $e . '</div>';
}
