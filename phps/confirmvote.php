<?php
//get current user
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Please login first.');</script>";
    return;
}


    