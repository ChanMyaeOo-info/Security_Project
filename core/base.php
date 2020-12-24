<?php

session_start();

$con = mysqli_connect("localhost", "root", "", "contact");

function con()
{
    global $con;
    return $con;
}

?>