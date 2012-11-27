(function() {
var usereditCtl={};

$(document).ready(function(){
	usereditCtl.init();
});

usereditCtl.init=function(){
	
	if(browser.IEChk()<=8){//for ie
		$('label').click(function () {
			$('#' + $(this).attr('for')).focus().click();
		});
	}
	
	$("#username_display input").on('change',function(){
		var targetNo=$(this).parent().index()+1;
		inputSet(targetNo);
	});
	function inputSet(num){
		if(num==1){
			$("#username input").removeAttr("disabled");
		}else{
			$("#username input").attr("disabled", "disabled");
		}
		$("#username_display .frame").css("left",((num-1)*127-10)+"px");
	}
	
	inputSet($("#username_display input:checked").parent().index()+1);
	
}

})();