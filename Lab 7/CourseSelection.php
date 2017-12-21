<?php //session_start(); ?>
<?php
include "Common/Header.php";

$LoggedInUser = isset($_SESSION["LoggedInUser"]) ? $_SESSION["LoggedInUser"] : (function() { header("Location: Login.php?returnUrl=".urlencode($_SERVER['REQUEST_URI'])); die();})();


?>

<div class="container">
    <h1>Course Selection</h1>
    <p>Welcome <strong><?php echo $LoggedInUser->name; ?>!</strong> (not you? change user <a href="Login.php">here</a>)</p>
</div>

<?php include "Common/Footer.php"; ?>