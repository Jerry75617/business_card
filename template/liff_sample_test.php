<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,viewport-fit=cover,user-scalable=no" name="viewport">
<title>分享 LINE 數位版名片</title>
<meta content="請開啟本連結並按一下「分享好友」來分享給好友或群組。" name="description">
<meta content="2133031763635285" property="fb:app_id">
<meta content="請開啟本連結並按一下「分享好友」來分享給好友或群組。" property="og:description">
<meta content="zh_TW" property="og:locale">
<meta content="筆記國度" property="og:site_name">
<meta content="分享 LINE 數位版名片" property="og:title">
<meta content="website" property="og:type">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/font-awesome@4/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;700&display=swap" rel="stylesheet">
<style>[v-cloak]{display:none}.h1,.h2,.h3,.h4,.h5,.h6,body,h1,h2,h3,h4,h5,h6{font-family:"Noto Sans TC",sans-serif}</style>
<meta content="630" property="og:image:height">
<meta content="1200" property="og:image:width">
<meta content="https://i.imgur.com/1KZoSue.png" property="og:image">
<meta content="https://liff.line.me/1654437282-A1Bj7p4a/share.html" property="og:url">
<link href="https://cdn.jsdelivr.net/gh/PamornT/flex2html@main/css/flex2html.css" rel="stylesheet">
<style>[v-cloak]{display:none}</style>
</head>
<body>
<script src="https://www.googletagmanager.com/gtag/js?id=UA-39556213-12" async></script>
<script>
	function gtag()
	{
		window.dataLayer.push(arguments)
	}
	window.dataLayer=window.dataLayer||[],window.GA_MEASUREMENT_ID="UA-39556213-12",gtag("js",new Date),gtag("config","UA-39556213-3"),window.gtagInit=e=>{const n={app_name:"LINE 數位版名片網站",groups:"liff",send_page_view:!1,transport_type:"beacon"};
	window.liff&&(n.app_name=`LIFF ${liff.getOS()} `+liff.getVersion(),/^U[0-9a-f]{32}$/.test(e)&&(n.user_id=e),liff.isInClient()&&(n.app_version=liff.getLineVersion())),gtag("config",window.GA_MEASUREMENT_ID,n)},window.gtagEvent=(n,a,t,i=1)=>new Promise(e=>{gtag("event",a,{event_callback:e,event_category:n,event_label:t,send_to:"liff",value:i})}),window.gtagScreenView=n=>new Promise(e=>{gtag("event","screen_view",{event_callback:e,screen_name:n,send_to:"liff"})}),window.gtagError=(n,a=!1)=>new Promise(e=>{gtag("event","exception",{description:n.message||"",event_callback:e,fatal:a,send_to:"liff"})}),window.gtagTiming=async n=>{if(window.performance){const a=Math.round(performance.now());
	await new Promise(e=>{gtag("event","timing_complete",{event_callback:e,event_category:location.pathname,name:n,send_to:"liff",value:a})})}};
</script>
<div class="container my-4 text-monospace" id="app" v-cloak v-show="!loading">
<h3 class="my-3 text-center">{{ $t('title') }}</h3>

<div class="my-3 form-group"><button class="btn btn-block align-items-center d-flex justify-content-center btn-lg btn-success" type="button" @click="btnShare" :disabled="!msgs"><i class="fa mr-2 fa-share-square-o"></i> {{ $t('share.btn') }}</button>
<small class="form-text mt-2 text-muted">{{ $t('share.help') }}</small>
</div>

<div class="my-3 form-group">
<button class="btn btn-block align-items-center d-flex justify-content-center btn-lg btn-info" type="button" @click="btnSend" :disabled="!msgs"><i class="fa mr-2 fa-paper-plane-o"></i> {{ $t('send.btn') }}</button>
<small class="form-text mt-2 text-muted">{{ $t('send.help') }}</small>
</div>

<div class="my-3 form-group">
<div class="btn-group btn-group-lg w-100">
<button class="btn btn-block align-items-center d-flex justify-content-center btn-outline-secondary" type="button" @click="btnCopy(linkLiffV2)"><i class="fa mr-2 fa-clipboard"></i> {{ $t('copy.btn') }}</button>
<button class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"></button>
<div class="dropdown-menu dropdown-menu-right">
<button class="dropdown-item" type="button" @click="btnCopy(linkLiffV1)">{{ $t('copy.btn') }} (LIFF v1)</button>
<button class="dropdown-item" type="button" @click="btnCopy(linkLihi)">{{ $t('copy.btn') }} (lihi1.com)</button></div>
</div>

