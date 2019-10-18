<?php
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
session_start();


function selectWHere(PDO $pdo, string $query, string $column, string $value): array
{
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':' . $column, $value);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
}

function whatIsHappening()
{

    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
    //echo '<h2>$_SERVER</h2>';
    //var_dump($_SERVER);

}

function openConnection()
{
    // Try to figure out what these should be for you
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "becode";

// Try to understand what happens here

    return new PDO('mysql:host=' . $dbhost . ';dbname=' . $db , $dbuser , $dbpass);
    
}


/* Fetch all of the remaining rows in the result set */

$pdo = openConnection();





