<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>OneStopIT</title>
    <link rel="canonical" href="https://onestopit.cz/">
    <meta property="og:url" content="https://onestopit.cz/">
    <meta name="twitter:title" content="OneStopIT">
    <meta name="twitter:card" content="summary">
    <meta property="og:image" content="https://onestopit.cz/assets/img/2.jpg">
    <meta name="description" content="We provide professional web application and backend development, quick and simple online tools such as calculators, YouTube downloaders, and image converters, as well as high-quality IT outsourcing for small and medium-sized businesses. Our services are designed to meet your digital needs and help your business grow.">
    <meta property="og:type" content="website">
    <meta name="twitter:image" content="https://onestopit.cz/assets/img/2.jpg">
    <meta name="twitter:description" content="We provide professional web application and backend development, quick and simple online tools such as calculators, YouTube downloaders, and image converters, as well as high-quality IT outsourcing for small and medium-sized businesses. Our services are designed to meet your digital needs and help your business grow.">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="/assets/css/Black-Navbar.css">
    <link rel="stylesheet" href="/assets/css/Footer-Dark-icons.css">
    <link rel="stylesheet" href="/assets/css/Hero-Carousel-images.css">
    <link rel="stylesheet" href="/assets/css/Icon-Centered-Between-Lines.css">
    <link rel="stylesheet" href="/assets/css/Modern-Contact-Form.css">
</head>

<style>
    .navigation-clean-button .navbar-nav > li > .dropdown-menu .dropdown-item:hover {
    color: black !important; /* Barva textu bude černá při hover efektu */
}
</style>

<body>
<nav class="navbar navbar-light navbar-expand-md navbar-fixed-top navigation-clean-button" style="background: rgb(34, 34, 34);border-radius: 20;border-top-left-radius: 20;border-top-right-radius: 20;border-bottom-right-radius: 20;border-bottom-left-radius: 20;border-style: none;padding-top: 0;padding-bottom: 10px;">
    <div class="container">
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div><a class="navbar-brand" href="/"><span>OneStopIT</span> </a></div>
        <div class="collapse navbar-collapse" id="navcol-1" style="color: rgb(255,255,255);">
            <ul class="navbar-nav nav-right">
                <!-- <li class="nav-item"><a class="nav-link active" href="../index.php" style="color: rgba(224,217,217,0.9);">home </a></li> -->
                <li class="nav-item dropdown show"><a class="dropdown-toggle nav-link" aria-expanded="true" data-bs-toggle="dropdown" href="#" style="color: rgba(224,217,217,0.9);">Services </a>
                    <div class="dropdown-menu" data-bs-popper="none" style="color: rgb(255,255,255);">
                        <a class="dropdown-item" href="/TimeTrackr/" style="color: rgb(255,255,255);">TimeTrackr</a>
                        <!-- <a class="dropdown-item" href="#" style="color: rgb(255,255,255);">Order Services</a>
                        <a class="dropdown-item" href="#" style="color: rgb(255,255,255);">Custom Request</a> -->
                    </div>
                </li>
                <!-- <li class="nav-item"><a class="nav-link" href="about.html" style="color: rgba(224,217,217,0.9);">about </a></li>
                <li class="nav-item"><a class="nav-link" href="faq.html" style="color: rgba(224,217,217,0.9);">faq </a></li>
                <li class="nav-item"><a class="nav-link" href="contact.html" style="color: rgba(224,217,217,0.9);">contact </a></li> -->
            </ul>
            <span class="ms-auto navbar-text actions" style="text-align: right;">
                <?php
                if(isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo "<span class='navbar-text' style='color: rgba(224,217,217,0.9); margin-right: 10px;'>$username</span>";
                    if($_SESSION['user_role'] == 'admin') { // Show admin tab for admin users
                        echo '<a class="login" href="/it_users/admin_page.php" style="color: rgba(224,217,217,0.9);">Admin</a>';
                    }
                 
                    echo '<a class="login" href="/it_users/user_logout.php" style="color: rgba(224,217,217,0.9);">Logout</a>';
                } else {
                    echo '<a class="login" href="/it_users/user_login.php" style="color: rgba(224,217,217,0.9);">Login</a>';
                    echo '<a class="btn btn-light action-button" role="button" href="/it_users/user_registration.php" style="color: rgba(255,255,255,0.9);background: var(--bs-primary);border-radius: 10px;border-style: solid;border-color: rgba(0,0,0,0.9);font-size: 16px;padding: 5px 8px;">Register</a>';
                }
                ?>
            </span>
        </div>
    </div>
</nav>

<script src="/assets/bootstrap/js/bootstrap.min.js"></script>