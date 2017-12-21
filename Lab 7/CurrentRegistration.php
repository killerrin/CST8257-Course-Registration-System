<?php //session_start(); ?>
<?php include "Common/Header.php";
$LoggedInUser = isset($_SESSION["LoggedInUser"]) ? $_SESSION["LoggedInUser"] : (function() { header("Location: Login.php?returnUrl=".urlencode($_SERVER['REQUEST_URI'])); die();})();

$dbManager = new DBManager();
$courseRepo = new DBCourseRepository($dbManager);
$semesterRepo = new DBSemesterRepository($dbManager);
$registration = new DBRegistrationRepository($dbManager);
$dbManager->connect();
$allCourses = $courseRepo->getAll();
$allSemesters = $semesterRepo->getAll();
$allUserRegistrations = $registration->getForUser($LoggedInUser->studentID);
$dbManager->close();
?>

<div class="container">
    <h1>Current Registration</h1>
    <p>Hello <strong><?php echo $LoggedInUser->name; ?>!</strong> (not you? change user <a href="Login.php">here</a>), the followings are your current registrations</p>

</div>

<?php include "Common/Footer.php"; ?>