$("body").on("change", "#semesterSelect", makeAJAXCall($("#semesterSelect").val()));
console.log("Added event listener!");

function makeAJAXCall(semesterCode) {
    console.log("Fetching courses...")
    $.ajax("CourseSelectionAJAX.php?semesterCode=" + encodeURIComponent(semesterCode) + "&studentID=" + encodeURIComponent($("#studentID").val()), {
        success: function(data) {
            Array.from(data).forEach(function(course) {
                var row = $("<tr/>");
                for (att in course) {
                    var field = $("<td/>");
                    field.append(course[att]);
                    row.append(field);
                }
                row.append("<input type='checkbox' name='course[]' value='" + course.courseCode + "' />");
                $("#tbody").append(row);
            })
        },
        error: function() {
            var row = $("<row/>");
            var field = $("<td/>");
            field.append("There was an error fetching courses!");
            field.attr("colspan", 4);
            row.append(field);
            $("#tbody").append(row);
        }
    })
}