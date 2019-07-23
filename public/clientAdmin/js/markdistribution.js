function getChange(thisref, option) {
    var id = thisref.getAttribute("id");
    if (option == "program") {
        getChangeOnProgram(id, option, "#mediumid", 1);
        getChangeOnProgram(id, option, "#shiftid", 2);
        getChangeOnProgram(id, option, "#groupid", 3);
    } else if (option == "group") {
        // getChangeOnGroup(id,option,"#mediumid",1);
        // getChangeOnGroup(id,option,"#shiftid",2);
    } else if (option == "medium") {
        getChangeOnMedium(id, option, "#shiftid", 1);
        getChangeOnMedium(id, option, "#groupid", 2);
    } else if (option == "shift") {
        getChangeOnShift(id, option, "#groupid", 1);
    }
}
function getChangeOnProgram(id, option, output, methodid) {
    var programid = $("#" + id).val();
    var groupid = 0;
    var mediumid = 0;
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            option: option,
            methodid: methodid
        },
        success: function(result) {
            $(output)
                .empty()
                .append(result);
        }
    });
}
function getChangeOnGroup(id, option, output, methodid) {
    var programid = $("#programid").val();
    var groupid = $("#" + id).val();
    var mediumid = 0;
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            option: option,
            methodid: methodid
        },
        success: function(result) {
            $(output)
                .empty()
                .append(result);
        }
    });
}
function getChangeOnMedium(id, option, output, methodid) {
    var programid = $("#programid").val();
    var groupid = 0;
    var mediumid = $("#" + id).val();
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            option: option,
            methodid: methodid
        },
        success: function(result) {
            $(output)
                .empty()
                .append(result);
        }
    });
}
function getChangeOnShift(id, option, output, methodid) {
    var programid = $("#programid").val();
    var groupid = 0;
    var mediumid = $("#mediumid").val();
    var shiftid = $("#" + id).val();
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            option: option,
            methodid: methodid
        },
        success: function(result) {
            $(output)
                .empty()
                .append(result);
        }
    });
}

// ========================Check box========================
let markcheckid = document.getElementById("markcheckid");
let markcheckClass = document.getElementsByClassName("markcheck");
function checkUncheck() {
    if (markcheckid.checked === true) {
        for (let i = 0; i < markcheckClass.length; i++) {
            markcheckClass[i].checked = true;
        }
    } else {
        for (let i = 0; i < markcheckClass.length; i++) {
            markcheckClass[i].checked = false;
        }
    }
}
markcheckid.addEventListener("click", function(e) {
    checkUncheck();
});

// Mark distributon Form
function calMarkDistribution() {
    var subject_mark = document.getElementsByClassName("subject_mark");
    for (let index = 0; index < subject_mark.length; index++) {
        var coursemark = subject_mark[index].querySelector(".coursemark")
            .innerHTML;
        var course = {
            max_mark: coursemark,
            sub_cat: [0, 0, 0]
        };
        var course_subcat = subject_mark[index].querySelectorAll(
            ".course_subcat"
        );
        course_subcat.forEach(element => {
            // var x =
            //     course_subcat[0].element.querySelectorAll("input")[2] +
            //     course_subcat[1].element.querySelectorAll("input")[2] +
            //     course_subcat[2].element.querySelectorAll("input")[2] +
            //     course_subcat[3].element.querySelectorAll("input")[2];
            var inputfields = element.querySelectorAll("input");
            function cal() {
                inputfields[2].value =
                    (parseInt(inputfields[0].value) *
                        parseInt(inputfields[1].value)) /
                    100;
                if (inputfields[2].value == "NaN") {
                    inputfields[2].value = "";
                    course.sub = 0;
                } else {
                }
                subject_mark[index].querySelector(".tot_mark").value = 80;
            }
            cal();
            inputfields.forEach(input_field => {
                input_field.addEventListener("keyup", () => {
                    cal();
                    console.log(input_field);
                });
            });
        });
    }
}
calMarkDistribution();
