var commonCtl={};
var spotCtl={};

$(document).ready(function(){
	commonCtl.init();
});

commonCtl.init=function(){
	
	
	// searchBox
	if($(".search_box").length>0){
		commonCtl.searchBoxSet();
	}
	
	if($("header .search").length>0){
		commonCtl.simpleSearch();
	}
	
	// login
	commonCtl.loginInit();
	
	// menu
	if(browser.IEChk()<=9){
		commonCtl.menuAct();
	}
	
	$(window).resize(commonCtl.resize);
	commonCtl.resize();
};


/* resize
-----------------------------------------*/
commonCtl.resize=function(){
	browser.sizeChk();
	$("#loginArea .cover").css("height",$(document).height()+"px");
};


/* menu for min IE 8
-----------------------------------------*/
commonCtl.menuAct=function(){
	$("#globalnavi li").each(function(index, element) {
		if($(this).find("img").css("top").split("px").join("")>=0){
			$(this).hover(function(){
				$(this).find("img").stop().animate({top:-42},300,"easeOutQuint");
			},function(){
				$(this).find("img").stop().animate({top:0},300,"easeOutQuint");
			});
		}
	});
};

commonCtl.simpleSearch = function() {
	$("header form").on("submit", function() {
		if ($("header form [name='type']:checked").val() == "spot") {
			$("header form").attr("action", gBaseUrl + "spot/search");
		} else {
			$("header form").attr("action", gBaseUrl + "tour/search");
		}
	});
};

/* searchBox
-----------------------------------------*/
commonCtl.searchBoxSet=function(options){
	
	$(".search_box .selectbtn").on('click',function(){
		categorySelectShow();
		return false;
	});
	
	$(".search_box .categoryselect .close").on('click',function(){
		categorySelectHide();
		return false;
	});
	$(".search_box .categoryselect ul a").each(function(index, element) {
		$(this).on('click',function(){
			categorySet("/"+$(this).attr("data-category-id")+"/", $(this).text());
			commonCtl.searchBoxSet.setFunc();
			return false;
		});
	});
	
	$(".search_box .pg_search_map_btn").on("click", function() {
		if ($(".search_box [name='type']:checked").val() == "spot") {
			$(".search_box form").attr("action", gBaseUrl + "spot/search");
		} else {
			$(".search_box form").attr("action", gBaseUrl + "tour/search");
		}
	});
	
	/*
	$(".search_box .pg_search_map_btn").on("click", function() {
		if ($(".search_box [name='type']:checked").val() == "spot") {
			$(".search_box form").attr("action", gBaseUrl + "guest/spot/map");
		} else {
			$(".search_box form").attr("action", gBaseUrl + "guest/tour/map");
		}
	});
	*/

	$(".search_box .selectedCategory a").live('click',function(){
		categoryRemove();
		commonCtl.searchBoxSet.unsetFunc();
		return false;
	});

	function categorySet(id, str){
		categoryRemove();
		$(".search_box .category dd").append('<p class="selectedCategory"><a href="#close" class="close mouse_over">&nbsp;</a>'+str+'</p>');
		$(".search_box .category dd").append('<input type="hidden" name="category" value="'+id+'" />');
		categorySelectHide();
	}
	function categoryRemove(){
		$(".search_box .category dd .selectedCategory").remove();
		$(".search_box .category dd input").remove();
	}
	
	function categorySelectShow(){
		$(".search_box .categoryselect").css("left","165px").css("display","block").animate({left:170},300,"easeOutQuint");
	}
	function categorySelectHide(){
		$(".search_box .categoryselect").css("display","none");
	}
};

commonCtl.searchBoxSet.setFunc = function() {return false;};
commonCtl.searchBoxSet.unsetFunc = function() {return false;};


