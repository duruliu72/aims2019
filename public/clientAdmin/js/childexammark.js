function getChange(thisref, option) {
    var id = thisref.getAttribute("id");
    if (option == "program") {
        getChangeOnProgram(id, option, "#mediumid", 1);
        getChangeOnProgram(id, option, "#shiftid", 2);
        getChangeOnProgram(id, option, "#groupid", 3);
    } else if (option == "group") {
        getChangeOnGroup(id, option, "#masterexamid", 1);
        getChangeOnGroup(id, option, "#childexamcourse", 2);
    } else if (option == "medium") {
        getChangeOnMedium(id, option, "#shiftid", 1);
        getChangeOnMedium(id, option, "#groupid", 2);
    } else if (option == "shift") {
        getChangeOnShift(id, option, "#groupid", 1);
    } else if (option == "child_examname") {
        // getChangeOnChild_ExamName(id);
    }
}

function getChangeOnProgram(id, option, output, methodid) {
    var programid = $("#" + id).val();
    var groupid = 0;
    var mediumid = 0;
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "childexam/getValue",
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
    var mediumid = $("#mediumid").val();
    var shiftid = $("#shiftid").val();
    $.ajax({
        type: "get",
        url: baseUrl + "childexam/getValue",
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
        url: baseUrl + "childexam/getValue",
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
        url: baseUrl + "childexam/getValue",
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
var hld_marks_field = document.getElementById("hld_marks");
var hld_marks = hld_marks_field.value;
function getChangeOnChild_ExamName(id) {
    var programofferid = $("#programofferid").val();
    var mst_examnameid = $("#mst_examnameid").val();
    if (mst_examnameid == "") {
        confirm("Please Select Master Exam");
        return;
    }
    var child_examnameid = $("#" + id).val();
    $.ajax({
        type: "get",
        url: baseUrl + "childexammarkentry/getValue",
        dataType: "json",
        data: {
            programofferid: programofferid,
            mst_examnameid: mst_examnameid,
            child_examnameid: child_examnameid
        },
        success: function(result) {
            hld_marks = result.value;
            $("#hld_marksid")
                .empty()
                .append(result.output);
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
// Input validation
function inputValidation() {
    var obt_marks_fields = document.getElementsByClassName("obt_marks");
    for (let i = 0; i < obt_marks_fields.length; i++) {
        obt_marks_fields[i].addEventListener("keyup", function() {
            let obt_marks = obt_marks_fields[i].value;
            if (obt_marks > hld_marks) {
                confirm("Input must be less than or equil : " + hld_marks);
            }
        });
    }
}
inputValidation();
