<?php
// Include important pages here
// ================ Models ================
include_once("Classes/Models/Course.php");
include_once("Classes/Models/Semester.php");
include_once("Classes/Models/Student.php");
include_once("Classes/Models/CourseOffer.php");
include_once("Classes/Models/Registration.php");
// ================ Database ==============
include_once("Classes/DataAccess/DBManager.php");
include_once("Classes/DataAccess/DBGenericRepository.php");
include_once("Classes/DataAccess/Repositories/DBCourseRepository.php");
include_once("Classes/DataAccess/Repositories/DBSemesterRepository.php");
include_once("Classes/DataAccess/Repositories/DBStudentRepository.php");
include_once("Classes/DataAccess/Repositories/DBCourseOfferRepository.php");
include_once("Classes/DataAccess/Repositories/DBRegistrationRepository.php");

// ================================================================================
// Start the Session in the Header since the header is included in all the pages
session_start();
?>