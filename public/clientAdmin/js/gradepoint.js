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
    // console.log(methodid);
    $.ajax({
        type: "get",
        url: baseUrl + "gradepoint/getValue",
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
        url: baseUrl + "gradepoint/getValue",
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
        url: baseUrl + "gradepoint/getValue",
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
//         url: baseUrl + "gradepoint/getValue",
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
    $.ajax({
        type: "get",
        url: baseUrl + "gradepoint/getValue",
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
        url: baseUrl + "gradepoint/getValue",
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

// ========================Courseoffer Check box========================
let admissionmark = document.getElementById("gradepoint");
if (admissionmark != null) {
    // for chekbox
    let markcheckid = document.getElementById("markcheckid");
    let markcheckClass = document.getElementsByClassName("markcheck");
    function disableOrEnable() {
        if (markcheckid.checked === true) {
            for (let i = 0; i < markcheckClass.length; i++) {
                markcheckClass[i].checked = true;
                rowToggle(markcheckClass[i]);
            }
        } else {
            for (let i = 0; i < markcheckClass.length; i++) {
                markcheckClass[i].checked = false;
                rowToggle(markcheckClass[i]);
            }
        }
    }
    disableOrEnable();
    markcheckid.addEventListener("click", function(e) {
        disableOrEnable();
    });

    let chechdid = 1;
    let uncheckid = 1;
    function rowToggle(thisref) {
        let list = [];
        if (thisref.checked) {
            let tdcollection = thisref.parentNode.parentNode.children;
            Array.from(tdcollection).forEach(item => {
                let inputList = item.getElementsByTagName("input");
                let selectList = item.getElementsByTagName("select");
                if (inputList.length > 0)
                    for (let input of inputList) {
                        if (
                            input.getAttribute("type") == "text" ||
                            input.getAttribute("type") == "hidden"
                        )
                            list.push(input);
                    }
                for (let select of selectList) {
                    list.push(select);
                }
            });
            for (let x of list) {
                x.disabled = false;
                // console.log(x);
            }
        } else {
            let tdcollection = thisref.parentNode.parentNode.children;
            Array.from(tdcollection).forEach(item => {
                let inputList = item.getElementsByTagName("input");
                let selectList = item.getElementsByTagName("select");
                if (inputList.length > 0)
                    for (let input of inputList) {
                        if (
                            input.getAttribute("type") == "text" ||
                            input.getAttribute("type") == "hidden"
                        )
                            list.push(input);
                    }
                for (let select of selectList) {
                    list.push(select);
                }
            });
            for (let x of list) {
                x.disabled = true;
                // console.log(x);
            }
        }
    }
    function markCheckAction() {
        for (let i = 0; i < markcheckClass.length; i++) {
            markcheckClass[i].addEventListener("click", function() {
                rowToggle(this);
            });
        }
    }
    markCheckAction();
}
// ========================Secrion offer And teacher Assign ========================
// let sectionofferbtn=document.getElementById('sectionofferbtn');
// let tbody=document.getElementById('tbody');
// let content=tbody.innerHTML;
// sectionofferbtn.addEventListener('click',function(){
// 	actionOn(true);
// });
// function actionOn(isTrue){
// 	if(isTrue){
// 		tbody.innerHTML+=content;
// 	}
// 	for(let tr of tbody.children){
//         for(let td of tr.children){
//             if(td.children[0].nodeName=='SPAN')
//             td.children[0].addEventListener('click',function(){
// 				if(tbody.children.length>1){
// 					let deleterow=this.parentNode.parentNode;
// 					deleterow.parentNode.removeChild(deleterow);
// 					content=tbody.innerHTML;
// 				}
//             });
//         }
//     }
// }
// actionOn(false);
