<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>{{ $game->title }}</title>
<base href="/games/{{ $game->name }}/amarent/">
<script>

document.cookie = 'phpsessid=; Max-Age=0; path=/; domain=' + location.host; 
document.cookie = 'PHPSESSID=; Max-Age=0; path=/; domain=' + location.host;

 window.console={ log:function(){}, error:function(){} };       
 window.onerror=function(){return true};

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }

var uparts=document.location.href.split("?");
		var exitUrl='';
		        if(document.location.href.split("?")[1]==undefined){
		document.location.href=document.location.href+'/?hash=&curr=&lang=ru&uselang=en&exit=&config=1372';	
		}else if(document.location.href.split("?api_exit")[1]!=undefined){
			
		document.location.href=uparts[0]+'/?hash=&curr=&lang=ru&uselang=en&exit=&config=1372&'+uparts[1];	
		}
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
document.location.href='../../../../';	
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



<meta charset="UTF-8"/>
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta http-equiv="expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
	<link media="screen" href="fixed_5.css" type= "text/css" rel="stylesheet" />
	<script src="./src/webgl-2d.js" type="text/javascript"></script>
</head>
<body>
    <div id="gameArea">
		<canvas id="canvas2"></canvas>
		<canvas id="canvas"></canvas>
		<div id="gameOverlay">
			<div id="jurisdictionDiv">
				<button id="btnsp" class="buttonPause"></button>
				<button id="btnsl" class="buttonLimit"></button>
				<button id="btnst" class="buttonTest"></button>
			</div>
			<div id="notificationDiv">
				<p id="notificationTitle"></p>
				<p id="notificationText"></p>
				<div id="notificationIcon">
					<p id="notificationCounter"></p>
				</div>
			</div>
			<div id="messageOverlay">
				<div id="messagePanel">
					<h3 id="messageTitle"></h3>
					<p id="messageText"></p>
					<button id="btne" class="messageTopbutton"></button>
					<button id="btn1" class="messageButton"></button>
					<button id="btn2" class="messageButton"></button>
					<button id="btn3" class="messageButton"></button>
					<button id="btn4" class="messageButton"></button>
				</div>
			</div>
		</div>
	</div>
	<div id="slideUpOverlay">
		<div id="slideUp">
			<div id="slideElem1"></div>
			<div id="slideElem2"></div>
		</div>
	</div>
	<div id="rotateOverlay">
		<div id="rotatePanel">
			<div id="rotate">
			</div>
			<div id="rotateInfo">
			</div>
		</div>
	</div>
	<script type="text/javascript" src="./src/jokerpokerpokerloader_00157472.js"></script>
</body>
</html>