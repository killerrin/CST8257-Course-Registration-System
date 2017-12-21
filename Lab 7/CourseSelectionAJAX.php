<?php
include "Common/IncludeAll.php";
header('Content-Type: application/json');

$semesterCode = $_GET["semesterCode"];
$studentID = $_GET["studentID"];
if (empty($semesterCode)) { die(); }

$semesters = array();
$terms = array();
$data = array();

$dbManager = new DBManager();
$dbManager->connect();
$courseOfferRepo = new DBCourseOfferRepository($dbManager);
$courseRepo = new DBCourseRepository($dbManager);
$semesterRepo = new DBSemesterRepository($dbManager);
$registrationRepo = new DBRegistrationRepository($dbManager);

$terms = $semesterRepo->getAll();
$registrations = $registrationRepo->getForUser($studentID);
$weeklyHours = 0;

foreach($courseOfferRepo->getAll() as $courseOffer) {
    $course = $courseRepo->getID($courseOffer[0])[0];
    $semester = $semesterRepo->getID($courseOffer[1])[0];
    $tmp = new CourseOffer($course, $semester);
    if (!isset($semesters[$tmp->semester->semesterCode]))
        $semesters[$tmp->semester->semesterCode] = array();
    $push = true;
    foreach ($registrations as $registration) {
        if ($tmp->course->courseCode == $registration[1]) {
            if ($tmp->semester->semesterCode == $semesterCode) {
                $weeklyHours += (int)$tmp->course->weeklyHours;
            }
            $push = false;
            continue;
        }
    }
    if ($push)
        array_push($semesters[$tmp->semester->semesterCode], $tmp->course);
}
//var_dump($semesters);
$dbManager->close();

array_push($data, $semesters[$semesterCode]);
array_push($data, $weeklyHours);

echo json_encode($data);

?>