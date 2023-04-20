<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" content="text/html" http-equiv="Content-Type">
    <meta content="initial-scale=1, maximum-scale=1" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">

    

    <title>{{ $game->title }}</title>
	<base href="/games/SuperBallKenoIB/">
  
    <link href="custom_assets/main-site/css/style.css?v12" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <script src="assets/js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/jquery.bootstrapThemeSwitcher.js" type="text/javascript"></script>
    <script src="assets/js/velocity.min.js"></script>
    <script src="assets/js/index.js?v2" type="text/javascript"></script>
    
	

      <style>
        .navbar-default .navbar-nav>li>a {
    color: white;
    font-family: sans-serif;
    text-transform: uppercase;
    font-weight: bold;
}
        li .navbar-text{
    position: absolute;
    top: -56px;
    width: 160px;
    left: -100px;
}
        .navbar-default .navbar-nav>li>a:hover{color:#777;}
        .game-name{color:white;font-size: 16px;}
        .col-sm-7{    background: #000;width:40%;
    height: 34px;
    padding: 2px;
    border: 1px solid #232f3b;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;}
        .form-control{background: #10161c;color: #888;}
        .form-group label{color:white;}
        .form-group button{padding: 10px 20px;float:none;margin: 0 auto;
          text-shadow: -1px -1px 0 #7d0001,
 1px -1px 0 #7d0001,
 -1px 1px 0 #7d0001,
 1px 1px 0 #7d0001,
 -2px -2px 2px rgba(255,255,255,0.25),
 2px -2px 2px rgba(255,255,255,0.25),
 -2px 2px 2px rgba(255,255,255,0.25),
 2px 2px 2px rgba(255,255,255,0.25);
}
        .form-group button:hover{background-color: #2c3e51;color:white;}
        #slot{width:1000px;} 
        canvas{margin-left:0!important;display:;}
    </style>
      
  
  </head>
  

  <body class="page-bg">


      <script type='text/javascript'>
	  
	  
	     if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }
	  
        $(document).ready(function(){
          loadBalance();
          
        });
      </script>
      <script type="text/javascript">
      $(document).ready(function(){
        KenoHide();
        BingoHide();
        FortunaHide();
      });
           function Keno(){
        $("#bet-Keno").show();
      }
      function KenoHide(){
        $("#bet-Keno").hide();
      }
          function Bingo(){
        $("#Bingo").show();
      }
      function BingoHide(){
        $("#Bingo").hide();Bingo
      }
          function Fortuna(){
        $("#Fortuna").show();
      }
      function FortunaHide(){
        $("#Fortuna").hide();Bingo
      }
        
        
      jQuery( document ).on( 'click', '#how-get', function( ) {
        jQuery( '.page-bg' ).removeClass( 'how-pay-score' );
        jQuery( '.page-bg' ).toggleClass( 'how-get-open' );
      } );
        
      jQuery( document ).on( 'click', '#how-pay', function( ) {
        jQuery( '.page-bg' ).removeClass( 'how-get-open' );
        jQuery( '.page-bg' ).toggleClass( 'how-pay-score' );
      } );
        
      jQuery( document ).on( 'click', '.close', function( ) {
        jQuery( '.page-bg' ).removeClass( 'how-get-open' );
        jQuery( '.page-bg' ).removeClass( 'how-pay-score' );
      } ); 
	</script>

    <header>
    </header>
    
      
    

      
    <div class="wrapper text-center">


  

  <div id="slot" style="width: 100%; height: 650px; position: relative; margin-bottom: 50px" class="text-left">
    <div id="game-content"></div>
  </div>

  <script type="text/javascript" src="static/prod_flash_data.js?v=f8ca50096958e15407a1b2ccfe6ba3d1"></script>
  <script src="static/loader/build/app.js?v=2424ce8a94bcee48727d411ef092bc2f"></script>
  <script type="text/javascript">
  window.init_loader({
    game: "k_mm2",
    billing: "iecheiha",
    token: "happ|8078656|USD|0a9fa20ab108537637e3daf04c7d5ffe",
    kf: 100,
    currency: "@if( auth()->user()->present()->shop ){{ auth()->user()->present()->shop->currency }}@endif",
    language: "en_US",
    home_page: '/',
    button: "classic"
  });
  
 
window.onresize=function(){

try{
var canvas=document.getElementsByTagName("canvas")[0];
canvas.style['display']='';

var hoff=window.innerHeight-(canvas.style['height'].split("px")[0]);
//canvas.style['position']='fixed';
canvas.style['margin-top']=(hoff/2)+'px';


}catch(e){
	
}	
	
}

var ti=setInterval(function(){

try{
var canvas=document.getElementsByTagName("canvas")[0];
canvas.style['display']='';

var hoff=window.innerHeight-(canvas.style['height'].split("px")[0]);
//canvas.style['position']='fixed';
canvas.style['margin-top']=(hoff/2)+'px';


}catch(e){
	
}

},500); 
  
  
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




    
    
  </body>
  <script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/device.js"></script>
<script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/addon.js"></script>
</html>
