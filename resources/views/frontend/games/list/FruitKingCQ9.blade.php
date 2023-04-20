<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>{{ $game->title }}</title>
<base href="/games/{{ $game->name }}/1/">
<script>



 //window.console={ log:function(){}, error:function(){} };       
 //window.onerror=function(){return true};

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }




var exitUrl='/';
		
	
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

    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=0.5,maximum-scale=0.5,user-scalable=no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="shortcut icon" href="../slot-common-files/images/favicon.ico?yolo">
    <link rel="stylesheet" href="../slot-common-files/style/layout.css?yolo">
</head>

<body>
    <div id="game" class="game"></div>
    <script src="../slot-common-files/js/Phaser.js?yolo"></script>
    <script src="../slot-common-files/js/Photon-Javascript_SDK.min.js?yolo"></script>
    <script src="../slot-common-files/js/TimelineMax.min.js?yolo"></script>
    <script src="../slot-common-files/js/TweenLite.min.js?yolo"></script>
    <script src="../slot-common-files/js/EasePack.min.js?yolo"></script>
    <script type="text/javascript" src="dll.js?93da922216a86006f753"></script>
    <script type="text/javascript" src="loading.js?5778a05"></script>
    <script type="text/javascript" src="app.js?5778a05"></script>
</body>

</html>