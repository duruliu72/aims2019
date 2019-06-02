function changeAddress(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="division"){
        console.log("dd");
		getChangeOnDivision(id,option,"#districtid",1);
	}else if(option=="district"){
		getChangeOnDistrict(id,option,"#thanaid",1);
	}else if(option=="thana"){
		getChangeOnThana(id,option,"#postofficeid",1);
		getChangeOnThana(id,option,"#localgovid",2);
	}
}
function getChangeOnDivision(id,option,output,methodid){
	var divisonid=$("#"+id).val();
	var districtid=0;
	var thanaid=0;
	$.ajax({
		type:'get',
		url: baseUrl+"institute/changeaddress",
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
		url: baseUrl+"institute/changeaddress",
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
		url: baseUrl+"institute/changeaddress",
		dataType: "html",
		data: {'id':thanaid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}