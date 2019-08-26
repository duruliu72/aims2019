function getChange(thisref, option) {
    var id = thisref.getAttribute("id");
    if (option == "session") {
        getChangeOnSession(id, option, "#programlabelid", 1);
        getChangeOnSession(id, option, "#programid", 2);
        getChangeOnSession(id, option, "#groupid", 3);
        getChangeOnSession(id, option, "#mediumid", 4);
        getChangeOnSession(id, option, "#shiftid", 5);
    } else if (option == "programlabel") {
        getChangeOnPLabel(id, option, "#programid", 2);
        getChangeOnPLabel(id, option, "#groupid", 3);
        getChangeOnPLabel(id, option, "#mediumid", 4);
        getChangeOnPLabel(id, option, "#shiftid", 5);
    } else if (option == "program") {
        getChangeOnProgram(id, option, "#groupid", 3);
        getChangeOnProgram(id, option, "#mediumid", 4);
        getChangeOnProgram(id, option, "#shiftid", 5);
    } else if (option == "group") {
        // getChangeOnGroup(id,option,"#mediumid",1);
        // getChangeOnGroup(id,option,"#shiftid",2);
    } else if (option == "medium") {
        getChangeOnMedium(id, option, "#groupid", 3);
        getChangeOnMedium(id, option, "#shiftid", 5);
    } else if (option == "shift") {
        getChangeOnShift(id, option, "#groupid", 3);
    }
}
function getChangeOnSession(id, option, output, methodid) {
    var sessionid = $("#" + id).val();
    var programlabelid = 0;
    var programid = 0;
    var groupid = 0;
    var mediumid = 0;
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
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
function getChangeOnPLabel(id, option, output, methodid) {
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#" + id).val();
    var programid = 0;
    var groupid = 0;
    var mediumid = 0;
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
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
function getChangeOnProgram(id, option, output, methodid) {
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#" + id).val();
    var groupid = 0;
    var mediumid = 0;
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
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
// function getChangeOnGroup(id, option, output, methodid) {
//     var sessionid = $("#sessionid").val();
//     var programlabelid = $("#programlabelid").val();
//     var programid = $("#programid");
//     var groupid = $("#" + id).val();
//     var mediumid = 0;
//     var shiftid = 0;
//     $.ajax({
//         type: "get",
//         url: baseUrl + "markdistribution/getValue",
//         dataType: "html",
//         data: {
//             sessionid: sessionid,
//             programlabelid: programlabelid,
//             programid: programid,
//             groupid: groupid,
//             mediumid: mediumid,
//             shiftid: shiftid,
//             option: option,
//             methodid: methodid
//         },
//         success: function(result) {
//             $(output)
//                 .empty()
//                 .append(result);
//         }
//     });
// }
function getChangeOnMedium(id, option, output, methodid) {
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#programid").val();
    var groupid = 0;
    var mediumid = $("#" + id).val();
    var shiftid = 0;
    // console.log(
    //     sessionid,
    //     programlabelid,
    //     programid,
    //     groupid,
    //     mediumid,
    //     shiftid,
    //     output,
    //     methodid
    // );
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
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
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#programid").val();
    var groupid = 0;
    var mediumid = $("#mediumid").val();
    var shiftid = $("#" + id).val();
    $.ajax({
        type: "get",
        url: baseUrl + "markdistribution/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
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
/////////////////////////////

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
$(document).ready(function() {
    function dispaly() {
        var raws = $(".subject_mark");
        raws.each(function(index, element) {
            let coursemark = parseFloat(
                $(element)
                    .find(".coursemark")
                    .text()
            );
            let course_subcats = $(element).find(".course_subcat");
            let tot_mark = $(element).find(".tot_mark");
            let total_mark = 0;
            course_subcats.each(function(index1, course_subcat) {
                var input1 = $(course_subcat)
                    .find(".input1")
                    .val();
                var input2 = $(course_subcat)
                    .find(".input2")
                    .val();
                var resultfield = $(course_subcat).find(".resultfield");
                var percentage = $(course_subcat).find(".percent");
                var total = (input1 * input2) / 100;
                resultfield.val(total);
                total_mark = total_mark + total;
                var mark_in_percentage = (total * 100) / coursemark;
                percentage.val(mark_in_percentage);
            });
            tot_mark.val(total_mark);
        });
    }
    dispaly();
    $(document).on("keyup", ".inputfield", function() {
        let data_raw = $(this)
            .parent()
            .attr("data-raw");
        var raw_obj = $("#" + data_raw);
        let parent = $(this).parent();
        var input1 = parent.find(".input1").val();
        var input2 = parent.find(".input2").val();
        var resultfield = parent.find(".resultfield");
        var percent = parent.find(".percent");
        var total = (input1 * input2) / 100;
        if (total == "NaN") {
            total = 0;
        }
        resultfield.val(total);
        let tot_markObj = raw_obj.find(".tot_mark");
        let input3obj = raw_obj.find(".input3");
        var coursemark = parseFloat(raw_obj.find(".coursemark").text());
        let mark_in_percentage = (total * 100) / coursemark;
        percent.val(mark_in_percentage);
        let total_mark = 0;
        for (let i = 0; i < input3obj.length; i++) {
            if ($(input3obj[i]).val() != "") {
                total_mark = total_mark + parseFloat($(input3obj[i]).val());
            }
        }
        if (total_mark > coursemark) {
            confirm("Mark Exceed limitation " + coursemark);
            tot_markObj.val(0);
        } else {
            console.log(total_mark);
            tot_markObj.val(total_mark);
        }
    });
});
