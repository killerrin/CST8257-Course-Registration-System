<?php //session_start(); ?>
<?php include "Common/Header.php"; ?>

<?php
$loginError = false;
if ($_POST) {
}
?>

<div class="container">
    <h1>New User</h1>
    <p>
        If you have an account,
        <a href="Login.php">login</a>
    </p>

    <hr />

    <p>All fields are required</p>

    <form class="form-horizontal" action="NewUser.php" method="post">
        <?php if($loginError): ?>
        <p class="error">Incorrect Student ID and/or Password</p>
        <?php endif; ?>
        <div class="form-group">
            <label for="inputStudentNumber" class="col-sm-2 control-label">StudentID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputStudentNumber" name="inputStudentNumber" placeholder="Student ID" value="<?php echo $studentID; ?>" required />
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Terry Fox" value="<?php echo $name; ?>" required />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputPhone" class="control-label">Phone Number</label>
                <p>(nnn-nnn-nnnn)</p>
            </div>
            <div class="col-sm-10">
                <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="123-456-7890" value="<?php echo $phone; ?>" required />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" value="<?php echo $password; ?>" required />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword2" class="col-sm-2 control-label">Password Again</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Password again" value="<?php echo $password2; ?>" required />
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