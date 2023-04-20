<!DOCTYPE html>
<html>
<head>
    <title>{{ $game->title }}</title>
    <meta id="metaToken" name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
      <style>
         body,
         html {
         position: fixed;
         }
      </style>
   </head>

<script>

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }
    
    sessionStorage.setItem('Curr', '{{auth()->user()->present()->shop->currency}}');

var exitUrl='';
		if(document.location.href.split("api_exit=")[1]!=undefined){
		exitUrl=document.location.href.split("api_exit=")[1].split("&")[0];
		}
addEventListener('message',function(ev){

if(ev.data=='CloseGame'){

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

<body style="margin:0px;width:100%;background-color:black;overflow:hidden">



<iframe id='game' style="margin:0px;border:0px;width:100%;height:100vh;" src='/games/{{ $game->name }}/gs2c/html5Game.html?extGame=1&symbol=vs20sbxmas&gname=Sweet%20Bonanza%20Xmas&jurisdictionID=UK&lobbyUrl=https%3A%2F%2Fwww.socialtournaments.com&mgckey=stylename@generic~SESSION@09d71088-f53c-4c20-b376-f882fffd995c' allowfullscreen>


</iframe>




</body>

</html>
