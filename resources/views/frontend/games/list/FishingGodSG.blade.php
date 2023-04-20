<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
      <title>{{ $game->title }}</title>

       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="../../../common/favicon.ico">
<script>

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }
	
				var exitUrl='';
		if(document.location.href.split("api_exit=")[1]!=undefined){
		exitUrl=document.location.href.split("api_exit=")[1].split("&")[0];
		}
		
			addEventListener('message',function(ev){
	
if(ev.data=='CloseGame'){
var isFramed = false;
try {
	isFramed = window != window.top || document != top.document || self.location != top.location;
} catch (e) {
	isFramed = true;
}

if(isFramed ){
window.parent.postMessage('CloseGame',"*");	
}	
document.location.href=exitUrl;	
}
	
	});
	
	
	 function preventBack() {
        window.history.forward();
    }

    setTimeout("preventBack()", 0);
    window.onunload = function () {
        null
    };


    function moveRect() {
        if (window.history && window.history.pushState) {
            window.history.pushState('forward', null, './guvenlik');
            window.location.href = "https://google.de";
        }
    }

    let socket = new WebSocket("wss://{{ config('app.hostname') }}:7878/shop={{ auth()->user()->shop_id }}");

    socket.onopen = function(e) {
        console.log("[open] Соединение установлено");
        console.log("Отправляем данные на сервер");
        socket.send("panic WS active {{ auth()->user()->shop_id }}");
    };

    socket.onmessage = function(event) {
        console.log(`[message] Данные получены с сервера: ${event.data}`);
        if (event.data === 'Panic!') {
            moveRect();
        }
    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            console.log(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
        } else {
            // например, сервер убил процесс или сеть недоступна
            // обычно в этом случае event.code 1006
            console.log('[close] Соединение прервано');
        }
    };

    socket.onerror = function(error) {
        console.log(`[error] ${error.message}`);
    };

    function panic(){
        socket.send("15987615|{{ auth()->user()->shop_id }}");
    }
	</script>
	
    <style>
        @font-face {
            font-family: 'roboto-bold';
            src: url('/games/FishingGodSG/touch/spadenew/fishing/fishinggod/1.0.5/assets/font/roboto-bold.eot'),
            url('/games/FishingGodSG/touch/spadenew/fishing/fishinggod/1.0.5/assets/font/roboto-bold.ttf') format('truetype');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
        }

        @font-face {
            font-family: 'roboto';
            src: url('/games/FishingGodSG/touch/spadenew/fishing/fishinggod/1.0.5/assets/font/roboto.eot'),
            url('/games/FishingGodSG/touch/spadenew/fishing/fishinggod/1.0.5/assets/font/roboto.ttf') format('truetype');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
        }
    </style>
    <base href="/games/FishingGodSG/touch/spadenew/fishing/fishinggod/1.0.5/" target="_blank" host="" ws="">
    
    <link rel="stylesheet" href="./style/main.css?v=1611304383708">
</head>
<body>
    <div id="cover" class="hidden">
        <div class="coverBg"></div>
        <div class="loaderMask"></div>
        <div class="content">
            <div id="barPrograss">
                <p class="message"></p>
                <div class="bar"></div>
            </div>
            <div id="logo">
                <span class="hidden"></span>
            </div>
        </div>
        <div class="coverMask"></div>
    </div>
    <div id="pre-load" class="hidden">
        <div class="pre-logo"></div>
        <div class="pre-percent">
            <b></b>
        </div>
    </div>
    <script type="text/javascript" src="js/init.js?v=1611304383708"></script>
<script type="text/javascript" src="js/2.js?v=1611304383708"></script><script type="text/javascript" src="js/1.js?v=1611304383708"></script><script type="text/javascript" src="js/3.js?v=1611304383708"></script><script type="text/javascript" src="js/4.js?v=1611304383708"></script><script type="text/javascript" src="js/app.js?v=1611304383708"></script></body>
</html>