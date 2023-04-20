<!doctype html>
<html>

<head>

   
    <meta charset="UTF-8">
  	<base href="/games/Royal20FruitsNG/app/royalFruits20.19/"> 
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="robots" content="noindex, nofollow">
    <title>{{$game->title}}</title>
    <link href="../../favicon.ico" rel="icon" type="image/x-icon" />
	 <script type="text/javascript" src="index.js?cfa8a9b6052ac45261eb"></script>
	<script>

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }

       
		var qstr='/?launcher=true&sfx_629950077=1614075681549&commonVersion=(build%2085)&game=318&userId=798626506653&wshost=/&quality=high&lang=en&noframe=yes';	
		
var uparts=document.location.href.split("?");
		var exitUrl='';
		if(document.location.href.split("?")[1]==undefined){
		document.location.href=document.location.href+qstr;	
		}else if(document.location.href.split("?api_exit")[1]!=undefined){
			
		document.location.href=uparts[0]+qstr+'&'+uparts[1];	
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

     <body>
        <script>
            (function(){var a=document.createElement("script");a.setAttribute("type","text/javascript");a.setAttribute("src","../../js/loader.js?r="+Math.random());"undefined"!==typeof a&&document.getElementsByTagName("head")[0].appendChild(a);})();
        </script>
    </body>
	<script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/device.js"></script>
<script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/addon.js"></script>
</html>
