<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/s/classes/config.inc.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/s/classes/db_helper.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/s/classes/time_manip.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/s/classes/user_helper.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/s/classes/video_helper.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/s/classes/page_builder.php"); ?>
<?php $__video_h = new video_helper($__db); ?>
<?php $__page_b = new page_builder("templates/m"); ?>
<?php $__user_h = new user_helper($__db); ?>
<?php $__db_h = new db_helper(); ?>
<?php $__time_h = new time_helper(); ?>
<?php if(!isset($_SESSION['siteusername'])) { header("Location: /sign_in"); } ?>
<?php ob_start(); ?>
<?php
	$__server->page_embeds->page_title = "SubRocks";
	$__server->page_embeds->page_description = "FulpTube is a website that is cool";
	$__server->page_embeds->page_url = "https://subrock.rocks/";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<script>
			var yt = yt || {};yt.timing = yt.timing || {};yt.timing.data_ = yt.timing.data_ || {};yt.timing.tick = function(label, opt_time) {var tick = yt.timing.data_['tick'] || {};tick[label] = opt_time || new Date().getTime();yt.timing.data_['tick'] = tick;};yt.timing.info = function(label, value) {var info = yt.timing.data_['info'] || {};info[label] = value;yt.timing.data_['info'] = info;};yt.timing.reset = function() {yt.timing.data_ = {};};if (document.webkitVisibilityState == 'prerender') {yt.timing.info('prerender', 1);document.addEventListener('webkitvisibilitychange', function() {yt.timing.tick('start');}, false);}yt.timing.tick('start');try {var externalPt = (window.gtbExternal && window.gtbExternal.pageT() ||window.external && window.external.pageT);if (externalPt) {yt.timing.info('pt', externalPt);}} catch(e) {}if (window.chrome && window.chrome.csi) {yt.timing.info('pt', Math.floor(window.chrome.csi().pageT));}    
		</script>
		<title><?php echo $__server->page_embeds->page_title; ?></title>
		<link rel="search" type="application/opensearchdescription+xml" href="http://www.youtube.com/opensearch?locale=en_US" title="YouTube Video Search">
		<link rel="shortcut icon" href="/yts/img/favicon-vfldLzJxy.ico" type="image/x-icon">
		<link rel="icon" href="//s.ytimg.com/yts/img/favicon_32-vflWoMFGx.png" sizes="32x32">
		<link rel="alternate" media="handheld" href="http://m.youtube.com/index?&amp;desktop_uri=%2F">
		<link rel="alternate" media="only screen and (max-width: 640px)" href="http://m.youtube.com/index?&amp;desktop_uri=%2F">
		<meta name="description" content="<?php echo $__server->page_embeds->page_description; ?>">
		<meta property="og:image" content="/yts/imgbin/www-embed.png">
		<link id="css-2955892050" rel="stylesheet" href="/yts/cssbin/www-core-vflEJosKh.css">
		<link id="css-151587203" rel="stylesheet" href="/yts/cssbin/www-home-vfl_Eri60.css">
		<script>
			if (window.yt.timing) {yt.timing.tick("ct");}    
		</script>
	</head>
	<body dir="ltr" class="  ltr      site-left-aligned  exp-new-site-width  exp-watch7-comment-ui  hitchhiker-enabled      guide-enabled    guide-expanded  ">
		<div id="body-container">
			<form name="logoutForm" method="POST" action="/logout"><input type="hidden" name="action_logout" value="1"></form>
			<?php require($_SERVER['DOCUMENT_ROOT'] . "/s/mod/2013_header.php"); ?>
			<div id="alerts"></div>
			<div id="header">
				<div id="masthead_child_div"></div>
				<div id="ad_creative_expand_btn_1" class="masthead-ad-control masthead-ad-control-lohp open hid">
				</div>
			</div>
			<div id="page-container">
				<div id="page" class="  home clearfix">
					<div id="guide">
					<?php require($_SERVER['DOCUMENT_ROOT'] . "/s/mod/2013_guideloggedin.php"); ?>
					<div id="content" class="">
								<div class="feed-container" data-filter-type="" data-view-type="">
									<div class="feed-page">
										<ul>
											<?php
												$stmt = $__db->prepare("SELECT * FROM videos WHERE visibility = 'n' ORDER BY id DESC LIMIT 20");
												$stmt->execute();
												while($video = $stmt->fetch(PDO::FETCH_ASSOC)) {	
													$video['age'] = $__time_h->time_elapsed_string($video['publish']);		
													$video['duration'] = $__time_h->timestamp($video['duration']);
													$video['views'] = $__video_h->fetch_video_views($video['rid']);
													$video['author'] = htmlspecialchars($video['author']);		
													$video['title'] = htmlspecialchars($video['title']);
													$video['description'] = $__video_h->shorten_description($video['description'], 50);
													$video['pfp'] = $__user_h->fetch_pfp($video['author']);

													echo $__page_b->return_template_replace("index_video_1.module", $video);
												} 
											?>
										</ul>
									</div>
								</div>
							</div>
							<div id="feed-error" class="individual-feed hid">
								<p class="feed-message">
									We were unable to complete the request, please try again later.
								</p>
							</div>
							<div id="feed-loading-template" class="hid">
								<div class="feed-message">
									<p class="loading-spinner">
										<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="">
										Loading...
									</p>
								</div>
							</div>
						</div>
						<div id="feed-background"></div>
						<div id="footer-ads">
							<div id="ad_creative_3" class="ad-div " style="z-index: 1">
								<iframe id="ad_creative_iframe_3" height="1" width="1" scrolling="no" frameborder="0" style="z-index: 1" src="//ad-g.doubleclick.net/N6762/adi/mkt.ythome_1x1/;sz=1x1;tile=3;plat=pc;dc_dedup=1;kcr=us;kga=-1;kgg=-1;klg=en;kmyd=ad_creative_3;kt=K;ord=7554901073022560?"></iframe>
								<script>
									(function() {
									  var addTimestamp = (Math.floor(Math.random() * 1000) == 0);
									  if (addTimestamp) {
									    var kts = new Date().getTime();
									    var iframeSrc = "//ad-g.doubleclick.net/N6762/adi/mkt.ythome_1x1/;sz=1x1;tile=3;plat=pc;dc_dedup=1;kcr=us;kga=-1;kgg=-1;klg=en;kmyd=ad_creative_3;kt=K;kts=" + kts + ";ord=7554901073022560?";
									  } else {
									    var iframeSrc = "//ad-g.doubleclick.net/N6762/adi/mkt.ythome_1x1/;sz=1x1;tile=3;plat=pc;dc_dedup=1;kcr=us;kga=-1;kgg=-1;klg=en;kmyd=ad_creative_3;kt=K;ord=7554901073022560?";
									  }
									  var adIframe = document.getElementById("ad_creative_iframe_3");
									  adIframe.src = iframeSrc;
									})();
								</script>
							</div>
							<div class="branded-page-v2-secondary-col">
        <div class="branded-page-v2-col-content-area">
              
  <div id="ad_creative_expand_btn_1" class="masthead-ad-control open hid">
    <a onclick="masthead.expand_ad(); return false;">
      <span>Show ad</span>
      <img src="./YouTube - Broadcast Yourself._files/pixel-vfl3z5WfW.gif" alt="">
    </a>
  </div>

          <div class="branded-page-module branded-page-related-channels" id="gh-recommended">
        <h2 dir="ltr">
            <a href="https://web.archive.org/channels/recommended_for_you">Recommended Channels</a>
        </h2>
      <ul class="branded-page-related-channels-list">
          <li class="branded-page-related-channels-item clearfix" data-external-id="UCqZQlzSHbVJrwrn5XvzrzcA">
            <a href="https://web.archive.org/user/2012NBCOlympics" class="spf-link yt-uix-sessionlink" data-sessionlink="ved=CAIQ9Rw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
                <span class="video-thumb ux-thumb yt-thumb-square-60 branded-page-related-channels-thumb"><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="//i2.ytimg.com/i/qZQlzSHbVJrwrn5XvzrzcA/1.jpg?v=4fbfb09f" alt="Thumbnail" data-thumb="//i2.ytimg.com/i/qZQlzSHbVJrwrn5XvzrzcA/1.jpg?v=4fbfb09f" width="60" data-group-key="thumb-group-0"><span class="vertical-align"></span></span></span></span>

            </a>
            <div class="branded-page-related-channels-content">
                <h3>
    <a class="spf-link yt-uix-tooltip yt-uix-sessionlink yt-uix-hovercard" data-card-action="yt.www.usercard.show" data-card-class="yt-user-card" href="https://web.archive.org/user/2012NBCOlympics" dir="ltr" data-sessionlink="ved=CAMQ9hw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
        <span class="yt-uix-hovercard-target" data-id="qZQlzSHbVJrwrn5XvzrzcA" data-orientation="vertical" data-position="topright" data-delay-show="500">
          2012NBCOlympics
        </span>
        <span class="yt-uix-hovercard-content"></span>
    </a>
  </h3>

              <span class="branded-page-related-channels-num-subscribers">
              </span>
              <span class="yt-uix-button-context-light yt-uix-button-subscription-container"><button href="https://accounts.google.com/ServiceLogin?uilel=3&amp;service=youtube&amp;passive=true&amp;continue=http%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26feature%3Dsubscribe%26nomobiletemp%3D1%26hl%3Den_US%26next%3D%252F%253Fcontinue_action%253D93du_yqQlCv2UuqQM9ftN9HekXfV2RwnddOPOso9BYIGCmZklEdTeK593s_3Ff64Ir_b8aPpCBxBoIlBoKI1jPJJsePocYhIhlmbZrq_ms66ZtRSpUc56w==&amp;hl=en_US&amp;ltmpl=sso" onclick=";window.location.href=this.getAttribute('href');return false;" title="" type="button" class="yt-subscription-button yt-subscription-button-js-default yt-uix-button yt-uix-button-subscribe-unbranded yt-uix-tooltip" data-subscription-button-type="unbranded" data-subscription-feature="" data-sessionlink="ved=CAQQ9xw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D" data-subscription-value="UCqZQlzSHbVJrwrn5XvzrzcA" data-subscription-type="channel" role="button" data-subscription-initialized="true"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-subscribe-unbranded" src="./YouTube - Broadcast Yourself._files/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span><span class="yt-uix-button-content">  <span class="subscribe-label">Subscribe</span>
  <span class="subscribed-label">Subscribed</span>
  <span class="unsubscribe-label">Unsubscribe</span>
 </span></button><span class="yt-subscription-button-disabled-mask"></span></span>
            </div>
          </li>
          <li class="branded-page-related-channels-item clearfix" data-external-id="UCKZaM_2r9KbLck5_q8gbyRQ">
            <a href="https://web.archive.org/user/gopconvention2012" class="spf-link yt-uix-sessionlink" data-sessionlink="ved=CAYQ9Rw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
                <span class="video-thumb ux-thumb yt-thumb-square-60 branded-page-related-channels-thumb"><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="//i4.ytimg.com/i/KZaM_2r9KbLck5_q8gbyRQ/1.jpg?v=d8c7da" alt="Thumbnail" data-thumb="//i4.ytimg.com/i/KZaM_2r9KbLck5_q8gbyRQ/1.jpg?v=d8c7da" width="60" data-group-key="thumb-group-0"><span class="vertical-align"></span></span></span></span>

            </a>
            <div class="branded-page-related-channels-content">
                <h3>
    <a class="spf-link yt-uix-tooltip yt-uix-sessionlink yt-uix-hovercard" data-card-action="yt.www.usercard.show" data-card-class="yt-user-card" href="https://web.archive.org/user/gopconvention2012" dir="ltr" data-sessionlink="ved=CAcQ9hw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
        <span class="yt-uix-hovercard-target" data-id="KZaM_2r9KbLck5_q8gbyRQ" data-orientation="vertical" data-position="topright" data-delay-show="500" data-card-timer="13">
          gopconvention2012
        </span>
        
    </a>
  </h3>

              <span class="branded-page-related-channels-num-subscribers">
              </span>
              <span class="yt-uix-button-context-light yt-uix-button-subscription-container"><button href="https://accounts.google.com/ServiceLogin?uilel=3&amp;service=youtube&amp;passive=true&amp;continue=http%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26feature%3Dsubscribe%26nomobiletemp%3D1%26hl%3Den_US%26next%3D%252F%253Fcontinue_action%253DMZe88q6VqWQFIAxpT1fkbYbqgEwwUj-vmnfjuVlLG_luDpPk-JxPQ7S6K_r4wiLYyhQbP0WB5ETSb1hLPxtvNZc4UXmIK9EFbNbf8MYK57nTWoJDKabuhQ==&amp;hl=en_US&amp;ltmpl=sso" onclick=";window.location.href=this.getAttribute('href');return false;" title="" type="button" class="yt-subscription-button yt-subscription-button-js-default yt-uix-button yt-uix-button-subscribe-unbranded yt-uix-tooltip" data-subscription-button-type="unbranded" data-subscription-feature="" data-sessionlink="ved=CAgQ9xw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D" data-subscription-value="UCKZaM_2r9KbLck5_q8gbyRQ" data-subscription-type="channel" role="button" data-subscription-initialized="true"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-subscribe-unbranded" src="./YouTube - Broadcast Yourself._files/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span><span class="yt-uix-button-content">  <span class="subscribe-label">Subscribe</span>
  <span class="subscribed-label">Subscribed</span>
  <span class="unsubscribe-label">Unsubscribe</span>
 </span></button><span class="yt-subscription-button-disabled-mask"></span></span>
            </div>
          </li>
          <li class="branded-page-related-channels-item clearfix" data-external-id="UCQsH5XtIc9hONE1BQjucM0g">
            <a href="https://web.archive.org/user/ligue1fr" class="spf-link yt-uix-sessionlink" data-sessionlink="ved=CAoQ9Rw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
                <span class="video-thumb ux-thumb yt-thumb-square-60 branded-page-related-channels-thumb"><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="//i2.ytimg.com/i/QsH5XtIc9hONE1BQjucM0g/1.jpg?v=5020f309" alt="Thumbnail" data-thumb="//i2.ytimg.com/i/QsH5XtIc9hONE1BQjucM0g/1.jpg?v=5020f309" width="60" data-group-key="thumb-group-0"><span class="vertical-align"></span></span></span></span>

            </a>
            <div class="branded-page-related-channels-content">
                <h3>
    <a class="spf-link yt-uix-tooltip yt-uix-sessionlink yt-uix-hovercard" data-card-action="yt.www.usercard.show" data-card-class="yt-user-card" href="https://web.archive.org/user/ligue1fr" dir="ltr" data-sessionlink="ved=CAsQ9hw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
        <span class="yt-uix-hovercard-target" data-id="QsH5XtIc9hONE1BQjucM0g" data-orientation="vertical" data-position="topright" data-delay-show="500">
          ligue1fr
        </span>
        <span class="yt-uix-hovercard-content"></span>
    </a>
  </h3>

              <span class="branded-page-related-channels-num-subscribers">
              </span>
              <span class="yt-uix-button-context-light yt-uix-button-subscription-container"><button href="https://accounts.google.com/ServiceLogin?uilel=3&amp;service=youtube&amp;passive=true&amp;continue=http%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26feature%3Dsubscribe%26nomobiletemp%3D1%26hl%3Den_US%26next%3D%252F%253Fcontinue_action%253D_o21fEQOjJcuNzclcaVHjmwwAzTaBV4o7Fzw4z5dfxwmaVW9P5u62fhYSCKjk88zR_oT61SKUroKDdBWxJ0aqWhFxY7Q0VbAU8bWb7wOdqenIcvOCKiH3g==&amp;hl=en_US&amp;ltmpl=sso" onclick=";window.location.href=this.getAttribute('href');return false;" title="" type="button" class="yt-subscription-button yt-subscription-button-js-default yt-uix-button yt-uix-button-subscribe-unbranded yt-uix-tooltip" data-subscription-button-type="unbranded" data-subscription-feature="" data-sessionlink="ved=CAwQ9xw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D" data-subscription-value="UCQsH5XtIc9hONE1BQjucM0g" data-subscription-type="channel" role="button" data-subscription-initialized="true"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-subscribe-unbranded" src="./YouTube - Broadcast Yourself._files/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span><span class="yt-uix-button-content">  <span class="subscribe-label">Subscribe</span>
  <span class="subscribed-label">Subscribed</span>
  <span class="unsubscribe-label">Unsubscribe</span>
 </span></button><span class="yt-subscription-button-disabled-mask"></span></span>
            </div>
          </li>
          <li class="branded-page-related-channels-item clearfix" data-external-id="UC5rBpVgv83gYPZ593XwQUsA">
            <a href="https://web.archive.org/user/drive" class="spf-link yt-uix-sessionlink" data-sessionlink="ved=CA4Q9Rw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
                <span class="video-thumb ux-thumb yt-thumb-square-60 branded-page-related-channels-thumb"><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="//i2.ytimg.com/i/5rBpVgv83gYPZ593XwQUsA/1.jpg?v=4ee4a33e" alt="Thumbnail" data-thumb="//i2.ytimg.com/i/5rBpVgv83gYPZ593XwQUsA/1.jpg?v=4ee4a33e" width="60" data-group-key="thumb-group-0"><span class="vertical-align"></span></span></span></span>

            </a>
            <div class="branded-page-related-channels-content">
                <h3>
    <a class="spf-link yt-uix-tooltip yt-uix-sessionlink yt-uix-hovercard" data-card-action="yt.www.usercard.show" data-card-class="yt-user-card" href="https://web.archive.org/user/drive" dir="ltr" data-sessionlink="ved=CA8Q9hw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
        <span class="yt-uix-hovercard-target" data-id="5rBpVgv83gYPZ593XwQUsA" data-orientation="vertical" data-position="topright" data-delay-show="500" data-card-timer="21">
          drive
        </span>
        
    </a>
  </h3>

              <span class="branded-page-related-channels-num-subscribers">
              </span>
              <span class="yt-uix-button-context-light yt-uix-button-subscription-container"><button href="https://accounts.google.com/ServiceLogin?uilel=3&amp;service=youtube&amp;passive=true&amp;continue=http%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26feature%3Dsubscribe%26nomobiletemp%3D1%26hl%3Den_US%26next%3D%252F%253Fcontinue_action%253DiLGu8_RGBEgLrDFPnwIWk811V17bHyXLFn1Km8LlarHjvHWpnuBLYNB0rKNzJ4t1sjyMRv0DWIy_VWrjBqyDQ2ZOZCktyOIqoUuPo1EYztBKHpsX_aazig==&amp;hl=en_US&amp;ltmpl=sso" onclick=";window.location.href=this.getAttribute('href');return false;" title="" type="button" class="yt-subscription-button yt-subscription-button-js-default yt-uix-button yt-uix-button-subscribe-unbranded yt-uix-tooltip" data-subscription-button-type="unbranded" data-subscription-feature="" data-sessionlink="ved=CBAQ9xw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D" data-subscription-value="UC5rBpVgv83gYPZ593XwQUsA" data-subscription-type="channel" role="button" data-subscription-initialized="true"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-subscribe-unbranded" src="./YouTube - Broadcast Yourself._files/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span><span class="yt-uix-button-content">  <span class="subscribe-label">Subscribe</span>
  <span class="subscribed-label">Subscribed</span>
  <span class="unsubscribe-label">Unsubscribe</span>
 </span></button><span class="yt-subscription-button-disabled-mask"></span></span>
            </div>
          </li>
          <li class="branded-page-related-channels-item clearfix" data-external-id="UCkzRDjtq4ngMADh45j2KsJQ">
            <a href="https://web.archive.org/user/MachinimaPrime" class="spf-link yt-uix-sessionlink" data-sessionlink="ved=CBIQ9Rw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
                <span class="video-thumb ux-thumb yt-thumb-square-60 branded-page-related-channels-thumb"><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="//i4.ytimg.com/i/kzRDjtq4ngMADh45j2KsJQ/1.jpg?v=4fe376a4" alt="Thumbnail" data-thumb="//i4.ytimg.com/i/kzRDjtq4ngMADh45j2KsJQ/1.jpg?v=4fe376a4" width="60" data-group-key="thumb-group-0"><span class="vertical-align"></span></span></span></span>

            </a>
            <div class="branded-page-related-channels-content">
                <h3>
    <a class="spf-link yt-uix-tooltip yt-uix-sessionlink yt-uix-hovercard" data-card-action="yt.www.usercard.show" data-card-class="yt-user-card" href="https://web.archive.org/user/MachinimaPrime" dir="ltr" data-sessionlink="ved=CBMQ9hw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D">
        <span class="yt-uix-hovercard-target" data-id="kzRDjtq4ngMADh45j2KsJQ" data-orientation="vertical" data-position="topright" data-delay-show="500">
          MachinimaPrime
        </span>
        <span class="yt-uix-hovercard-content"></span>
    </a>
  </h3>

              <span class="branded-page-related-channels-num-subscribers">
              </span>
              <span class="yt-uix-button-context-light yt-uix-button-subscription-container"><button href="https://accounts.google.com/ServiceLogin?uilel=3&amp;service=youtube&amp;passive=true&amp;continue=http%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26feature%3Dsubscribe%26nomobiletemp%3D1%26hl%3Den_US%26next%3D%252F%253Fcontinue_action%253D93guXFc9X3QdCYQHmCueKPy2miBnqIF2C6M7lZwZf57AaKaehYpEKfCIel63StMbHD7b-y5FR-ToUvRwhE5BdhQF7R5XOk01ctjHWkP6ZxNlTo3g1xRykg==&amp;hl=en_US&amp;ltmpl=sso" onclick=";window.location.href=this.getAttribute('href');return false;" title="" type="button" class="yt-subscription-button yt-subscription-button-js-default yt-uix-button yt-uix-button-subscribe-unbranded yt-uix-tooltip" data-subscription-button-type="unbranded" data-subscription-feature="" data-sessionlink="ved=CBQQ9xw%3D&amp;ei=CPqS_JntubICFZ8KIQodH1yKgw%3D%3D" data-subscription-value="UCkzRDjtq4ngMADh45j2KsJQ" data-subscription-type="channel" role="button" data-subscription-initialized="true"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-subscribe-unbranded" src="./YouTube - Broadcast Yourself._files/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span><span class="yt-uix-button-content">  <span class="subscribe-label">Subscribe</span>
  <span class="subscribed-label">Subscribed</span>
  <span class="unsubscribe-label">Unsubscribe</span>
 </span></button><span class="yt-subscription-button-disabled-mask"></span></span>
            </div>
          </li>
      </ul>
    </div>


        </div>
      </div>
						</div>
					</div>
				</div>
				
				<!-- end content -->
			</div>
			<div id="footer-container"><?php require($_SERVER['DOCUMENT_ROOT'] . "/s/mod/2013_footer.php"); ?></div>
			<div id="playlist-bar" class="hid passive editable" data-video-url="/watch?v=&amp;feature=BFql&amp;playnext=1&amp;list=QL" data-list-id="" data-list-type="QL">
				<div id="playlist-bar-bar-container">
					<div id="playlist-bar-bar">
						<div class="yt-alert yt-alert-naked yt-alert-success hid " id="playlist-bar-notifications">
							<div class="yt-alert-icon">
								<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" class="icon master-sprite" alt="Alert icon">
							</div>
							<div class="yt-alert-content" role="alert"></div>
						</div>
						<span id="playlist-bar-info"><span class="playlist-bar-active playlist-bar-group"><button onclick=";return false;" title="Previous video" type="button" id="playlist-bar-prev-button" class="yt-uix-tooltip yt-uix-tooltip-masked  yt-uix-button yt-uix-button-default yt-uix-tooltip yt-uix-button-empty" role="button"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-playlist-bar-prev" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Previous video"><span class="yt-valign-trick"></span></span></button><span class="playlist-bar-count"><span class="playing-index">0</span> / <span class="item-count">0</span></span><button type="button" class="yt-uix-tooltip yt-uix-tooltip-masked  yt-uix-button yt-uix-button-default yt-uix-button-empty" onclick=";return false;" id="playlist-bar-next-button" role="button"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-playlist-bar-next" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span></button></span><span class="playlist-bar-active playlist-bar-group"><button type="button" class="yt-uix-tooltip yt-uix-tooltip-masked  yt-uix-button yt-uix-button-default yt-uix-button-empty" onclick=";return false;" id="playlist-bar-autoplay-button" data-button-toggle="true" role="button"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-playlist-bar-autoplay" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span></button><button type="button" class="yt-uix-tooltip yt-uix-tooltip-masked  yt-uix-button yt-uix-button-default yt-uix-button-empty" onclick=";return false;" id="playlist-bar-shuffle-button" data-button-toggle="true" role="button"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-playlist-bar-shuffle" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span></button></span><span class="playlist-bar-passive playlist-bar-group"><button onclick=";return false;" title="Play videos" type="button" id="playlist-bar-play-button" class="yt-uix-tooltip yt-uix-tooltip-masked  yt-uix-button yt-uix-button-default yt-uix-tooltip yt-uix-button-empty" role="button"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-playlist-bar-play" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Play videos"><span class="yt-valign-trick"></span></span></button><span class="playlist-bar-count"><span class="item-count">0</span></span></span><span id="playlist-bar-title" class="yt-uix-button-group"><span class="playlist-title">Unsaved Playlist</span></span></span>
						<a id="playlist-bar-lists-back" href="#">
						Return to active list
						</a>
						<span id="playlist-bar-controls"><span class="playlist-bar-group"><button type="button" class="yt-uix-tooltip yt-uix-tooltip-masked  yt-uix-button yt-uix-button-text yt-uix-button-empty" onclick=";return false;" id="playlist-bar-toggle-button" role="button"><span class="yt-uix-button-icon-wrapper"><img class="yt-uix-button-icon yt-uix-button-icon-playlist-bar-toggle" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt=""><span class="yt-valign-trick"></span></span></button></span><span class="playlist-bar-group"><button type="button" class="yt-uix-tooltip yt-uix-tooltip-masked yt-uix-button-reverse flip yt-uix-button yt-uix-button-text" onclick=";return false;" data-button-menu-id="playlist-bar-options-menu" data-button-has-sibling-menu="true" role="button"><span class="yt-uix-button-content">Options </span><img class="yt-uix-button-arrow" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt=""></button></span></span>      
					</div>
				</div>
				<div id="playlist-bar-tray-container">
					<div id="playlist-bar-tray" class="yt-uix-slider yt-uix-slider-fluid">
						<button class="yt-uix-button playlist-bar-tray-button yt-uix-button-default yt-uix-slider-prev" onclick="return false;"><img class="yt-uix-slider-prev-arrow" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Previous video"></button><button class="yt-uix-button playlist-bar-tray-button yt-uix-button-default yt-uix-slider-next" onclick="return false;"><img class="yt-uix-slider-next-arrow" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Next video"></button>
						<div class="yt-uix-slider-body">
							<div id="playlist-bar-tray-content" class="yt-uix-slider-slide">
								<ol class="video-list"></ol>
								<ol id="playlist-bar-help">
									<li class="empty playlist-bar-help-message">Your queue is empty. Add videos to your queue using this button: <img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" class="addto-button-help"><br> or <a href="/sign_in">sign in</a> to load a different list.</li>
								</ol>
							</div>
							<div class="yt-uix-slider-shade-left"></div>
							<div class="yt-uix-slider-shade-right"></div>
						</div>
					</div>
					<div id="playlist-bar-save"></div>
					<div id="playlist-bar-lists" class="dark-lolz"></div>
					<div id="playlist-bar-loading"><img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Loading..."><span id="playlist-bar-loading-message">Loading...</span><span id="playlist-bar-saving-message" class="hid">Saving...</span></div>
					<div id="playlist-bar-template" style="display: none;" data-video-thumb-url="//i4.ytimg.com/vi/__video_encrypted_id__/default.jpg">
						<!--<li class="playlist-bar-item yt-uix-slider-slide-unit __classes__" data-video-id="__video_encrypted_id__"><a href="__video_url__" title="__video_title__" class="yt-uix-sessionlink" data-sessionlink="ei=CNLr3rbS3rICFSwSIQodSW397Q%3D%3D&amp;feature=BFa"><span class="video-thumb ux-thumb yt-thumb-default-106 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="http://s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="__video_title__" data-thumb-manual="true" data-thumb="__video_thumb_url__" width="106" ><span class="vertical-align"></span></span></span></span><span class="screen"></span><span class="count"><strong>__list_position__</strong></span><span class="play"><img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif"></span><span class="yt-uix-button yt-uix-button-default delete"><img class="yt-uix-button-icon-playlist-bar-delete" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Delete"></span><span class="now-playing">Now playing</span><span dir="ltr" class="title"><span>__video_title__  <span class="uploader">by __video_display_name__</span>
							</span></span><span class="dragger"></span></a></li>-->
					</div>
					<div id="playlist-bar-next-up-template" style="display: none;">
						<!--<div class="playlist-bar-next-thumb"><span class="video-thumb ux-thumb yt-thumb-default-74 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="//i4.ytimg.com/vi/__video_encrypted_id__/default.jpg" alt="Thumbnail" onerror="this.onerror=null;this.src='/dynamic/thumbs/default.jpg';" width="74" ><span class="vertical-align"></span></span></span></span></div>-->
					</div>
				</div>
				<div id="playlist-bar-options-menu" class="hid">
					<div id="playlist-bar-extras-menu">
						<ul>
							<li><span class="yt-uix-button-menu-item" data-action="clear">
								Clear all videos from this list
								</span>
							</li>
						</ul>
					</div>
					<ul>
						<li><span class="yt-uix-button-menu-item" onclick="window.location.href='//support.google.com/youtube/bin/answer.py?answer=146749&amp;hl=en-US'">Learn more</span></li>
					</ul>
				</div>
			</div>
			<div id="shared-addto-watch-later-login" class="hid">
				<a href="/sign_in" class="sign-in-link">Sign in</a> to add this to a playlist
			</div>
			<div id="shared-addto-menu" style="display: none;" class="hid sign-in">
				<div class="addto-menu">
					<div id="addto-list-panel" class="menu-panel active-panel">
						<span class="yt-uix-button-menu-item yt-uix-tooltip sign-in" data-possible-tooltip="" data-tooltip-show-delay="750"><a href="/sign_in" class="sign-in-link">Sign in</a> to add this to a playlist
						</span>
					</div>
					<div id="addto-list-saved-panel" class="menu-panel">
						<div class="panel-content">
							<div class="yt-alert yt-alert-naked yt-alert-success  ">
								<div class="yt-alert-icon">
									<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" class="icon master-sprite" alt="Alert icon">
								</div>
								<div class="yt-alert-content" role="alert">
									<span class="yt-alert-vertical-trick"></span>
									<div class="yt-alert-message">
										<span class="message">Added to <span class="addto-title yt-uix-tooltip yt-uix-tooltip-reverse" title="More information about this playlist" data-tooltip-show-delay="750"></span></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="addto-list-error-panel" class="menu-panel">
						<div class="panel-content">
							<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif">
							<span class="error-details"></span>
							<a class="show-menu-link">Back to list</a>
						</div>
					</div>
					<div id="addto-note-input-panel" class="menu-panel">
						<div class="panel-content">
							<div class="yt-alert yt-alert-naked yt-alert-success  ">
								<div class="yt-alert-icon">
									<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" class="icon master-sprite" alt="Alert icon">
								</div>
								<div class="yt-alert-content" role="alert">
									<span class="yt-alert-vertical-trick"></span>
									<div class="yt-alert-message">
										<span class="message">Added to playlist:</span>
										<span class="addto-title yt-uix-tooltip" title="More information about this playlist" data-tooltip-show-delay="750"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="yt-uix-char-counter" data-char-limit="150">
							<div class="addto-note-box addto-text-box"><textarea id="addto-note" class="addto-note yt-uix-char-counter-input" maxlength="150"></textarea><label for="addto-note" class="addto-note-label">Add an optional note</label></div>
							<span class="yt-uix-char-counter-remaining">150</span>
						</div>
						<button disabled="disabled" type="button" class="playlist-save-note yt-uix-button yt-uix-button-default" onclick=";return false;" role="button"><span class="yt-uix-button-content">Add note </span></button>
					</div>
					<div id="addto-note-saving-panel" class="menu-panel">
						<div class="panel-content loading-content">
							<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif">
							<span>Saving note...</span>
						</div>
					</div>
					<div id="addto-note-saved-panel" class="menu-panel">
						<div class="panel-content">
							<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif">
							<span class="message">Note added to:</span>
						</div>
					</div>
					<div id="addto-note-error-panel" class="menu-panel">
						<div class="panel-content">
							<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif">
							<span class="message">Error adding note:</span>
							<ul class="error-details"></ul>
							<a class="add-note-link">Click to add a new note</a>
						</div>
					</div>
					<div class="close-note hid">
						<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" class="close-button">
					</div>
				</div>
			</div>
		</div>
		<!-- end page -->
<script id="www-core-js" src="/yt/jsbin/www-core-vfl1pq97W.js" data-loaded="true"></script>
		<script id="www-core-js" src="//s.ytimg.com/yt/jsbin/www-core-vfl1pq97W.js" data-loaded="true"></script>