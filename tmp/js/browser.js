var browser=function(){
	this.width;
	this.height;
}

$(document).ready(function(){
	browser.sizeChk();
});


browser.sizeChk=function(){
	browser.width=$(window).width();
	browser.height=$(window).height();
}

browser.IEChk=function(){
	var ver=0;
	var userAgent = window.navigator.userAgent.toLowerCase();
	var appVersion = window.navigator.appVersion.toLowerCase();	
	if (userAgent.indexOf("msie") != -1) {
		if (appVersion.indexOf("msie 6.") != -1) {
			ver=6;
		}else if (appVersion.indexOf("msie 7.") != -1) {
			ver=7;
		}else if (appVersion.indexOf("msie 8.") != -1) {
			ver=8;
		}else{
			ver=9; //othercase is regarded as IE9
		}
		
	}else{
		ver =9999;
	}
	return ver;
}
browser.touchOSchk=function(){
	var chk=false;
	var agent = navigator.userAgent;
	if(agent.indexOf('Android') != -1 || agent.indexOf('iPhone;') != -1 || agent.indexOf('iPad;') != -1){
		chk=true;
	}
	return chk;
}
browser.iPhoneChk=function(){
	var chk=false;
	var agent = navigator.userAgent;
	if(agent.indexOf('iPhone;') != -1){
		chk=true;
	}
	return chk;
}
