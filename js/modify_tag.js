$(function(){
	var before_value;
	var before_tag;
	var frm = $("form")[0];
	var position_top=0;

	$(document).on("click",function(e) {
		console.log(e.originalEvent);
		//console.trace();

		// this_tag.firstChild.data가 없을 때 오류 처리 
		// null, undefined 비교 불가 무조건 에러로 처리됨
		var this_tag = e.target;	
		position_top =e.originalEvent["pageY"];
		try{
			var imsi__=this_tag.firstChild.data;
		}catch{
			imsi__=""; 
		}

		if(this_tag.cellIndex==5 && imsi__ !="설명")
		{
			$(before_tag).html(before_value);			
			before_tag = this_tag;
			before_value = this_tag.innerHTML;
			frm.context_line.value=$(this_tag).data("line");
			frm.row_flag.value=1;

			frm.row_top.value=position_top-400;
			$(this_tag).html("<textarea name='context_moon' rows=5 cols='80%'>"+this_tag.innerText+"</textarea><br/><input type='submit' value='send'/>");
		}
		else if(this_tag.cellIndex==5 && imsi__=="설명")
		{
			$(before_tag).html(before_value);
		}
/*
		frm.on("submit",function(){
			before_value="";
			before_tag="";
		});
*/
	});
});