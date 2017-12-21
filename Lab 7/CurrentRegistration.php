<?php //session_start(); ?>
<?php include "Common/Header.php";
$LoggedInUser = isset($_SESSION["LoggedInUser"]) ? $_SESSION["LoggedInUser"] : (function() { header("Location: Login.php?returnUrl=".urlencode($_SERVER['REQUEST_URI'])); die();})();
?>

<div class="container">
    <h1>Current Registration</h1>
</div>

<?php include "Common/Footer.php"; ?>