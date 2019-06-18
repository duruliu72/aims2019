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
// ========================Check box========================
let markcheckid=document.getElementById("markcheckid");
let markcheckClass=document.getElementsByClassName("markcheck");
function checkUncheck(){
	if(markcheckid.checked===true){
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=true;
		}
	}else{
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=false;
		}
	}
}
markcheckid.addEventListener("click",function(e){
	checkUncheck();
});

/////////////////
let markentry=document.getElementById("markentry");
if(markentry!=null){
	let trarray=markentry.children[1].getElementsByTagName("tr");
	let subjectmarks=document.getElementsByClassName("categorymarks");
	for(var tr of trarray){
		var tdarray=tr.children;
		var tdclass;
		for(var td of tdarray){
			if(td.getAttribute("class")!=null){
				tdclass=td.getAttribute("class");
			}
		}
		let markfield=document.getElementsByClassName(tdclass);
		// console.log(markfield);
		let duplicate=[];
		for (let x=0;x<markfield.length-1;x++) {
			duplicate.push(markfield[x].children[0].value);
		}
		for(let x=0;x<markfield.length-1;x++){
			markfield[x].children[0].addEventListener("keyup",function(e){
				if(markfield[x].children[0].value!=""){
					if (parseInt(markfield[x].children[0].value)>parseInt(subjectmarks[x].innerHTML)) {
						markfield[x].children[0].value=duplicate[x];
						confirm("Input must be less than or equil : "+subjectmarks[x].innerHTML);
					}
				}
				let sum=0;
				for(let i=0;i<markfield.length-1;i++){
					if(markfield[i].children[0].value!=""){
						sum=parseInt(sum)+parseInt(markfield[i].children[0].value);
						markfield[markfield.length-1].children[0].innerHTML=sum;
					}else{
						sum=parseInt(sum)+0;
						markfield[markfield.length-1].children[0].innerHTML=sum;
					}
				}
			});
		}
	}
}


