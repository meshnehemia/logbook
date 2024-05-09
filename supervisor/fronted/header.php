<?php 


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_fname']) || !isset($_SESSION['user_lname'])) {
        header('Location: ../../login/index.php');
        die();
    }
            echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ELECTRONIC LOGBOOK SYSTEM </title>
            <link rel="stylesheet" href="css/style.css">
        </head>
        <body>
            <section class="header">
            <div class="logo">
                <div><h1>ELECTRONIC LOGBOOK SYSTEM</h1></div>
                <div class="profile">
                    <img src="https://th.bing.com/th/id/OIP.FL2JN1l2umj_Quz5n4UFdAAAAA?rs=1&pid=ImgDetMain"/>
                    <div class="name"><h4>welcome '.$_SESSION["user_fname"].'</h4><p>'.$_SESSION["user_type"].'</p></div>

                </div>
            </div>
            </section>
            ';