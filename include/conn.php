<?php
$user = "root";
$pass = "";
try {
    $mysql = new PDO('mysql:host=localhost;dbname=donate', $user, $pass);
    $mysql->exec("set names utf8");

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>