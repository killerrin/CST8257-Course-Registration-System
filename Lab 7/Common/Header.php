<?php
include_once("IncludeAll.php");
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Online Course Registration System</title>
    <link rel="stylesheet" href="Contents/css/bootstrap.min.css" />
    <link rel="stylesheet" href="Contents/AlgCss/Site.css" />
</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand no-padding horizontal-margin" href="#"><img src="../Contents/img/AC.png" /></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="Index.php">Home</a></li>
                    <li><a href="CourseSelection.php">Course Selection</a></li>
                    <li><a href="CurrentRegistration.php">Current Registration</a></li>

                    <?php if (true) : ?>
                    <li><a href="Login.php">Login</a></li>
                    <?php else : ?>
                    <li><a href="Logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>