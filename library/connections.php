<?php

/*
 * Database Connections
 */

function acmeConnect(){
    $server = "localhost";
    $database = "acme";
    $user = "iClient";
    $password = "vgdYkJSn6IdNs4yS";
    $dsn = 'mysql:host=' . $server . ';dbname=' . $database;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $acmeLink = new PDO($dsn, $user, $password, $options);
        return $acmeLink;
    } catch (PDOException $exc) {
        header('location: /acme/view/500.php');
        exit;
    }
}

acmeConnect();
