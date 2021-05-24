<?php

function connection_open()
{
    
   
    mysqli_connect("localhost", "root","","invoice") or 
	die("<h1> Error in Connection </h1>".mysql_error());
   
}

function authentication()
{
    session_start();
    if(!isset($_SESSION['email']))
    {
        header("location:index.php");
    }
}