function txtChange(thisPointer) {
    var isChecked = document.getElementById("isChecked");
    var presentaddresstxt = thisPointer.value;
    var permanentaddress = document.getElementById("per_address");
    if (isChecked.checked == true) {
        permanentaddress.value = presentaddresstxt;
    }
}

function check(thisPointer) {
    // Present address field Id
    var pre_divisionid=document.getElementById("pre_divisionid");
    var pre_districtid=document.getElementById("pre_districtid");
    var pre_thanaid=document.getElementById("pre_thanaid");
    var pre_postofficeid=document.getElementById("pre_postofficeid");
    var pre_localgovid=document.getElementById("pre_localgovid");
    var pre_address = document.getElementById("pre_address");
    var presentaddresstxt = pre_address.value;
    // Permanent Address Field Id
    var per_address = document.getElementById("per_address");
    var per_divisionid=document.getElementById("per_divisionid");
    var per_districtid=document.getElementById("per_districtid");
    var per_thanaid=document.getElementById("per_thanaid");
    var per_postofficeid=document.getElementById("per_postofficeid");
    var per_postcode=document.getElementById("per_postcode");
    var per_localgovid=document.getElementById("per_localgovid");
    if (thisPointer.checked == true) {
        per_divisionid.disabled=true;
        per_divisionid.value=pre_divisionid.value;
        per_districtid.disabled=true;
        per_districtid.value=pre_districtid.value;
        per_thanaid.disabled=true;
        per_thanaid.value=pre_thanaid.value;
        per_postofficeid.disabled=true;
        per_postofficeid.value=pre_postofficeid.value;
        per_postcode.disabled=true;
        per_localgovid.disabled=true;
        per_localgovid.value=pre_localgovid.value;
        per_address.value = presentaddresstxt;
        per_address.disabled=true;
    } else {
        per_address.value = "";
        per_address.disabled=false;
        per_divisionid.disabled=false;
        per_districtid.disabled=false;
        per_thanaid.disabled=false;
        per_postofficeid.disabled=false;
        per_postcode.disabled=false;
        per_localgovid.disabled=false;
    }
}

//Miltiple Step From

// var currentTab = 0;
// showTab(currentTab);
// function showTab(n) {
//     var x = document.getElementsByClassName("formsegment");
//     x[n].style.display = "block";
//     if (n == 0) {
//         document.getElementById("prevBtn").style.display = "none";
//     } else {
//         document.getElementById("prevBtn").style.display = "inline";
//     }
//     if (n == (x.length - 1)) {
//         document.getElementById("nextBtn").innerHTML = "Submit";
//     } else {
//         document.getElementById("nextBtn").innerHTML = "Next";
//     }
// }

// function nextPrev(n) {
//     var x = document.getElementsByClassName("formsegment");
//     x[currentTab].style.display = "none";
//     currentTab = currentTab + n;
//     // console.log(n);
//     // console.log("Current form segment :" + currentTab);
//     // console.log("Total form segment :" + x.length);
//     if (currentTab >= x.length) {
//         document.getElementById("regForm").submit();
//         return false;
//     }
//     showTab(currentTab);
// }
function agecalculate(thisref){
    // var id=thisref.getAttribute('id');
    // var value=$("#"+id).val();
    // var age=$('#age');
    // var d = new Date();
    // console.log(d);
}
