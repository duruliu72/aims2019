function getChange(thisref, option) {
    var id = thisref.getAttribute("id");
    if (option == "program") {
        getChangeOnProgram(id, option, "#groupid", 1);
    }
}
function getChangeOnProgram(id, option, output, methodid) {
    var programid = $("#" + id).val();
    var groupid = 0;
    var mediumid = 0;
    var shiftid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "programoffer/getValue",
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
