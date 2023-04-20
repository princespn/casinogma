process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0';
const http = require('http');
const WebSocket = require('ws');
const url = require('url');
const fs = require('fs');
const axios = require('axios');
const https = require('https');
let server;

const serverConfig = JSON.parse(fs.readFileSync('../public/site_config.json', 'utf8'));


if(serverConfig.ssl){
    const privateKey = fs.readFileSync('ssl/'+serverConfig.privateKey, 'utf8');
    const certificate = fs.readFileSync('ssl/'+serverConfig.certificate, 'utf8');
    const credentials = { key: privateKey, cert: certificate };

    server = https.createServer(credentials);
}else{server = http.createServer();}

const wss = new WebSocket.Server({ noServer: true });

/////////////////////////////////////////////////////////////////

let  clients=[];

wss.on('connection', function connection(ws,req) {
    const id = Math.random();
    console.log("новое соединение " + id);
    let shop = req.url.split('=')[1];
    console.log(shop);
    ws.shop = shop;
    clients[id] = ws;
    clients.push(ws);

    setTimeout(() => {  ws.send("World!"); }, 2000);
    console.log(Object.keys(clients));

    ws.on('message', function incoming(message) {
        message = message.toString().split('|');
        // получить сообщение с кодом паники, проверить код на сервере, разослать всем панику
        if (message[0] === '15987615'){
            sendAll("Site!", message[1]);
        }
        console.log(message);
    });


    ws.on('close', function() {
        console.log('соединение закрыто ' + id);
        delete clients[id];
    });
});

function sendAll(message, shop) {
    for (var i=0; i < clients.length; i++) {
        if (clients[i].shop === shop){
            // Отправить сообщения всем, включая отправителя
            clients[i].send(message);
            clients[i].close();
        }
    }
}

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
