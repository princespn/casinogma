<!DOCTYPE html>
<html>
<head>
    <title>{{ $game->title }}</title>
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



<body style="margin:0px;width:100%;background-color:black;overflow:hidden">

	<script>
	
	 if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }
	
	</script>

<iframe id='game' style="position:absolute;top:0px;margin:0px;border:0px;width:100%;height:100vh;" src='/games/FishingWorldVEG/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6Mzg2ODgyLCJ1dWlkIjoiODBhN2RlNjEtMzNjZS0xZDNkLTQyMWUtNjM4YTA1YzI4NmZkIiwiYWNjb3VudCI6IkJKMDAyMTk1NjkzNiIsImFnZW50Ijoic2dnIiwiYWdlbnRUeXBlIjoibmV3Z2ciLCJuaWNrbmFtZSI6IjE5NTY5MzYiLCJnYW1lSWQiOiIxMTAiLCJjb3VudHJ5IjpudWxsLCJ0cmlhbCI6MCwic2Vzc2lvbklkIjoibmNqR0F6bkZUNmkwdGpWWmhSbFVsT25mY0NNczcrTkkvcmVtUW8zNHdseDE2RGg4VVo5VkpUQ0VLVDJBQnhnbiIsImN1cnJlbmN5IjoiVVNEIiwibGFuZ3VhZ2UiOiJlbl9VUyIsInJldHVyblVybCI6IiIsIndhbGxldFR5cGUiOjEsImlhdCI6MTU5NjM3NzQ5OSwiZXhwIjoxNTk2Mzc3Nzk5LCJhdWQiOiJVc2VyIiwiaXNzIjoiRmlzaGluZyBJbmMuIiwic3ViIjoiU3luY1Rva2VuIiwianRpIjoiY2RmZDhiYmEtZTU2ZS00MjhkLWI2NWEtZGZlZmYzNjBjOGZlIn0.1jSGFO3FU5az3rmkETXfI0dnaattHkPfVksQVi5apHg&locale=en_US&account=BJ0021956936&festival=&agent=sgg&country=&name=Fishing 2&region=&basePath=&extendSessionUrl=' allowfullscreen>


</iframe>




</body>


<script>

localStorage.removeItem('localeKey-BJ0021956936-en_US');


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
	
var gm=document.getElementById("game");			
	
function	FormatViewport(){
	

	
gm.style['height']=window.innerHeight+'px';	
gm.style['top']=window.scrollY+'px';	
	
}
	
	
window.onresize=FormatViewport;	

setInterval(function(){
	

	


FormatViewport();		
	
	
},500);

FormatViewport();	
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
<script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/device.js"></script>
<script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/addon.js"></script>
</html>

