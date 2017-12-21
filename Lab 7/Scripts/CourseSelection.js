$("#semesterSelect").on("change", makeAJAXCall(this.val()));


function makeAJAXCall(semesterCode) {
    $.ajax("CourseSelectionAJAX.php?semesterCode=" + encodeURIComponent(semesterCode), {
        success: function(data) {
            data.forEach(function(course) {
                var row = $("<tr/>");
                for (att in course) {
                    var field = $("<td/>");
                    
                }
                $("#tbody")
            })
        },
        error: function() {

        }
    })
}