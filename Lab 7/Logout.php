<?php session_start(); ?>
<?php include "Common/Header.php"; ?>

<?php
// Completely annihilate the session
session_unset();
session_destroy();

// Redirect to Index.php
header("Location: Index.php");
die();
?>

<?php include "Common/Footer.php"; ?>