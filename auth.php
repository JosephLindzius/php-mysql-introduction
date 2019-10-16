<?php

require "connection.php";
if (empty($_POST)) {
    header("Location: ./login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" ) {

}
?>