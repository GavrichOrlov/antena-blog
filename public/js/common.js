if (!jQuery) { throw new Error("Common requires jQuery") }

var ajax_post_flag = false;
//AJAXé€ä¿¡ãƒ¡ã‚½ãƒƒãƒ‰
function ajax_post(e, form, url){ "use strict";
	if(ajax_post_flag) return false;
	ajax_post_flag = true;
	var result = false;
	var jqxhr = $.ajax({
		async: false,
		type: 'POST',
		url: url,
		data: $(form).find('input,select,checkbox,textarea,checkbox,hidden').serializeArray(),		//formå†…ã®å…¥åŠ›é …ç›®ã‚’ã‚·ãƒªã‚¢ãƒ©ã‚¤ã‚º â€»é€ä¿¡é …ç›®ãŒå«ã¾ã‚Œã¦ã„ã‚‹è¦ç´ ã§ã‚ã‚Œã°å¿…ãšã—ã‚‚formã‚¿ã‚°ã§ãªãã¦ã‚‚ã‚ˆã„
		cache: false,
		timeout: 20000,		//ã‚¿ã‚¤ãƒ ã‚¢ã‚¦ãƒˆï¼ˆmsï¼‰
		beforeSend: function(XMLHttpRequest)
		{ "use strict";
			return true;
		},
		success: function(data, textStatus, XMLHttpRequest)
		{ "use strict";
			result = data;
		},
		error: function(XMLHttpRequest, textStatus, errorThrown)
		{ "use strict";
			result = JSON.parse(XMLHttpRequest.responseText);
		},
		complete: function(XMLHttpRequest, textStatus)
		{ "use strict";
			ajax_post_flag = false;
		}
	});
	//çµæžœã‚’è¿”ã™
	return result;
}

//AJAXé€ä¿¡ãƒ¡ã‚½ãƒƒãƒ‰
function ajax_post_json(json, url){ "use strict";
	if(ajax_post_flag) return false;
	ajax_post_flag = true;
	var result = false;
	var jqxhr = $.ajax({
		async: true,
		type: 'POST',
		url: url,
		data: json,
		cache: false,
		timeout: 20000,		//ã‚¿ã‚¤ãƒ ã‚¢ã‚¦ãƒˆï¼ˆmsï¼‰
		beforeSend: function(XMLHttpRequest)
		{ "use strict";
			return true;
		},
		success: function(data, textStatus, XMLHttpRequest)
		{ "use strict";
			result = data;
		},
		error: function(XMLHttpRequest, textStatus, errorThrown)
		{ "use strict";
			result = JSON.parse(XMLHttpRequest.responseText);
		},
		complete: function(XMLHttpRequest, textStatus)
		{ "use strict";
			ajax_post_flag = false;
		}
	});
	//çµæžœã‚’è¿”ã™
	return result;
}

//ãƒ•ã‚£ãƒ¼ãƒ‰ã‚¯ãƒªãƒƒã‚¯å‡¦ç†
var feed_click_count = 0;
function feed_click(link){
	link.href = link.href.replace("/feed/", "/feed-click/");
	++feed_click_count;
	if(mainTracker) ga('mainTracker.send', 'event', 'link', 'click', 'a.feed-click', feed_click_count);
	if(userTracker) ga('userTracker.send', 'event', 'link', 'click', 'a.feed-click', feed_click_count);
	return true;
}

//ãƒ–ãƒ­ã‚°ã‚¯ãƒªãƒƒã‚¯å‡¦ç†
var blog_click_count = 0;
function blog_click(link){
	link.href = link.href.replace("/blog/", "/blog-click/");
	++blog_click_count;
	if(mainTracker) ga('mainTracker.send', 'event', 'link', 'click', 'a.blog-click', blog_click_count);
	if(userTracker) ga('userTracker.send', 'event', 'link', 'click', 'a.blog-click', blog_click_count);
	return true;
}

//ãƒ–ãƒ­ã‚°ã‚«ã‚¦ãƒ³ãƒˆå‡¦ç†
function blog_count(link){
	var blog_id = link.getAttribute("blog_id");
	var result = ajax_post_json({'blog_count' : {'blog_id' : blog_id}}, '/api/antenna/blog_count.json');
	++blog_click_count;
	if(mainTracker) ga('mainTracker.send', 'event', 'link', 'click', 'a.blog-click', blog_click_count);
	if(userTracker) ga('userTracker.send', 'event', 'link', 'click', 'a.blog-click', blog_click_count);
	return true;
}

