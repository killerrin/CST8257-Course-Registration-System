# Handle the Database State
DROP SCHEMA IF EXISTS cst8257;
CREATE SCHEMA IF NOT EXISTS cst8257;
USE cst8257;

# Create the Tables
DROP TABLE IF EXISTS Student;
CREATE TABLE Student
(
	StudentId	VARCHAR(16)		NOT NULL PRIMARY KEY,
    Name		VARCHAR(256)	NOT NULL,
    Phone		VARCHAR(16),
    Password	VARCHAR(256)
);

DROP TABLE IF EXISTS Course;
CREATE TABLE Course
(
	CourseCode	VARCHAR(10)		NOT NULL PRIMARY KEY,
    Title		VARCHAR(256)	NOT NULL,
    WeeklyHours	INT 			NOT NULL				
);

DROP TABLE IF EXISTS Semester;
CREATE TABLE Semester
(
	SemesterCode	VARCHAR(10)	NOT NULL PRIMARY KEY,
    Term			VARCHAR(10)	NOT NULL,
    Year			INT			NOT NULL
);

DROP TABLE IF EXISTS CourseOffer;
CREATE TABLE CourseOffer
(
	CourseCode		VARCHAR(10)	NOT NULL,
    SemesterCode	VARCHAR(10) NOT NULL,
    INDEX (CourseCode),
    INDEX (SemesterCode),
	FOREIGN KEY (CourseCode) REFERENCES Course(CourseCode),
    FOREIGN KEY (SemesterCode) REFERENCES Semester(SemesterCode)
);

DROP TABLE IF EXISTS Registration;
CREATE TABLE Registration 
(
	StudentId		VARCHAR(16) NOT NULL,
    CourseCode		VARCHAR(10)	NOT NULL,
    SemesterCode	VARCHAR(10) NOT NULL,
    INDEX (StudentId),
	INDEX (CourseCode),
    INDEX (SemesterCode),
    FOREIGN KEY (StudentId) REFERENCES Student(StudentId),
	FOREIGN KEY (CourseCode) REFERENCES Course(CourseCode),
    FOREIGN KEY (SemesterCode) REFERENCES Semester(SemesterCode)
);

# Create User
#DROP USER IF EXISTS 'PHPSCRIPT'@'*';
#CREATE USER 'PHPSCRIPT'@'*' IDENTIFIED BY '1234';
#GRANT ALL PRIVILEGES ON cst8257.* TO 'PHPSCRIPT'@'*';
DROP USER IF EXISTS 'PHPSCRIPT'@'localhost';
CREATE USER 'PHPSCRIPT'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON cst8257.* TO 'PHPSCRIPT'@'localhost';
FLUSH PRIVILEGES;