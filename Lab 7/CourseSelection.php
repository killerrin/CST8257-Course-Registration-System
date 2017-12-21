<?php //session_start(); ?>
<?php
include "Common/Header.php";

$LoggedInUser = isset($_SESSION["LoggedInUser"]) ? $_SESSION["LoggedInUser"] : (function() { header("Location: Login.php?returnUrl=".urlencode($_SERVER['REQUEST_URI'])); die();})();

$totalHours = (function($LoggedInUser) {
    $dbManager = new DBManager();
    $dbManager->connect();
    $hoursQueryResult = $dbManager->queryCustom("SELECT WeeklyHours FROM Course JOIN (Registration, Student) ON ( Course.CourseCode = Registration.CourseCode AND Registration.StudentId = Student.StudentId ) WHERE Student.StudentId = '$LoggedInUser->studentID' GROUP BY Student.StudentId ;");
    //var_dump($hoursQueryResult);
    $hours = mysqli_fetch_row($hoursQueryResult);
    return empty($hours) ? 0 : $hours;
})($LoggedInUser);

$remainingHours = 16 - $totalHours;

$semesters = array();

$dbManager = new DBManager();
$dbManager->connect();
$courseOfferRepo = new DBCourseOfferRepository($dbManager);
$courseRepo = new DBCourseRepository($dbManager);
$semesterRepo = new DBSemesterRepository($dbManager);
foreach($courseOfferRepo->getAll() as $courseOffer) {
    $course = $courseRepo->getID($courseOffer[0])[0];
    $semester = $semesterRepo->getID($courseOffer[1])[0];
    $tmp = new CourseOffer($course, $semester);
    if (!isset($semesters[$tmp->semester->semesterCode]))
        $semesters[$tmp->semester->semesterCode] = array();
    array_push($semesters[$tmp->semester->semesterCode], $tmp->course);
}
var_dump($semesters);
$dbManager->close();

?>

<div class="container">
    <h1>Course Selection</h1>
    <p>Welcome <strong><?php echo $LoggedInUser->name; ?>!</strong> (not you? change user <a href="Login.php">here</a>)</p>
    <p>You have registered <strong><?php echo $totalHours; ?></strong> hours for the selected semester.</p>
    <p>You can register <strong><?php echo $remainingHours; ?></strong> more hours of course(s) for the semester.</p>
    <p>Please note that the courses you have registered will not be displayed in the list.</p>
    <select id="semesterSelect" class="form-control">
        <?php foreach($semesters as $semester): ?>

        <?php endforeach; ?>
    </select>
</div>

<?php include "Common/Footer.php"; ?>