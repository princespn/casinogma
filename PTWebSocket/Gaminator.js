process.env.NODE_TLS_REJECT_UNAUTHORIZED = '1';
const http = require('http');
const WebSocket = require('ws');
const url = require('url');
const fs = require('fs');
const Redis = require('ioredis');
const redis = new Redis();
const axios = require('axios');
const https = require('https');
let server;

const serverConfig = JSON.parse(fs.readFileSync('../public/Gaminator_config.json', 'utf8'));


if(serverConfig.ssl){
  const privateKey = fs.readFileSync('ssl/'+serverConfig.privateKey, 'utf8');
  const certificate = fs.readFileSync('ssl/'+serverConfig.certificate, 'utf8');
  const credentials = { key: privateKey, cert: certificate };

  server = https.createServer(credentials);
}else{server = http.createServer();}
const wss = new WebSocket.Server({ noServer: true });
let  clients=[];
let  wsClientsId=0;

function decodeString(string){
  string = string.substring(0, string.length).split("\u00ff");
  for (e = 0; e < string.length; e++) string[e] = Utf8.decode(string[e]);
    return string; }
  function encodeString(array){
    let str = array.join("\u00ff");
    str = str.replace('€', 'â¬');
    return str; }
    const Utf8 = {
      encode: function(a) {
        for (var b = "", d = 0; d < a.length; d++) {
          var e = a.charCodeAt(d);
          128 > e ? b += String.fromCharCode(e) : (127 < e && 2048 > e ? b += String.fromCharCode(e >> 6 | 192) : (b += String.fromCharCode(e >> 12 | 224), b += String.fromCharCode(e >> 6 & 63 | 128)), b += String.fromCharCode(e & 63 | 128))
        } return b},
        decode: function(a) {
          for (var b = "", d, e, f, g = 0; g < a.length;) d = a.charCodeAt(g) & 255, 128 > d ? (b += String.fromCharCode(d), g++) : 191 < d && 224 > d ? (e = a.charCodeAt(g + 1) & 255, b += String.fromCharCode((d & 31) << 6 | e & 63), g += 2) : (e = a.charCodeAt(g + 1) & 255, f = a.charCodeAt(g + 2) & 255, b += String.fromCharCode((d & 15) << 12 | (e & 63) << 6 | f & 63), g += 3);
            return b }};
////////////////////////////////////////////
class Client{
  constructor(ws){
    this.ws = ws;
    this.bet = 1;
    this.lines = 1;
    this.multiplier = 1;
  }
  sorter(message){
    try{
      if(message[0].includes('InitGame')){ this.initGame(message[0]); }
      if(message == '30'){ this.sendToServer('bet'); }
      if(message == '9'){ this.sendToServer('gamble'); }
      if(message[0][0] == '5'){
          if (message[0][1] == 'r'){this.sendToServer('red');}
          if (message[0][1] == 'b'){this.sendToServer('black');}
      }
      if(message == '40'){ this.sendToServer('collect'); }
      if(message == '60'){ this.sendToServer('freespin'); }
      if(message[0][0] == '2' && message.length == 3) {
          this.lines = message[1];
          this.bet = message[0].substring(1);
          this.multiplier = message[2];
      }
      if(message == '\n'){this.sendToServer('load');}
    }catch(e){
      console.log(e);
    }
  }
  initGame(initMessage){
    const param=initMessage.split(":");
    this.cookie = param[3];
    this.sessionId = param[2];
    this.gameName = param[1];
    this.gameURL= serverConfig.prefix+serverConfig.host+'/game/'+this.gameName+'/server?&sessionId='+this.sessionId;
    console.log(this.gameURL);
    this.sendToServer('load');
  }
  async sendToServer(command){
      const slotState = this.getState();
    const data = {'Command': command, 'BetToLine': slotState[0], 'Lines': slotState[1], 'Multiplier': slotState[2]};
    const paramStr=JSON.stringify(data);
    try{
      const resp = await axios.post(this.gameURL, data,{
        withCredentials: true,
        headers: {
          'Connection': 'keep-alive',
          "Content-Type": "application/json",
          'Content-Length': paramStr.length,
          'Cookie': this.cookie
        }
      });
      console.log(resp);
      const msg = resp.data;
      if(Array.isArray(msg[2]) && Array.isArray(msg[3])){
          this.setState(msg[3])
      for(var i=0;i<msg.length;i++){
        this.ws.send(encodeString(msg[i]));
      }}else{
          if(Array.isArray(msg[1])) {
              this.ws.send(encodeString(msg[0]));
              this.ws.send(encodeString(msg[1]));
          }
          else{this.ws.send(encodeString(msg));}
      }
    }catch(e){console.log(e)}
  }
  setState(data){
      data = data.find(el => el[0] === 'e' && el[1] === ',');
      data = data.split(',');
      this.lines = data[1];
      this.bet = data[2];
      this.multiplier = data[3];
  }
  getState(){
      return [this.bet, this.lines, this.multiplier]
  }
}

/////////////////////////////////////////////////////////////////

wss.on('connection', function connection(ws) {
    const id = Math.random();
    console.log("новое соединение " + id);
  clients[id] = new Client(ws);

  ws.on('message', function incoming(message) {
      message = message.toString();
    clients[id].sorter(decodeString(message)); // когда что то пришло от фронта на сокет
    console.log(decodeString(message));
  });


  ws.on('close', function() {
    console.log('соединение закрыто ' + id);
    delete clients[id];
  });
});

///////////////////////////////////////////////////////////////

server.on('upgrade', function upgrade(request, socket, head) {
  const pathname = url.parse(request.url).pathname;
  try {
    wss.handleUpgrade(request, socket, head, function done(ws) {
      wss.emit('connection', ws, request);
    });
  } catch (e) {
    socket.destroy();
    console.log(e);
  }
});

server.listen(serverConfig.port);