<small class="form-text mt-2 text-muted">{{ $t('copy.help') }}</small></div>
<div class="my-3 dropdown">
<button class="btn btn-block btn-lg btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">{{ $t('dropdown.btn') }}</button>
<div class="dropdown-menu"><a class="dropdown-item" href="https://line.me/R/nv/QRCodeReader" target="_blank"><i class="fa fa-fw fa-qrcode"></i> {{ $t('dropdown.qrcodeReader') }}</a>
<a class="dropdown-item" href="https://line.me/R/nv/addFriends" target="_blank"><i class="fa fa-fw fa-users"></i> {{ $t('dropdown.addFriends') }}</a>
<a class="dropdown-item" href="https://line.me/R/nv/keep" target="_blank"><i class="fa fa-fw fa-bookmark"></i> {{ $t('dropdown.keep') }}</a>
<a class="dropdown-item" href="https://taichunmin.idv.tw/liff-businesscard/?openExternalBrowser=1" target="_blank"><i class="fa fa-fw fa-address-card"></i> {{ $t('dropdown.create') }}</a>
<a class="dropdown-item" href="https://lihi1.com/CVjIx/liffshare" target="_blank"><i class="fa fa-fw fa-comments"></i> {{ $t('dropdown.discuss') }}</a>
<button class="dropdown-item" type="button" @click="btnFriendMissing"><i class="fa fa-fw fa-question-circle"></i> {{ $t('dropdown.friendMissing') }}</button>
</div>
</div>
<div class="table-responsive" style="background-color:#849ebf">
<div class="chatbox pt-3"><div id="flex2html" ref="flex2html"></div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/crypto-js@3/crypto-js.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js" crossorigin="anonymous"></script>
<script src="https://cd7n.jsdelivr.net/npm/jquery@3/dist/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/js-base64@3/base64.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/json5@2/dist/index.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4/lodash.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/pako@2/dist/pako.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/papaparse@5/papaparse.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/qs@6/dist/qs.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-i18n@8/dist/vue-i18n.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://taichunmin.idv.tw/liff-businesscard/js/common.js?cachebust=1664911561621"></script>
<script src="https://static.line-scdn.net/liff/edge/2/sdk.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/PamornT/flex2html@main/js/flex2html.min.js" crossorigin="anonymous"></script>
<script>
	const loginPromise=(async()=>{await liff.init({liffId:"1654437282-A1Bj7p4a"}),window.getSearchParam("liff.state")&&await new Promise(t=>{}),liff.isLoggedIn()||(liff.login({redirectUri:location.href}),await new Promise(t=>{}));
	let t={};
	try
	{	
		t=await liff.getProfile()
	}
	catch(t){
		window.logError({err:t})
	}
	return window.gtagInit(t.userId),t})();
	
	window.vueConfig={el:"#app",data:{linkLiffV1:null,linkLiffV2:null,linkLihi:null,loading:!0,msgs:null,render:null,vcard:null},async mounted(){try{this.showLoading(this.$t("wait"),this.$t("init.loading")),await loginPromise,window.gtagScreenView("瀏覽分享名片網頁"),window.gtagTiming("after loginPromise"),this.linkLiffV2=liff.permanentLink.createUrl(),this.setOtherLinksByLiffV2(this.linkLiffV2),await Promise.all([this.getTpl(),this.getVcard()]),console.log("vcard",this.vcard),this.msgs=this.getRenderedMsgs(),console.log("msgs",this.msgs);
	
	for(const t of this.msgs)window.flex2html("flex2html",t);
	
	this.hideLoading(),window.gtagTiming("after mounted"),await this.showSavedAlert()}catch(t){window.logError({err:t,fatal:!0}),await this.swalFire({icon:"error",title:this.$t("init.fail"),text:t.message})}liff.isInClient()&&liff.isApiAvailable("shareTargetPicker")&&await this.btnShare(!0),this.loading=!1},computed:{locale:{get(){return this.$i18n.locale},set(t){this.$i18n.locale=t}}},methods:{async getTpl(){try{var t=this.paramBase64url("template");
	if(!t)throw new Error("template is required.");
	const e=_.template(_.get(await axios.get(t,{params:{cachebust:Date.now()},transformResponse:[]}),"data"));
	if(!_.isFunction(e))throw new Error("");
	const i=this.isInOpenChat()?this.linkLiffV1:this.linkLiffV2;
	this.render=t=>e({_:_,dayjs:dayjs,Qs:Qs,liffLink:i,...t}),window.gtagTiming("after getTpl")}catch(t){throw t.message=""+this.$t("init.getTplFail")+(t.message?": "+t.message:""),this.render=null,t}},async getVcard(){this.vcard=_.mapValues(_.omit(_.fromPairs([...new URL(location).searchParams]),["code","liffClientId","liffRedirectUri","state","template"]),window.decodeBase64url),window.gtagTiming("after getVcard")},async btnShare(t=!1){try{if(this.showLoading(this.$t("wait"),this.$t("share.loading")),window.gtagEvent("瀏覽分享名片網頁","btnShare",this.vcard.template),!liff.isApiAvailable("shareTargetPicker"))throw new Error(this.$t("share.unsupported"));
	var e=Date.now(),i=await liff.shareTargetPicker(this.msgs),s=Date.now();
	if("success"!==_.get(i,"status")){if(t)return;
	throw new Error(this.$t("share.canceled"))}await this.swalFire({icon:"success",title:this.$t("share.success")}),1e3<s-e&&liff.closeWindow()}catch(t){window.logError({err:t}),await this.swalFire({icon:"error",title:this.$t("share.fail"),text:t.message})}finally{this.hideLoading()}},async btnSend(){try{if(this.showLoading(this.$t("wait"),this.$t("send.loading")),window.gtagEvent("瀏覽分享名片網頁","btnSend",this.vcard.template),!this.canSendMessages())throw new Error(this.$t("send.unsupported"));
	await liff.sendMessages(this.msgs),await this.swalFire({icon:"success",title:this.$t("send.success")}),liff.closeWindow()}catch(t){window.logError({err:t}),await this.swalFire({icon:"error",title:this.$t("send.fail"),text:t.message})}},async btnCopy(t,e=null){var i=_.get(this,"vcard.template");
	i&&window.gtagEvent("瀏覽分享名片網頁","btnCopy",i),e=e||document.body;
	const s=document.createElement("textarea");
	s.value=t,e.appendChild(s),s.select(),s.setSelectionRange(0,1e6),document.execCommand("copy"),e.removeChild(s),await this.swalFire({icon:"success",title:this.$t("copy.success")})},async showSavedAlert(){var t=window.parseJsonOrDefault(localStorage.getItem("swalFire"));
	localStorage.removeItem("swalFire"),_.isNil(t)||await this.swalFire(t)},async btnFriendMissing(){await this.swalFire({padding:"0",customClass:{actions:"mt-0 mb-2",content:"pt-3 px-3"},html:this.$t("dropdown.friendMissingHtml")})},async swalFire(t){return _.isPlainObject(t)&&(t={footer:this.$t("swalFooter"),...t}),Swal.fire(t)},getRenderedMsgs(){let t=this.render({vcard:this.vcard});
	return t=JSON5.parse(t),_.includes(["bubble","carousel"],_.get(t,"type"))&&(t={type:"flex",altText:this.$t("flexAltText"),contents:t}),t=_.castArray(t)},canSendMessages(){if(!liff.isInClient())return!1;
	var t=_.get(liff.getContext(),"type");
	return!!_.includes(["utou","room","group","square_chat"],t)},paramBase64url(t){t=window.getSearchParam(t);
	return t?window.decodeBase64url(t):null},paramGzip(t){t=window.getSearchParam(t);
	return t?window.decodeGzip(t):null},setOtherLinksByLiffV2(t){var t=t.match(/^.*?\/(\d+-[^/]+)\/(.*)$/),e=encodeURIComponent(t[2]);
	this.linkLiffV1=`https://line.me/R/app/${t[1]}?redirect=`+e,this.linkLihi="https://lihi1.com/hFW7P/"+e},isInOpenChat(){var t=liff.getContext();
	return"square_chat"===_.get(t,"type")},showLoading(t,e){Swal.fire({title:t,text:e,allowOutsideClick:!1,showConfirmButton:!1,willOpen:()=>{Swal.showLoading()}})},hideLoading(){Swal.close()}}};
	</script><script>window.i18nMessages=window.i18nMessages||{},window.i18nMessages.en={flexAltText:"Please check the vcard on mobile.",swalFooter:'<a target="_blank" href="https://lihi1.com/CVjIx/swal-footer">Having questions? Join LINE discuss group!</a>',title:"Share LINE vcard",wait:"Loading",copy:{btn:"Copy URL",help:'Click the "Copy URL" button and save to "LINE Keep."',success:"Copied"},csv:{getVcardFail:"Failed to fetch vcard data from csv"},dropdown:{addFriends:'Open "Add friends"',btn:"More features",create:'Create new "LINE vcard"',discuss:"Join LINE discuss group",friendMissing:"Friend not found?",friendMissingHtml:'<small class="text-left"><p>If you can\'t find your friends in the "Share vcard," you can try the following steps:</p><ol><li>Click the "Copy URL" button</li><li>Send the URL to any LINE chat</li><li>Open the URL in the LINE chat on mobile</li><li>Click the "Send vcard" button</li><li>Unsend URL in the LINE chat</li></ol></small>',keep:'Open "LINE Keep"',qrcodeReader:'Open "QRCode Reader"'},googlesheet:{getVcardFail:"Failed to fetch vcard data from google sheet",invalidApiKey:"Invalid Google api key",keyNotFound:'Failed to find the "{key}" key from first row'},init:{fail:"Failed to initialize",getTplFail:"Failed to fetch vcard template",loading:"Initializing…"},send:{btn:"Send vcard",fail:"Failed to send vcard",help:'Click the "Send vcard" button to send vcard to the chat directly.',loading:"Sending vcard…",success:"Sent",unsupported:'Please click the "Copy URL" button first, then paste and open the URL in the LINE chat on mobile.'},share:{btn:"Share vcard",canceled:"Share canceled",fail:"Failed to share vcard",help:'Click the "Share vcard" button to share with friends or groups.',loading:"Sharing vcard…",success:"Shared",unsupported:"The share feature is not supported, please try to update the LINE APP."}};
	</script><script>window.i18nMessages=window.i18nMessages||{},window.i18nMessages["zh-TW"]={flexAltText:"請在手機上查看數位版名片。",swalFooter:'<a target="_blank" href="https://lihi1.com/CVjIx/swal-footer">遇到問題？點此加入技術討論群！</a>',title:"分享 LINE 數位版名片",wait:"請稍候",copy:{btn:"複製網址",help:"按一下「複製網址」按鈕，然後存到 LINE Keep。",success:"複製成功"},csv:{getVcardFail:"無法從 csv 讀取資料"},dropdown:{addFriends:"點此前往「加入好友」",btn:"點此查看更多功能",create:"製作新的「LINE 數位版名片」",discuss:"加入技術討論社群",friendMissing:"在「分享好友」中找不到好友？",friendMissingHtml:'<small class="text-left"><p>如果在「分享好友」的清單中找不到好友，你可以嘗試以下步驟：</p><ol><li>按一下「複製網址」按鈕</li><li>進到聊天室並「貼上」網址</li><li>在好友的聊天室中「開啟」名片網址</li><li>按一下「直接傳送」按鈕傳送名片</li><li>在好友的聊天室中「收回」名片網址</li></ol></small>',keep:"點此前往「LINE Keep」",qrcodeReader:"點此掃描「行動條碼」"},googlesheet:{getVcardFail:"無法從 Google 試算表讀取資料",invalidApiKey:"無效的 Google API 金鑰",keyNotFound:"無法從試算表的第一列中找到「{key}」"},init:{fail:"頁面初始化失敗",getTplFail:"名片樣板獲取失敗",loading:"頁面初始化中…"},send:{btn:"直接傳送",fail:"傳送失敗",help:"按一下「直接傳送」按鈕，可以直接傳送到聊天室。",loading:"正在傳送名片…",success:"傳送成功",unsupported:"請先按「複製網址」，然後在 LINE 聊天視窗內貼上並開啟該網址，才有辦法使用「直接傳送」功能喔！"},share:{btn:"分享好友",canceled:"使用者取消分享",fail:"分享失敗",help:"按一下「分享好友」按鈕，可以分享給好友或群組。",loading:"正在分享名片…",success:"分享成功",unsupported:"不支援 shareTargetPicker，請嘗試更新應用程式版本。"}};
	</script><script>const cfg=window.vueConfig;
	cfg.methods={...cfg.methods,async getVcard(){try{var a=this.paramBase64url("json5"),t=a?_.get(await axios.get(a),"data"):{};
	this.vcard=_.isString(t)?JSON5.parse(t):t,window.gtagTiming("after getVcard")}catch(a){throw a.message=""+this.$t("csv.getVcardFail")+(a.message?": "+a.message:""),this.render=null,a}}};
	</script><script>(async()=>{_.isFunction(window.beforeVueCreate)&&await window.beforeVueCreate(),window.vueConfig.i18n=new VueI18n({locale:navigator.language,fallbackLocale:"zh-TW",messages:window.i18nMessages||{}}),window.vm=new Vue(window.vueConfig)})();
</script>
</body>
</html>