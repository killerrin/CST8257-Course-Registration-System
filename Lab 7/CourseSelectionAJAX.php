<?php
include "Common/IncludeAll.php";
header('Content-Type: application/json');

$semesterCode = $_GET["semesterCode"];
$studentID = $_GET["studentID"];
if (empty($semesterCode)) { die(); }

$semesters = array();
$terms = array();

$dbManager = new DBManager();
$dbManager->connect();
$courseOfferRepo = new DBCourseOfferRepository($dbManager);
$courseRepo = new DBCourseRepository($dbManager);
$semesterRepo = new DBSemesterRepository($dbManager);
$registrationRepo = new DBRegistrationRepository($dbManager);

$terms = $semesterRepo->getAll();
$registrations = $registrationRepo->getForUser($studentID);

foreach($courseOfferRepo->getAll() as $courseOffer) {
    $course = $courseRepo->getID($courseOffer[0])[0];
    $semester = $semesterRepo->getID($courseOffer[1])[0];
    $tmp = new CourseOffer($course, $semester);
    if (!isset($semesters[$tmp->semester->semesterCode]))
        $semesters[$tmp->semester->semesterCode] = array();
    $push = true;
    foreach ($registrations as $registration) {
        if ($tmp->course->courseCode == $registration[1]) {
            $push = false;
            continue;
        }
    }
    if ($push)
        array_push($semesters[$tmp->semester->semesterCode], $tmp->course);
}
//var_dump($semesters);
$dbManager->close();

echo json_encode($semesters[$semesterCode]);

?>