function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="program"){
		getChangeOnProgram(id,option,"#mediumid",1);
        getChangeOnProgram(id,option,"#shiftid",2);
        getChangeOnProgram(id,option,"#groupid",3);
	}else if(option=="group"){
		// getChangeOnGroup(id,option,"#mediumid",1);
        // getChangeOnGroup(id,option,"#shiftid",2);
	}else if(option=="medium"){
        getChangeOnMedium(id,option,"#shiftid",1);
        getChangeOnMedium(id,option,"#groupid",2);
	}else if(option=="shift"){
        getChangeOnShift(id,option,"#groupid",1);
    }
}
function getChangeOnProgram(id,option,output,methodid){
	var programid=$("#"+id).val();
    var groupid=0;
	var mediumid=0;
	var shiftid=0;
	$.ajax({
		type:'get',
		url: baseUrl+"admissionprogram/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnGroup(id,option,output,methodid){
	var programid=$("#programid").val();
    var groupid=$("#"+id).val();
	var mediumid=0;
	var shiftid=0;
	$.ajax({
		type:'get',
		url: baseUrl+"admissionprogram/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnMedium(id,option,output,methodid){
    var programid=$("#programid").val();
    var groupid=0;
	var mediumid=$("#"+id).val();
    var shiftid=0;
	$.ajax({
		type:'get',
		url: baseUrl+"admissionprogram/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnShift(id,option,output,methodid){
    var programid=$("#programid").val();
    var groupid=0;
	var mediumid=$("#mediumid").val();
    var shiftid=$("#"+id).val();
	$.ajax({
		type:'get',
		url: baseUrl+"admissionprogram/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}

function changeAddress(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="pre_division"){
		getChangeOnDivision(id,option,"#pre_districtid",1);
	}else if(option=="pre_district"){
		getChangeOnDistrict(id,option,"#pre_thanaid",1);
	}else if(option=="pre_thana"){
		getChangeOnThana(id,option,"#pre_postofficeid",1);
		getChangeOnThana(id,option,"#pre_localgovid",2);
	}else if(option=="per_division"){
		getChangeOnDivision(id,option,"#per_districtid",1);
	}else if(option=="per_district"){
		getChangeOnDistrict(id,option,"#per_thanaid",1);
	}else if(option=="per_thana"){
		getChangeOnThana(id,option,"#per_postofficeid",1);
		getChangeOnThana(id,option,"#per_localgovid",2);
	}else if(option=="g_division"){
		getChangeOnDivision(id,option,"#g_districtid",1);
	}else if(option=="g_district"){
		getChangeOnDistrict(id,option,"#g_thanaid",1);
	}else if(option=="g_thana"){
		getChangeOnThana(id,option,"#g_postofficeid",1);
		getChangeOnThana(id,option,"#g_localgovid",2);
	}
}
function getChangeOnDivision(id,option,output,methodid){
	var divisonid=$("#"+id).val();
	var districtid=0;
	var thanaid=0;
	$.ajax({
		type:'get',
		url: baseUrl+"admission/changeAddress",
		dataType: "html",
		data: {'id':divisonid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnDistrict(id,option,output,methodid){
	var divisonid=0;
	var districtid=$("#"+id).val();
	var thanaid=0;
	$.ajax({
		type:'get',
		url: baseUrl+"admission/changeAddress",
		dataType: "html",
		data: {'id':districtid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnThana(id,option,output,methodid){
	var divisonid=0;
	var districtid=0;
	var thanaid=$("#"+id).val();
	$.ajax({
		type:'get',
		url: baseUrl+"admission/changeAddress",
		dataType: "html",
		data: {'id':thanaid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}