<?php

session_start();

if(!$_SESSION['usuario']){
    header('location: ../public/pages/login.php');
    exit();
}
