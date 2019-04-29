
var baseUrl="http://localhost/school2019/public";
function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="rolecreate"){
		getChangeOnRoleCreator(id,option,"#output",1);
	}else if(option=="rolecedit"){
		getChangeOnRoleCreator(id,option,"#output",1);
	}
}
function getChangeOnRoleCreator(id,option,output,methodid){
	var rolecreatorid=$("#"+id).val();
	var createdroleid=$("#id").val();
	console.log(createdroleid);
	$.ajax({
		type:'get',
		url: baseUrl+"/role/getValue",
		dataType: "html",
		data: {'rolecreatorid':rolecreatorid,'createdroleid':createdroleid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
