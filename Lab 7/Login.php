<?php //session_start(); ?>
<?php include "Common/Header.php"; ?>

<?php
$loginError = false;
if ($_POST) {
    $studentID = $_POST["inputStudentNumber"];
    $password = $_POST["inputPassword"];

    // Create the DB and get the Users
    $dbManager = new DBManager();
    $studentRepo = new DBStudentRepository($dbManager);
    $dbManager->connect();
    $studentsArray = $studentRepo->getAll();
    $dbManager->close();

    // Parse the info
    $loginError = true;
    foreach ($studentsArray as $value)
    {
        if ($value->studentID == $studentID && $value->studentID == $password) {
            $loginError = false;
            $_SESSION["LoggedInUser"] = $value;

            // Redirect to Course Selection Page
            header("Location: CourseSelection.php");
            die();
        }
    }
}
?>

<div class="container">
    <h1>Login</h1>
    <p>
        You need to
        <a href="NewUser.php">sign up</a>&nbsp;if you are a new user
    </p>

    <form class="form-horizontal" action="Login.php" method="post">
        <?php if($loginError): ?>
        <p class="error">Incorrect Student ID and/or Password</p>
        <?php endif; ?>
        <div class="form-group">
            <label for="inputStudentNumber" class="col-sm-2 control-label">StudentID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputStudentNumber" name="inputStudentNumber" placeholder="Student ID" value="<?php echo $studentID; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" value="<?php echo $password; ?>" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Sign in</button>
            </div>
        </div>
    </form>
</div>

<?php include "Common/Footer.php"; ?>