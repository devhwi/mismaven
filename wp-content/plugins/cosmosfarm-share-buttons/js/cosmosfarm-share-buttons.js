function cosmosfarm_share_is_mobile(){
	var mobile = new Array('iPhone', 'iPad', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Opera Mini', 'IEMobile');
	for(var word in mobile){
		if(navigator.userAgent.match(mobile[word]) != null) return true;
	}
	return false;
}
function cosmosfarm_share_naver(url, text){
	var w = 720;
	var h = 720;
	var popup = window.open("http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(url)+"&title="+encodeURIComponent(text), 'cosmosfarm_share', 'width='+w+',height='+h+',left='+(screen.availWidth-w)*0.5+',top='+(screen.availHeight-h)*0.5);
	return false;
}
function cosmosfarm_share_facebook(url){
	var w = 720;
	var h = 350;
	jQuery.post('https://graph.facebook.com', {id:encodeURI(url),scrape:true});
	window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(url), 'cosmosfarm_share', 'width='+w+',height='+h+',left='+(screen.availWidth-w)*0.5+',top='+(screen.availHeight-h)*0.5);
	return false;
}
function cosmosfarm_share_twitter(url, text){
	var w = 720;
	var h = 350;
	window.open('https://twitter.com/intent/tweet?text='+encodeURIComponent(text)+'&url='+encodeURIComponent(url), 'cosmosfarm_share', 'width='+w+',height='+h+',left='+(screen.availWidth-w)*0.5+',top='+(screen.availHeight-h)*0.5);
	return false;
}
function cosmosfarm_share_band(url, text){
	var w = 410;
	var h = 540;
	window.open('http://www.band.us/plugin/share?body='+encodeURIComponent(text)+'&route='+encodeURIComponent(url), 'cosmosfarm_share', 'width='+w+',height='+h+',left='+(screen.availWidth-w)*0.5+',top='+(screen.availHeight-h)*0.5);
	return false;
}
function cosmosfarm_share_kakaostory(url, text){
	Kakao.Story.share({
		url: encodeURI(url),
		text: text
	});
	return false;
}
function cosmosfarm_share_kakaotalk(url, text){
	if(cosmosfarm_share_is_mobile()){
		Kakao.Link.sendTalkLink({
			label: text,
			webLink:{
				text: '전체보기',
				url: encodeURI(url)
			}
		});
	}
	else{
		alert('카카오톡이 설치된 모바일에서만 가능합니다 :D');
	}
	return false;
}
function cosmosfarm_share_google(url){
	var w = 600;
	var h = 600;
	window.open('https://plus.google.com/share?url='+encodeURIComponent(url), 'cosmosfarm_share', 'width='+w+',height='+h+',left='+(screen.availWidth-w)*0.5+',top='+(screen.availHeight-h)*0.5);
	return false;
}
function cosmosfarm_share(sns, url, title){
	switch(sns){
		case 'naver': cosmosfarm_share_naver(url, title); break;
		case 'facebook': cosmosfarm_share_facebook(url); break;
		case 'twitter': cosmosfarm_share_twitter(url, title); break;
		case 'band': cosmosfarm_share_band(url, title); break;
		case 'kakaostory': cosmosfarm_share_kakaostory(url, title); break;
		case 'kakaotalk': cosmosfarm_share_kakaotalk(url, title); break;
		case 'google': cosmosfarm_share_google(url); break;
	}
	return false;
}