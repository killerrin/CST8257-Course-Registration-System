;
console.log("Adding event listener!");
$("body").on("change", "#semesterSelect", function () { makeAJAXCall($("#semesterSelect").val()) });
$("body").on("click", "#courseSelectionClear", function () { makeAJAXCall($("#semesterSelect").val()) });

$(document).ready(function() { makeAJAXCall($("#semesterSelect").val()) });

function makeAJAXCall(semesterCode) {
    console.log("Fetching courses...");
    $("#semesterHidden").val($("#semesterSelect").val());
    $.ajax("CourseSelectionAJAX.php?semesterCode=" + encodeURIComponent(semesterCode) + "&studentID=" + encodeURIComponent($("#studentID").val()), {
        success: function(data) {
            clearTable();
            console.log("Populating table with response");
            Array.from(data[0]).forEach(function(course) {
                var row = $("<tr/>");
                for (att in course) {
                    var field = $("<td/>");
                    field.append(course[att]);
                    row.append(field);
                }
                row.append("<input type='checkbox' name='course[]' value='" + course.courseCode + "' />");
                $("#tbody").append(row);
            });

            console.log(data);

            $("#weeklyHours").text(data[1]);
            $("#remainingHours").text(16 -data[1]);
        },
        error: function() {
            clearTable();
            console.log("Error fetching courses");
            var row = $("<tr/>");
            var field = $("<td/>");
            field.append("There was an error fetching courses!");
            field.attr("colspan", 4);
            row.append(field);
            $("#tbody").append(row);
        }
    });
}

function clearTable() {
    console.log("Clearing table...");
    $("#tbody tr").remove();
}