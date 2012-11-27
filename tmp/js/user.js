(function() {

var userCtl={};


$(document).ready(function(){
	userCtl.init();
});

userCtl.init=function(){
	
	
	function mapInit() {
		var latlng = new google.maps.LatLng(35.6815,139.786);
		var myOptions = {
			zoom: 12,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map"),myOptions);
	
	}

	
	mapInit();
	
	
	/* useredit */
	var editShowChk=false;
	$("#select_area .edit").on('click',function(){
		if(editShowChk){
			editClose();
		}else{
			editShow();
		}
		return false;
	});
	$("#select_area .close").on('click',function(){
		editClose();
		return false;
	});
	
	function editShow(){
		editShowChk=true;
		$("#edit_area").css("height","1px").css("display","block").stop().animate({height:244},300,"easeOutQuint");
	}
	function editClose(){
		editShowChk=false;
		$("#edit_area").stop().animate({height:1},300,"easeOutQuint",function(){$("#edit_area").css("display","none")});
	}
	
	
}


})();