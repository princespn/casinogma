

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>{{ $game->title }}</title>
	<meta name="viewport" content="width=device-width,height = device-height, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
	<base href="/games/DarkQueenEGT/html5/" target="_blank" >
	<style type="text/css" media="screen">
		html, body, body.sidebars { width:100%; height:100%; margin:0; padding:0;}
	</style>
	<script src="../js/jquery.js"></script>
	<script src="device.min.js"></script>
	<script>

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }

	var serverConfig;
    var  serverString;
    var XmlHttpRequest = new XMLHttpRequest();
    XmlHttpRequest.overrideMimeType("application/json");
    XmlHttpRequest.open('GET', '/socket_config.json', false);
    XmlHttpRequest.onreadystatechange = function ()
    {
        if (XmlHttpRequest.readyState == 4 && XmlHttpRequest.status == "200")
        {
            serverConfig = JSON.parse(XmlHttpRequest.responseText);
            serverString=serverConfig.prefix_ws+serverConfig.host_ws+':'+serverConfig.port;
          
        }
    }
    XmlHttpRequest.send(null);
		
		var sslHost=false;
		
		if(serverConfig.prefix_ws=='wss://'){
		sslHost=true;
		}
		
         var gameName='DarkQueenEGT';
		$(function(){

			var connectionParams = {
				sslHost: sslHost,
				tcpHost: serverConfig.host_ws,
				tcpPort: serverConfig.port,
				sessionKey: "41be9e65e0ff03a65e8c93576bf61130",
				lang: "en",
				gameIdentificationNumber: "858"
			};

			var additionalParams = {
				base: "/games/"+gameName+"/html5/"
			};

if(device.desktop()){

			$.ajax({
				type: "GET",
				crossDomain: "false",
				url: "../init/init_desktop_cf_test.js",
				dataType: "script",
				contentType: "text/plain",
				success: function() {
					initDesktopHtml(connectionParams);				}
			});
			
			
	}else{
			
					$.ajax({

				type: "GET",

				crossDomain: "false",

				url: "../init/init_mobile_cf_test.js",

				dataType: "script",

				contentType: "text/plain",

				success: function() {

					EGT.initMobile(connectionParams);				}

			});

			
		}
			

		});
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
</head>
<body>
</body>
</html>


