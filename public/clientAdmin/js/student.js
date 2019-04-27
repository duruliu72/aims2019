function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="program"){
		getChangeOnProgram(id,option,"#groupid",1);
		getChangeOnProgram(id,option,"#mediumid",2);
		getChangeOnProgram(id,option,"#shiftid",3);
	}else if(option=="group"){
		getChangeOnGroup(id,option,"#mediumid",1);
		getChangeOnGroup(id,option,"#shiftid",2);
	}else if(option=="medium"){
		getChangeOnMedium(id,option,"#shiftid",1);
	}
}
function getChangeOnProgram(id,option,output,methodid){
	var programid=$("#"+id).val();
	var groupid=0;
	var mediumid=0;
	var shiftid=0;
	$.ajax({
		type:'get',
		url: "students/getValue",
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
		url: "students/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnMedium(id,option,output,methodid){
	var programid=$("#programid").val();
	var groupid=$("#groupid").val();
	var mediumid=$("#"+id).val();
	var shiftid=0;
	$.ajax({
		type:'get',
		url: "students/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnShift(id,option,output,methodid){
	var programid=$("#programid").val();
	var groupid=$("#groupid").val();
	var mediumid=$("#mediumid").val();
	var shiftid=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "students/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}

// ========================Check box========================
let coursecheckid=document.getElementById("coursecheckid");
let applicantcheckid=document.getElementById("applicantcheckid");
let coursecheckClass=document.getElementsByClassName("coursecheck");
let applicantcheckClass=document.getElementsByClassName("applicantcheck");
function checkUncheck(idname,classname){
	if(idname.checked===true){
		for(let i=0;i<classname.length;i++){
			classname[i].checked=true;
		}
	}else{
		for(let i=0;i<classname.length;i++){
			classname[i].checked=false;
		}
	}
}
coursecheckid.addEventListener("click",function(e){
	checkUncheck(coursecheckid,coursecheckClass);
});
applicantcheckid.addEventListener("click",function(e){
	console.log(applicantcheckClass);
	checkUncheck(applicantcheckid,applicantcheckClass);
});

