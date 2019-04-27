
function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="programtogroup"){
		getValue(id,option,"#groupid",1);
	}else if(option=="admissiongroup"){
		getValue(id,option,"#groupid",1);
	}
}
function getValue(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "getValue",
		dataType: "html",
		data: {'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			// console.log(result);
			$(output).empty().append(result);
		}
	});
}
