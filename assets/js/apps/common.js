var commonCtl={};
var spotCtl={};
var tourCtl={};

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

commonCtl.iconTips = function() {
	if(!browser.touchOSchk()){
		$(".category_icon a").powerTip({
			placement: 'n',
			fadeInTime:20,
			fadeOutTime:20,
			intentPollInterval:60
		});
	}
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
	
	$(".search_box_l .pg_search_map_btn").on("click", function() {
		if ($(".search_box input:checkbox [name='type']:selected").val() == "spot") {
			$(".search_box form").attr("action", gBaseUrl + "spot/search");
		} else {
			$(".search_box form").attr("action", gBaseUrl + "tour/search");
		}
	});
	
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
		$("#input_area .categoryselect")
			.css("top",((num-1)*47-22)+"px")
			.css("left","165px")
			.css("display","block")
			.animate({left:175},300,"easeOutQuint");
	}
	function categoryAddClose(){
		selectedCategoryNo=0;
		$("#input_area .categoryselect")
			.css("display","none");
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
spotCtl.popup=function(url){
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

spotCtl.render = function(info, relation, class_name) {
	var elm = $(class_name+" .pg_temp")
		.clone(true)
		.show()
		.removeClass("pg_temp")
		.attr("data-spot-id", info.id)
		.attr("data-zoom", info.zoom);
	elm.css("display", "block");

	// icon
	elm.find(".icon img")
	.attr("src", gAssetUrl + "/img/common/icon/spot.png")
	.attr("alt", "スポット");
	
	if (info.image) {
		elm.find(".pg_img .pg_detail img")
			.attr("src", gBaseUrl + "uploads/spot/thumb/" + info.image.file_name);
	}
	
	// name
	elm.find(".pg_name")
		.text(info.name);
	
	// descripction
	elm.find(".pg_description")
		.text(info.description);
	
	// Facebook like button
	elm.find(".pg_like_count")
		.addClass("fb-like")
		.attr("data-href", gBaseUrl + 'user/spot/show/' + info.id);

	// Owner
	if (info.owner_name) {
		elm.find(".pg_owner")
			.text(info.owner_name);
	}
	
	// Prefecture
	if (info.prefecture) {
		elm.find(".pg_prefecture")
			.text(info.prefecture);
	} 
	
	// Stay time
	elm.find(".pg_stay_time")
		.text(info.stay_time + "分");
	
	// Category
	elm.find(".pg_category dd .category_icon").empty();
	var category_ids = [];
	if (info.category) {
		// Get root category
		$(info.category.split(",")).each(function(i, category_path) {
			category_ids.push(category_path.match(/\d+/g)[0]);
		});
		$.each($.unique(category_ids), function(i, category_id) {
			var icon = "";
			var category_name = relation["categories"][category_id];
			if (category_name) {
				if (category_name.indexOf("見る", 0) >= 0) {
					icon = "site.gif";
				} else if (category_name.indexOf("食べる", 0) >= 0) {
					icon = "food.gif";
				} else if (category_name.indexOf("遊ぶ", 0) >= 0) {
					icon = "enjoy.gif";
				} else if (category_name.indexOf("買う", 0) >= 0) {
					icon = "shopping.gif";
				} else if (category_name.indexOf("宿泊", 0) >= 0) {
					icon = "stay.gif";
				} else if (category_name.indexOf("乗り物", 0) >= 0) {
					icon = "transport.gif";
				}
				if (icon) {
					elm.find(".pg_category dd .category_icon").append('<li><a href="" title="'+category_name+'"><img src="' + gAssetUrl + '/img/common/icon/'+icon+'" alt="'+category_name+'" /></a></li>');
				}
			}
		});
	}

	// Tag
	elm.find(".pg_tags").empty();
	$(info.tags.match(/\d+/g)).each(function(i, tag_id) {
		elm.find(".pg_tags").append("<li>" + relation["tags"][tag_id] + "</li>");
	});
	
	// Detail
	elm.find(".pg_detail")
		.attr("href", gBaseUrl + "spot/show/" + info.id);
	// user data
	if (info.mydata) {
		elm.find(".pg_edit")
			.attr("href", gBaseUrl + "user/spot/form/" + info.id);
		elm.find(".pg_delete")
			.attr("href", gBaseUrl + "user/spot/delete/" + info.id);
	} else {
		elm.find(".pg_edit").remove();
		elm.find(".pg_delete").remove();
	}
	// append item
	elm.appendTo(class_name);
	
};

tourCtl.render = function(info, relation, class_name) {
	var elm = $(class_name+" .pg_temp")
		.clone(true)
		.show()
		.removeClass("pg_temp")
		.attr("data-tour-id", info.id);
	elm.css("display", "block");

	// icon
	elm.find(".icon img")
	.attr("src", gAssetUrl + "/img/common/icon/tour.png")
	.attr("alt", "ツアー");

	// name
	elm.find(".pg_name")
		.text(info.name);

	// description
	elm.find(".pg_description")
		.text(info.description);
	
	// facebook like button
	elm.find(".pg_like_count")
		.addClass("fb-like")
		.attr("data-href", gBaseUrl + 'user/tour/show/' + info.id);
	
	// image
	if (info.image) {
		$(info.routes).each(function(i, route) {
			if (route.id == info.image) {
				elm.find(".pg_img .pg_detail img")
					.attr("src", gBaseUrl + "uploads/spot/thumb/" + route.image.file_name)
					.attr("alt", route.name);
				return;
			}
		});
	}
	
	// category
	elm.find(".pg_category dd .category_icon").empty();
	var category_ids = [];
	if (info.category) {
		// ルートカテゴリのみ取得
		$(info.category.split(",")).each(function(i, category_path) {
			category_ids.push(category_path.match(/\d+/g)[0]);
		});
		$.each($.unique(category_ids), function(i, category_id) {
			var icon = "";
			var category_name = relation["categories"][category_id];
			if (category_name.indexOf("見る", 0) >= 0) {
				icon = "site.gif";
			} else if (category_name.indexOf("食べる", 0) >= 0) {
				icon = "food.gif";
			} else if (category_name.indexOf("遊ぶ", 0) >= 0) {
				icon = "enjoy.gif";
			} else if (category_name.indexOf("買う", 0) >= 0) {
				icon = "shopping.gif";
			} else if (category_name.indexOf("宿泊", 0) >= 0) {
				icon = "stay.gif";
			} else if (category_name.indexOf("乗り物", 0) >= 0) {
				icon = "transport.gif";
			}
			if (icon) {
				elm.find(".pg_category dd .category_icon").append('<li><a href="" title="'+category_name+'"><img src="' + gAssetUrl + '/img/common/icon/'+icon+'" alt="'+category_name+'" /></a></li>');
			}
		});
	}

	// tags
	elm.find(".pg_tags").empty();
	$(info.tags.match(/\d+/g)).each(function(i, tag_id) {
		elm.find(".pg_tags").append("<li>" + relation["tags"][tag_id] + "</li>");
	});
	
	// owner
	if (info.owner_name) {
		elm.find(".pg_owner")
			.text(info.owner_name);
	}
	
	// prefecture
	if (info.routes[0].prefecture) {
		elm.find(".pg_prefecture")
			.text(info.routes[0].prefecture);
	}
	
	// stay_time
	stay_time = 0;
	$(this.routes).each(function(i, route) {
		stay_time += parseInt(route.stay_time);
	});
	
	// 
	elm.find(".pg_stay_time")
		.text(stay_time + "分");
	
//		elm.find(".pg_routes").empty();

	// link
	elm.find(".pg_detail")
		.attr("href", gBaseUrl + "tour/show/" + info.id);

	elm.find(".pg_copy")
		.attr("href", gBaseUrl + 'user/tour/copy/' + info.id);

	if (info.mydata) {
		elm.find(".pg_edit")
			.attr("href", gBaseUrl + "user/tour/form/" + info.id);
		elm.find(".pg_delete")
			.attr("href", gBaseUrl + "user/tour/delete/" + info.id);
	} else {
		elm.find(".pg_edit").remove();
		elm.find(".pg_delete").remove();
	}
	
	elm.appendTo(class_name);
};


/**
 * get request query
 */
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

var FB = null;
var google = null;
$(function() {
	if (!FB) {
		return false;
	}
	// like
	FB.Event.subscribe('edge.create', function(response) {
		var url = $.url(response);
		var path_info = url.attr("path").split("/");
		var fb_auth = FB.getAuthResponse();
		$.ajax({
			url: gBaseUrl + "user/spot/like_plus",
			async: false,
			data: {
				user_id: fb_auth.userID,
				spot_id: path_info[path_info.length -1]
			},
			dataType: "json",
			type: "post",
			success: function(json) {
				console.log(json);
			},
			error: function() {
				console.log(arguments);
			}
		});
	});
	// not like
	FB.Event.subscribe('edge.remove', function(response) {
		var url = $.url(response);
		var path_info = url.attr("path").split("/");
		var fb_auth = FB.getAuthResponse();
		// ソート順用
		$.ajax({
			url: gBaseUrl + "user/spot/like_minus",
			async: false,
			data: {
				user_id: fb_auth.userID,
				spot_id: path_info[path_info.length -1]
			},
			dataType: "json",
			type: "post",
			success: function(json) {
				console.log(json);
			},
			error: function() {
				console.log(arguments);
			}
		});
	});
});

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=248010585308088";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



(function($) {
	//pluginNameは任意のプラグイン名に$(elm).pluginName()と使います。
	$.fn.simplePaginate = function(config) {
		var defaults = {
				count		: 10,
				current		: 3,
				side_page	: 2,
				onChange	: function(page) {
					alert(page);
					return false;
				}
		};
		var options = $.extend(defaults, config);
		
		options.count = parseInt(options.count);
		options.current = parseInt(options.current);
		options.side_page = parseInt(options.side_page);
		if (typeof(options.onChange) == 'function') {
			options.onChange = defaults.onChange;
		}
		console.log(options);

		return this.each(function() {
			$(this).empty();
			
			// first
			/*
			var first = $(document.createElement('p')).addClass('first');
			first.append($(document.createElement('a'))
					.attr('data-page', 1)
					.text('[1]'));
			$(this).append(first);
			*/

			// prev
			if (options.current > 1) {
				var prev = $(document.createElement('p')).addClass('prev');
				prev.append($(document.createElement('a'))
					.addClass("selectbtn")
					.attr('data-page', options.current - 1)
					.text('前へ'));
				$(this).append(prev);
			}

			// list
			var page_number = options.side_page * 2 + 1;
			var start = options.current - options.side_page;
			if (start < 1) start = 1;
			var ul = $(document.createElement('ul'));

			// first page
			var li = $(document.createElement('li'));
			li.append($(document.createElement('a'))
					.attr('data-page', 1)
					.text(" [ 1 ] "));
			$(ul).append(li);

			// list-prev
			for(i = 0; i < page_number; i++) {
				if (options.count >= start + i) {
					var li = $(document.createElement('li'));
					if (start + i == options.current) {
						li.addClass("select");
					} 
					li.append($(document.createElement('a'))
							.attr('data-page', start + i)
							.text(start + i));
					$(ul).append(li);
				}
			}
			$(this).append(ul);

			// last page
			var li = $(document.createElement('li'));
			li.append($(document.createElement('a'))
					.attr('data-page', options.count)
					.text(" [ "+options.count+" ] "));
			$(ul).append(li);
			
			// next
			var next = $(document.createElement('p')).addClass('next');
			if (options.current < options.count) {
				next.append($(document.createElement('a'))
						.addClass("selectbtn")
						.attr('data-page', options.current + 1)
						.text('次へ'));
			}
			$(this).append(next);

			/*
			// last
			var last = $(document.createElement('p')).addClass('next');
			last.append($(document.createElement('a'))
					.attr('data-page', options.count)
					.text('['+options.count+']'));
			$(this).append(last);
			*/
			
			$(this).find('a').click(function(e) {
				var page = $(this).attr('data-page');
				options.onChange(page);
			});

		});
	};
})(jQuery);