//ã‚¢ãƒ—ãƒªãƒ€ã‚¦ãƒ³ãƒ­ãƒ¼ãƒ‰å‡¦ç†
var app_download_count = 0;
function app_download(label){
	++app_download_count;
	if(mainTracker) ga('mainTracker.send', 'event', 'app', 'download', label, app_download_count);
	if(userTracker) ga('userTracker.send', 'event', 'app', 'download', label, app_download_count);
	return true;
}

$(document).ready(function() { "use strict";
	//ç„¡åŠ¹ãƒªãƒ³ã‚¯ã‚’åå¿œã•ã›ãªã„ã‚ˆã†ã«ã™ã‚‹å‡¦ç†ã‚’è¿½åŠ 
	$('.disabled a').click(function(){ return false; });

	var userAgent = window.navigator.userAgent.toLowerCase();	//ãƒ¦ãƒ¼ã‚¶ãƒ¼ã‚¨ãƒ¼ã‚¸ã‚§ãƒ³ãƒˆ
	var appVersion = window.navigator.appVersion.toLowerCase();	//ãƒ–ãƒ©ã‚¦ã‚¶ãƒãƒ¼ã‚¸ãƒ§ãƒ³
	//IEä»¥å¤–ã‹ã€IE8ä»¥å¤–ã®æ™‚ï¼ˆâ€»IE8ã¯ãƒ†ãƒ¼ãƒ–ãƒ«ã‚½ãƒ¼ãƒˆã®åˆæœŸåŒ–å‡¦ç†ãŒç•°å¸¸ã«é…ã„ã®ã§éžå¯¾å¿œã¨ã™ã‚‹ï¼‰
	if (userAgent.indexOf('msie') === -1 || appVersion.indexOf("msie 8.") === -1) {
		//ãƒ†ãƒ¼ãƒ–ãƒ«ã‚½ãƒ¼ãƒˆåˆ¶å¾¡å‡¦ç†å¯¾è±¡
		var targetTablesorter = $("table.tablesorter");
		if(targetTablesorter.size() > 0){
			//ãƒ†ãƒ¼ãƒ–ãƒ«ã‚½ãƒ¼ãƒˆåˆ¶å¾¡å‡¦ç†
			targetTablesorter.tablesorter({
				sortMultiSortKey: 'ctrlKey'
			});
		}
	}

	//http://bootsnipp.com/renswijnmalen/snippets/xngm
	$('div.product-chooser').not('.disabled').find('div.product-chooser-item').on('click', function(){
		$(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
		$(this).addClass('selected');
		$(this).find('input[type="radio"]').prop("checked", true);
	});
	$('div.product-chooser').not('.disabled').find('div.product-chooser-item').find('input[type="radio"]:checked').parent().parent().addClass('selected');

	//åˆ©ç”¨è¦ç´„ã«åŒæ„ã™ã‚‹ã«é–¢ã™ã‚‹ãƒœã‚¿ãƒ³åˆ¶å¾¡
	function changeAgreement()
	{
		//åŒæ„ãƒã‚§ãƒƒã‚¯ã§æ–‡å­—åˆ—ã®'0'ä»¥å¤–ã®æœ‰åŠ¹å€¤ãŒé¸æŠžã•ã‚Œã¦ã„ã¦ã‚‹æ™‚
		if ($('.chk-agreement:checked').val() !== '0' && $('.chk-agreement:checked').val())
		{
			//åŒæ„ãƒœã‚¿ãƒ³ã‚’æŠ¼ã›ã‚‹ã‚ˆã†ã«ã™ã‚‹
			$('.btn-agreement').removeAttr('disabled');
		}
		//ãã‚Œä»¥å¤–ã®æ™‚
		else
		{
			//åŒæ„ãƒœã‚¿ãƒ³ã‚’æŠ¼ã›ãªãã™ã‚‹
			$('.btn-agreement').attr('disabled', 'disabled');
		}
	}
	//åŒæ„ãƒã‚§ãƒƒã‚¯ã‚’ã‚¯ãƒªãƒƒã‚¯æ™‚ã«ãƒœã‚¿ãƒ³åˆ¶å¾¡ã‚’å‘¼ã³å‡ºã™
	$('.chk-agreement').click(function(){ changeAgreement(); });
	//åŒæ„ãƒœã‚¿ãƒ³ã®åˆæœŸåˆ¶å¾¡
	changeAgreement();
});

function set_nofollow(){
	//åºƒå‘Šãƒªãƒ³ã‚¯ã‚’nofollowã«å¤‰æ›´ã™ã‚‹
	$('.bnr-box a').attr('rel', 'nofollow');
}

$(window).load(function () {
	set_nofollow();
	setTimeout('set_nofollow();', 5000);
});