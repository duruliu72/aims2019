function getChange(thisref, option) {
    var id = thisref.getAttribute("id");
    if (option == "division") {
        getChangeOnDivision(id, option, "#districtid", 1);
        getChangeOnDivision(id, option, "#thanaid", 2);
        getChangeOnDivision(id, option, "#localgovid", 3);
        getChangeOnDivision(id, option, "#postofficeid", 4);
    } else if (option == "district") {
        getChangeOnDistrict(id, option, "#thanaid", 2);
        getChangeOnDistrict(id, option, "#localgovid", 3);
        getChangeOnDistrict(id, option, "#postofficeid", 4);
    } else if (option == "thana") {
        getChangeOnThana(id, option, "#localgovid", 3);
        getChangeOnThana(id, option, "#postofficeid", 4);
    }
}
function getChangeOnDivision(id, option, output, methodid) {
    var divisonid = $("#" + id).val();
    var districtid = 0;
    var thanaid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "institute/changeaddress",
        dataType: "html",
        data: {
            divisonid: divisonid,
            districtid: districtid,
            thanaid: thanaid,
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
function getChangeOnDistrict(id, option, output, methodid) {
    var divisonid = 0;
    var districtid = $("#" + id).val();
    var thanaid = 0;
    $.ajax({
        type: "get",
        url: baseUrl + "institute/changeaddress",
        dataType: "html",
        data: {
            divisonid: divisonid,
            districtid: districtid,
            thanaid: thanaid,
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
function getChangeOnThana(id, option, output, methodid) {
    var divisonid = 0;
    var districtid = 0;
    var thanaid = $("#" + id).val();
    $.ajax({
        type: "get",
        url: baseUrl + "institute/changeaddress",
        dataType: "html",
        data: {
            divisonid: divisonid,
            districtid: districtid,
            thanaid: thanaid,
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
