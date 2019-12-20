<?php 
    session_start();
    if (!isset($_SESSION['login'])) {    //not loged in yet
        header("Location: ./login");
        exit;
    } else { //loged in
        header("Location: ./home");
    }
?>