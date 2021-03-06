<?php //session_start(); ?>
<?php include "Common/Header.php";
$LoggedInUser = isset($_SESSION["LoggedInUser"]) ? $_SESSION["LoggedInUser"] : (function() { header("Location: Login.php?returnUrl=".urlencode($_SERVER['REQUEST_URI'])); die();})();

      $dbManager = new DBManager();
      $courseRepo = new DBCourseRepository($dbManager);
      $semesterRepo = new DBSemesterRepository($dbManager);
      $registrationRepo = new DBRegistrationRepository($dbManager);
      $dbManager->connect();

      // Delete if courses selected on post
      if ($_POST) {
          $selectedCoursesToDelete = $_POST["courseSelected"];
          //var_dump($selectedCoursesToDelete);

          foreach ($selectedCoursesToDelete as $codesCombined)
          {
              $codesArr = explode("|", $codesCombined);
              //echo "<p>$LoggedInUser->studentID $codesArr[0] $codesArr[1]</p>";
              $registrationRepo->deleteByID($LoggedInUser->studentID, $codesArr[1], $codesArr[0]);
          }
      }

      // Get all courses ordered
      $allUserRegistrations = $registrationRepo->getForUserOrdered($LoggedInUser->studentID, "SemesterCode", "ASC");
      $courseRegistrations = array();
      foreach ($allUserRegistrations as $value)
      {
          $course = $courseRepo->getID($value[1])[0];
          $semester = $semesterRepo->getID($value[2])[0];
          $registration = new Registration($LoggedInUser, $course, $semester);

          // Create the Multi-array
          if (!isset($courseRegistrations[$registration->semester->semesterCode]))
              $courseRegistrations[$registration->semester->semesterCode] = array();
          array_push($courseRegistrations[$registration->semester->semesterCode], $registration);
      }
      $dbManager->close();
      //var_dump($courseRegistrations);
?>

<div class="container">
    <h1>Current Registration</h1>
    <p>
        Hello
        <strong>
            <?php echo $LoggedInUser->name; ?>!
        </strong>(not you? change user
        <a href="Logout.php">here</a>), the followings are your current registrations
    </p>
    <form action="CurrentRegistration.php" method="post" onsubmit="return confirmDeletion();">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Term</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Hours</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($courseRegistrations as $itemArray)
            {
                $currentHours = 0;

                // Print the Items
                foreach ($itemArray as $item)
                {
                    $currentHours += $item->course->weeklyHours;
                    $semester = $item->semester;
                    $course = $item->course;

                    echo "<tr>";
                    echo "<td>$semester->year</td>";
                    echo "<td>$semester->term</td>";
                    echo "<td>$course->courseCode</td>";
                    echo "<td>$course->title</td>";
                    echo "<td>$course->weeklyHours</td>";
                    echo "<td><input type=\"checkbox\" name=\"courseSelected[]\" value=\"$semester->semesterCode|$course->courseCode\" /></td>";
                    echo "</tr>";
                }

                // Print the Total Weekly Hours
                echo "<tr>";
                echo "<td colspan=\"3\"></td>";
                echo "<td class=\"totalWkFormat\">Total Weekly Hours</td>";
                echo "<td colspan=\"2\">$currentHours</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <div class="buttonsContainer">
            <input type="submit" name="deleteSelected" value="Delete Selected" class="btn btn-primary" />
            <input type="reset" name="clear" value="Clear" class="btn btn-info"/>
        </div>
    </form>
</div>

<script src="Scripts/CurrentRegistration.js"></script>
<?php include "Common/Footer.php"; ?>