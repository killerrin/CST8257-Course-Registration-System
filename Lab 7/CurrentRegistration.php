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

if ($_POST) {
    
}
?>

<div class="container">
    <h1>Current Registration</h1>
    <p>Hello <strong><?php echo $LoggedInUser->name; ?>!</strong> (not you? change user <a href="Login.php">here</a>), the followings are your current registrations</p>
    <form action="/" method="post">
        <table>
            <tr>
                <th>Year</th>
                <th>Term</th>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Hours</th>
                <th>Select</th>
            </tr>
            <tr>
                <td>2017</td>
                <td>Fall</td>
                <td>CAD8405</td>
                <td>AutoCAD II</td>
                <td>4</td>
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
            </tr>
            <tr>
                <td>2017</td>
                <td>Fall</td>
                <td>CON8418</td>
                <td>Construction Building Code</td>
                <td>3</td>
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
            </tr>
            <tr>
                <td>2017</td>
                <td>Fall</td>
                <td>ENG8454</td>
                <td>Geotechnical Materials</td>
                <td>3</td>
                <td><input type="checkbox" name="courseSelected[]" /></td>
            </tr>
            <tr>
                <td>2017</td>
                <td>Fall</td>
                <td>MGT8400</td>
                <td>Project Adminstration</td>
                <td>4</td>
                <td><input type="checkbox" name="courseSelected[]" /></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="totalWkFormat">Total Weekly Hours</td>
                <td colspan="2">14</td>
            </tr>
            <tr>
                <td>2017</td>
                <td>Winter</td>
                <td>CON8102</td>
                <td>Commercial Building/Estimating</td>
                <td>5</td>
                <td><input type="checkbox" name="courseSelected[]" /></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="totalWkFormat">Total Weekly Hours</td>
                <td colspan="2">5</td>
            </tr>
            <tr>
                <td>2018</td>
                <td>Fall</td>
                <td>CST8110</td>
                <td>Introduction to Computer Programming</td>
                <td>4</td>
                <td><input type="checkbox" name="courseSelected[]" /></td>
            </tr>
            <tr>
                <td>2018</td>
                <td>Fall</td>
                <td>CST8209</td>
                <td>Web Programming I</td>
                <td>4</td>
                <td><input type="checkbox" name="courseSelected[]" /></td>
            </tr>
            <tr>
                <td>2018</td>
                <td>Fall</td>
                <td>CST8260</td>
                <td>Database System and Concepts</td>
                <td>3</td>
                <td><input type="checkbox" name="courseSelected[]" /></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="totalWkFormat">Total Weekly Hours</td>
                <td colspan="2">11</td>
            </tr>
        </table>
        <div class="buttonsContainer">
            <input type="button" name="deleteSelected" value="Delete Selected" />
            <input type="reset" name="clear" value="Clear" />
        </div>
    </form>
</div>

<?php include "Common/Footer.php"; ?>