/* regist categoryAdd
-----------------------------------------*/
commonCtl.registCategoryAddSet=function(){
	var selectedCategoryNo=0;
	var selectedCategoryname="";
	var selectedSubCategoryname="";
	var selectedCategoryId="";
	
	function selectInit(){
		$("#input_area .categoryselect li").removeClass("select");
		$("#input_area .categoryselect select option").remove("");
		selectedCategoryname="";
		selectedCategoryId="";
		selectedSubCategoryname="";
		selectedCategoryNo=0;
	}
	function categoryAddShow(num){
		selectInit();
		selectedCategoryNo=num;
		$("#input_area .categoryselect").css("top",((num-1)*47-22)+"px").css("left","165px").css("display","block").animate({left:175},300,"easeOutQuint");
	}
	function categoryAddClose(){
		selectedCategoryNo=0;
		$("#input_area .categoryselect").css("display","none");
	}
	
	function categoryAdd(){
		var addCategoryName=selectedCategoryname;
		var target=$("#input_area  .categories .category"+selectedCategoryNo);

		//maincategory
		target.find(".category_add").css("display","none");
		target.append('<input type="hidden" name="category[]" value="'+selectedCategoryId+'" class="maincategory" />');
		target.append('<p class="selectedCategory"><a href="#close" class="close mouse_over"><img src="' + gAssetUrl + 'img/common/search/close.gif" alt="CLOSE" /></a>'+addCategoryName+'</p>');
		
		categoryAddClose();
	}
	
	function categoryRemove(num){
		var target=$("#input_area  .categories .category"+num);
		target.find(".selectedCategory").remove();
		target.find("input").remove();
		target.find(".category_add").css("display","block");
		orderSet();
	}
	function orderSet(){
		for(var i=1;i<$("#input_area .categories li").length;i++){
			categoryCopy(i,i+1);
		}
	} 
	function categoryCopy(setNo,copyNo){
		var setTarget=$("#input_area .categories li").eq(setNo-1);
		var target=$("#input_area .categories li").eq(copyNo-1);
		if(setTarget.find(".selectedCategory").length==0 && target.find(".selectedCategory").length>0){
			selectedCategoryNo=setNo;
			selectedCategoryname=target.find(".selectedCategory").text();
			categoryAdd();
			categoryRemove(copyNo);
		}
	}
	
	$("#input_area .selectedCategory .close").live('click',function(){
		categoryRemove($(this).parent().parent().index()+1);
		return false;
	});

	$("#input_area .categoryselect .close").on('click',function(){
		categoryAddClose();
		return false;
	});
	$("#input_area  .category_add").on('click',function(){
		var targetCategoryNo=$(this).parent().index()+1;
		if(targetCategoryNo==selectedCategoryNo){
			categoryAddClose();
		}else{
			categoryAddShow(targetCategoryNo);
		}
		return false;
	});
	//select
	$("#input_area .categoryselect li").on('click',function(){
		$("#input_area .categoryselect li").removeClass("select");
		$(this).addClass("select");
		var id = $(this).attr("data-category-id");
		$.ajax({
			type		: "get",
			url			: gBaseUrl + 'user/category/node/' + id,
			dataType	: "json",
			success		: function(json) {
				$("#input_area .categoryselect select option").remove();
				for (var key in json) {
					$("#input_area .categoryselect select").append('<option value="' + key +'">' + json[key] + '</option>');
				}
			}
		});
		selectedCategoryname = $(this).find("a").text();
		selectedCategoryId = "/"+id+"/";
		return false;
	});
	$("#input_area .categoryselect .add").on('click',function(){
		if(selectedCategoryname!=""){
			selectedCategoryname = selectedCategoryname + " : " + $("#input_area .categoryselect select option:selected").text();
			selectedCategoryId+=$("#input_area .categoryselect select option:selected").val()+"/";
			categoryAdd();
			orderSet();
		}
		return false;
	});

};


/* login
-----------------------------------------*/
commonCtl.loginInit=function(){
	
	$("#loginArea .cover").on('click',function(){
		commonCtl.loginClose();
	});
	$(".loginbtn").on('click',function(){
		commonCtl.loginShow($(this).attr("data-redirect"));
		return false;
	});
};
commonCtl.loginShow=function(url){
	commonCtl.resize();
	$("#loginArea iframe").css("top",Math.floor((browser.height-300)*0.5)+$(document).scrollTop()+"px");
	$("#loginArea iframe").attr("src",$("#loginArea iframe").attr("src")+"?redirect="+url);
	$("#loginArea").fadeIn(300);
};
commonCtl.loginClose=function(){
	$("#loginArea").fadeOut(300);
};


/* listitem height adjust
-----------------------------------------*/
commonCtl.listHeightAdjust=function(){
	var targetHeight=0;
	var targetArea;
	$(".list_area").each(function(i, element) {
		targetArea=$(this);
		targetHeight=0;
		$(this).find(".info_area").each(function(j, element) {
			if($(this).height()>targetHeight){
				targetHeight=$(this).height();
			}
			if(j%3==2){
				targetArea.find(".info_area").eq(j-2).css("height",targetHeight+35+"px");
				targetArea.find(".info_area").eq(j-1).css("height",targetHeight+35+"px");
				targetArea.find(".info_area").eq(j).css("height",targetHeight+35+"px");
				targetHeight=0;
			}
		});
	});

};

/* spot inner
-----------------------------------------*/
spotCtl.show=function(url){
	commonCtl.resize();
	if(url.indexOf("?")==-1){
		url=url+"?mode=direct";
	}else{
		url=url+"&mode=direct";
	}
	$("body").append('<div id="innerSpotDetailArea"><p class="cover"></p><div id="innerSpotFrame"><iframe width="550" height="500" allowtransparency="true"></iframe><p class="close"></p></div></div>');
	$("#innerSpotDetailArea .cover").css("height",$(document).height()+"px");
	$("#innerSpotDetailArea #innerSpotFrame").css("top",Math.floor((browser.height-500)*0.5)+$(document).scrollTop()+"px");
		$("#innerSpotDetailArea iframe").attr("src",url).load(function(){
			$("#innerSpotDetailArea .close").css("display","block");
		});
	$("#innerSpotDetailArea").fadeIn(300);
	$("#innerSpotDetailArea .cover, #innerSpotDetailArea .close").on('click',function(){
		spotCtl.close();
	});
};
spotCtl.close=function(){
	$("#innerSpotDetailArea iframe").attr("src","");
	$("#innerSpotDetailArea .close").css("display","none");
	$("#innerSpotDetailArea").fadeOut(300,"easeOutSine",function(){
		$("#innerSpotDetailArea").remove();
	});
};

$.extend({
	getUrlVars: function(){
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	},
	getUrlVar: function(name){
		return $.getUrlVars()[name];
	}
});