function getChange(thisref, option) {
    var id = thisref.getAttribute("id");
    if (option == "session") {
        getChangeOnSession(id, option, "#programlabelid", 1);
        getChangeOnSession(id, option, "#programid", 2);
        getChangeOnSession(id, option, "#groupid", 3);
        getChangeOnSession(id, option, "#mediumid", 4);
        getChangeOnSession(id, option, "#shiftid", 5);
        getChangeOnSession(id, option, "#sectionid", 6);
    } else if (option == "programlabel") {
        getChangeOnPLabel(id, option, "#programid", 2);
        getChangeOnPLabel(id, option, "#groupid", 3);
        getChangeOnPLabel(id, option, "#mediumid", 4);
        getChangeOnPLabel(id, option, "#shiftid", 5);
        getChangeOnPLabel(id, option, "#sectionid", 6);
    } else if (option == "program") {
        getChangeOnProgram(id, option, "#groupid", 3);
        getChangeOnProgram(id, option, "#mediumid", 4);
        getChangeOnProgram(id, option, "#shiftid", 5);
        getChangeOnProgram(id, option, "#sectionid", 6);
    } else if (option == "group") {
        getChangeOnGroup(id, option, "#sectionid", 6);
    } else if (option == "medium") {
        getChangeOnMedium(id, option, "#groupid", 3);
        getChangeOnMedium(id, option, "#shiftid", 5);
        getChangeOnMedium(id, option, "#sectionid", 6);
    } else if (option == "shift") {
        getChangeOnShift(id, option, "#groupid", 3);
        getChangeOnShift(id, option, "#sectionid", 6);
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
        url: baseUrl + "students/getValue",
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
        url: baseUrl + "students/getValue",
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
        url: baseUrl + "students/getValue",
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
function getChangeOnGroup(id, option, output, methodid) {
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#programid").val();
    var groupid = $("#" + id).val();
    var mediumid = $("#mediumid").val();
    var shiftid = $("#shiftid").val();
    $.ajax({
        type: "get",
        url: baseUrl + "students/getValue",
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
function getChangeOnMedium(id, option, output, methodid) {
    var sessionid = $("#sessionid").val();
    var programlabelid = $("#programlabelid").val();
    var programid = $("#programid").val();
    var groupid = 0;
    var mediumid = $("#" + id).val();
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "students/getValue",
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
    var sectionid = 0;
    var mstexamnameid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "students/getValue",
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
