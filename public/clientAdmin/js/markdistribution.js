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
// function calMarkDistribution() {
//     var subject_mark = document.getElementsByClassName("subject_mark");
//     for (let index = 0; index < subject_mark.length; index++) {
//         var obj = {};
//         obj.coursemark = subject_mark[index].querySelector(
//             ".coursemark"
//         ).innerHTML;
//         // console.log(obj);
//         var course_subcat = subject_mark[index].querySelectorAll(
//             ".course_subcat"
//         );
//         course_subcat.forEach(element => {
//             var inputfields = element.querySelectorAll(".inputfield");
//             var sumfield = element.querySelector(".sumfield");
//             function cal() {
//                 sumfield.value =
//                     (parseInt(inputfields[0].value) *
//                         parseInt(inputfields[1].value)) /
//                     100;
//                 if (sumfield.value == "NaN") {
//                     sumfield.value = "";
//                 }
//                 var sumList = subject_mark[index].querySelectorAll(".sumfield");
//                 var total = 0;
//                 sumList.forEach(sum => {
//                     if (sum.value == "") {
//                         total = total + 0;
//                     } else {
//                         total = total + parseFloat(sum.value);
//                     }
//                     // console.log(total);
//                 });
//                 if (total > obj.coursemark) {
//                     confirm(
//                         "Mark Exceed limitation" +
//                             obj.coursemark +
//                             "sasa" +
//                             total
//                     );
//                     total = 0;
//                 }
//                 subject_mark[index].querySelector(".tot_mark").value = total;
//             }
//             function reversecal() {}
//             cal();
//             sumfield.addEventListener("keyup", () => {
//                 reversecal();
//             });
//             inputfields.forEach(input_field => {
//                 input_field.addEventListener("keyup", v => {
//                     cal();
//                     console.log(v);
//                 });
//             });
//         });
//     }
// }
// calMarkDistribution();
////////////////////////
$(document).ready(function() {
    function dispaly() {
        var raws = $(".subject_mark");
        raws.each(function(index, element) {
            let coursemark = parseInt(
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
                var sumfield = $(course_subcat).find(".sumfield");
                var percentage = $(course_subcat).find(".percent");
                var total = (input1 * input2) / 100;
                sumfield.val(total);
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
        var sumfield = parent.find(".sumfield");
        var percent = parent.find(".percent");

        var total = (input1 * input2) / 100;
        if (total == "NaN") {
            total = 0;
        }
        sumfield.val(total);
        let tot_markObj = raw_obj.find(".tot_mark");
        let input3obj = raw_obj.find(".input3");
        var coursemark = parseInt(raw_obj.find(".coursemark").text());
        let mark_in_percentage = (total * 100) / coursemark;
        percent.val(mark_in_percentage);
        let total_mark = 0;
        for (let i = 0; i < input3obj.length; i++) {
            if ($(input3obj[i]).val() != "") {
                total_mark = total_mark + parseInt($(input3obj[i]).val());
            }
        }
        if (total_mark > coursemark) {
            confirm("Mark Exceed limitation " + coursemark);
            tot_markObj.val(0);
        } else {
            tot_markObj.val(total_mark);
        }
    });
});
