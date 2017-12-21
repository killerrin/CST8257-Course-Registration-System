<?php //session_start(); ?>
<?php
include "Common/Header.php";

// If user is logged in, assign Student object to $LoggedInUser, otherwise redirect to login and die (self-executing function)

$LoggedInUser = isset($_SESSION["LoggedInUser"]) ? $_SESSION["LoggedInUser"] : (function() { header("Location: Login.php?returnUrl=".urlencode($_SERVER['REQUEST_URI'])); die();})();


// Handle POST data

if (!empty($_POST['course'])) {
    $dbManager = new DBManager();
    $dbManager->connect();
    $registrationRepo = new DBRegistrationRepository($dbManager);
    $courseRepo = new DBCourseRepository($dbManager);
    $semesterRepo = new DBSemesterRepository($dbManager);

    $semester = $semesterRepo->getID($_POST['semester'])[0];

    foreach($_POST['course'] as $course) {
        //var_dump($courseRepo->getID($course)[0]);
        //var_dump($semester);
        $newRegistration = new Registration($LoggedInUser, $courseRepo->getID($course)[0], $semester);

        $registrationRepo->insert($newRegistration);
    }
    $dbManager->close();
}

// Calculate total course hours (and remaining) for current user

$totalHours = (function($LoggedInUser) {
    $dbManager = new DBManager();
    $dbManager->connect();
    $hoursQueryResult = $dbManager->queryCustom("SELECT WeeklyHours FROM Course JOIN (Registration, Student) ON ( Course.CourseCode = Registration.CourseCode AND Registration.StudentId = Student.StudentId ) WHERE Student.StudentId = '$LoggedInUser->studentID' GROUP BY Student.StudentId ;");
    //var_dump($hoursQueryResult);
    $hours = mysqli_fetch_row($hoursQueryResult);
    return empty($hours) ? 0 : $hours[0];
})($LoggedInUser);

$remainingHours = 16 - (int)$totalHours;


// Get all terms for dropdown list

$terms = array();

$dbManager = new DBManager();
$dbManager->connect();
$semesterRepo = new DBSemesterRepository($dbManager);

$terms = $semesterRepo->getAll();

//var_dump($semesters);
$dbManager->close();

?>

<div class="container">
    <h1>Course Selection</h1>
    <p>Welcome <strong><?php echo $LoggedInUser->name; ?>!</strong> (not you? change user <a href="Login.php">here</a>)</p>
    <p>You have registered <strong><?php echo $totalHours; ?></strong> hours for the selected semester.</p>
    <p>You can register <strong><?php echo $remainingHours; ?></strong> more hours of course(s) for the semester.</p>
    <p>Please note that the courses you have registered will not be displayed in the list.</p>

    <form action="CourseSelection.php" method="post">
    <div class="col-xs-3 col-xs-offset-9">
        <select id="semesterSelect" class="form-control" name="semester">
            <?php foreach($terms as $term): ?>
                <option value="<?php echo $term->semesterCode; ?>"><?php echo $term->year." ".$term->term; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" id="studentID" value="<?php echo $LoggedInUser->studentID; ?>" />
        <br />
    </div>
    <div>
            <table class="table">
                <thead>
                <row>
                    <th>Code</th>
                    <th>Course Title</th>
                    <th>Hours</th>
                    <th>Select</th>
                </row>
                </thead>
                <tbody id="tbody">
                <td colspan="4" align="center">Loading... Please wait</td>
                </tbody>
            </table>
            <div class="form-group col-xs-4 col-xs-offset-8">
                <div class="col-xs-6">
                    <input type="submit" class="btn btn-primary btn-block" value="Submit" />
                </div>
                <div class="col-xs-6">
                    <input type="reset" class="btn btn-info btn-block" value="Clear" />
                </div>
            </div>
        </form>
    </div>
</div>
<script src="./Scripts/CourseSelection.js"></script>
<?php include "Common/Footer.php"; ?>