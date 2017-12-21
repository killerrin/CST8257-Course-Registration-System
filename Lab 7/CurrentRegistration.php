<?php //session_start(); ?>
<?php include "Common/Header.php";
$LoggedInUser = isset($_SESSION["LoggedInUser"]) ? $_SESSION["LoggedInUser"] : (function() { header("Location: Login.php?returnUrl=".urlencode($_SERVER['REQUEST_URI'])); die();})();

      $dbManager = new DBManager();
      $courseRepo = new DBCourseRepository($dbManager);
      $semesterRepo = new DBSemesterRepository($dbManager);
      $registration = new DBRegistrationRepository($dbManager);
      $dbManager->connect();

      $allUserRegistrations = $registration->getForUser($LoggedInUser->studentID);
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
      if ($_POST) {

      }
?>

<div class="container">
    <h1>Current Registration</h1>
    <p>
        Hello
        <strong>
            <?php echo $LoggedInUser->name; ?>!
        </strong>(not you? change user
        <a href="Login.php">here</a>), the followings are your current registrations
    </p>
    <form action="/CurrentRegistration.php" method="post" onsubmit="return confirmDeletion();">
        <table>
            <tr>
                <th>Year</th>
                <th>Term</th>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Hours</th>
                <th>Select</th>
            </tr>

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
                    echo "<td><input type=\"checkbox\" name=\"courseSelected[]\" /></td>";
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
            <!--<tr>
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
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
            </tr>
            <tr>
                <td>2017</td>
                <td>Fall</td>
                <td>MGT8400</td>
                <td>Project Adminstration</td>
                <td>4</td>
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
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
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
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
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
            </tr>
            <tr>
                <td>2018</td>
                <td>Fall</td>
                <td>CST8209</td>
                <td>Web Programming I</td>
                <td>4</td>
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
            </tr>
            <tr>
                <td>2018</td>
                <td>Fall</td>
                <td>CST8260</td>
                <td>Database System and Concepts</td>
                <td>3</td>
                <td>
                    <input type="checkbox" name="courseSelected[]" />
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="totalWkFormat">Total Weekly Hours</td>
                <td colspan="2">11</td>
            </tr>-->
        </table>
        <div class="buttonsContainer">
            <input type="submit" name="deleteSelected" value="Delete Selected" />
            <input type="reset" name="clear" value="Clear" />
        </div>
    </form>
</div>

<script src="Scripts/CurrentRegistration.js"></script>
<?php include "Common/Footer.php"; ?>