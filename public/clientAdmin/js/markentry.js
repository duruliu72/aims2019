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
        getChangeOnGroup(id, option, "#sectionid", 6);
    } else if (option == "medium") {
        getChangeOnMedium(id, option, "#groupid", 3);
        getChangeOnMedium(id, option, "#shiftid", 5);
    } else if (option == "shift") {
        getChangeOnShift(id, option, "#groupid", 3);
    } else if (option == "mstexam") {
        // for master exam methodid=7
        getChangeOnMstExam(id, option, "#courseid", 7);
    } else if (option == "mstexamedit") {
        // for master exam methodid=8
        getChangeOnMstExam(id, option, "#courseid", 8);
    }
}
function getChangeOnSession(id, option, output, methodid) {
    var sessionid = $("#" + id).val();
    var programlabelid = 0;
    var programid = 0;
    var groupid = 0;
    var mediumid = 0;
    var shiftid = 0;
    var sectionid = 0;
    var mstexamnameid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "mstexammark/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            sectionid: sectionid,
            mstexamnameid: mstexamnameid,
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
    var sectionid = 0;
    var mstexamnameid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "mstexammark/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            sectionid: sectionid,
            mstexamnameid: mstexamnameid,
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
    var sectionid = 0;
    var mstexamnameid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "mstexammark/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            sectionid: sectionid,
            mstexamnameid: mstexamnameid,
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
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#programid").val();
    var groupid = $("#" + id).val();
    var mediumid = $("#mediumid").val();
    var shiftid = $("#shiftid").val();
    var sectionid = 0;
    var mstexamnameid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "mstexammark/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            sectionid: sectionid,
            mstexamnameid: mstexamnameid,
            option: option,
            methodid: methodid
        },
        success: function(result) {
            console.log(result);
            $(output)
                .empty()
                .append(result);
        }
    });
}
function getChangeOnMedium(id, option, output, methodid) {
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#programid").val();
    var groupid = 0;
    var mediumid = $("#" + id).val();
    var shiftid = 0;
    var sectionid = 0;
    var mstexamnameid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "mstexammark/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            sectionid: sectionid,
            mstexamnameid: mstexamnameid,
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
    var sectionid = 0;
    var mstexamnameid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "mstexammark/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            sectionid: sectionid,
            mstexamnameid: mstexamnameid,
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
function getChangeOnMstExam(id, option, output, methodid) {
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#programid").val();
    var groupid = $("#groupid").val();
    var mediumid = $("#mediumid").val();
    var shiftid = $("#shiftid").val();
    var sectionid = $("#sectionid").val();
    var mstexamnameid = $("#" + id).val();
    console.log(sectionid);
    $.ajax({
        type: "get",
        url: baseUrl + "mstexammark/getValue",
        dataType: "html",
        data: {
            sessionid: sessionid,
            programlabelid: programlabelid,
            programid: programid,
            groupid: groupid,
            mediumid: mediumid,
            shiftid: shiftid,
            sectionid: sectionid,
            mstexamnameid: mstexamnameid,
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
if (markcheckid != null) {
    markcheckid.addEventListener("click", function(e) {
        checkUncheck();
    });
}

/////////////////
let markentry = document.getElementById("markentry");
if (markentry != null) {
    let trarray = markentry.children[1].getElementsByTagName("tr");
    let subjectmarks = document.getElementsByClassName("categorymarks");
    for (var tr of trarray) {
        var tdarray = tr.children;
        var tdclass;
        for (var td of tdarray) {
            if (td.getAttribute("class") != null) {
                tdclass = td.getAttribute("class");
            }
        }
        let markfield = document.getElementsByClassName(tdclass);
        // console.log(markfield);
        let duplicate = [];
        for (let x = 0; x < markfield.length - 1; x++) {
            duplicate.push(markfield[x].children[0].value);
        }
        for (let x = 0; x < markfield.length - 1; x++) {
            markfield[x].children[0].addEventListener("keyup", function(e) {
                if (markfield[x].children[0].value != "") {
                    if (
                        parseInt(markfield[x].children[0].value) >
                        parseInt(subjectmarks[x].innerHTML)
                    ) {
                        markfield[x].children[0].value = duplicate[x];
                        confirm(
                            "Input must be less than or equil : " +
                                subjectmarks[x].innerHTML
                        );
                    }
                }
                let sum = 0;
                for (let i = 0; i < markfield.length - 1; i++) {
                    if (markfield[i].children[0].value != "") {
                        sum =
                            parseInt(sum) +
                            parseInt(markfield[i].children[0].value);
                        markfield[
                            markfield.length - 1
                        ].children[0].innerHTML = sum;
                    } else {
                        sum = parseInt(sum) + 0;
                        markfield[
                            markfield.length - 1
                        ].children[0].innerHTML = sum;
                    }
                }
            });
        }
    }
}
