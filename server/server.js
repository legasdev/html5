// подключенные клиенты
var clients = {};
var players = {};
var rooms = {}; //игровые комнаты

players[0] = {};
players[1] = {};
//типо игрок с бд
players[1].name = "legasdev";
players[1].id = 1;

players[0].name = "wikend";
players[0].id = 2;

rooms[0] = {};
rooms[1] = {};
rooms[2] = {};
//типо комната создана
rooms[1].idr = "1";
rooms[1].maxPlayers = 1;
rooms[1].players = {};
rooms[1].players[1] = players[1];
rooms[1].isPlay = true;
rooms[1].whoPlay = 1;

rooms[2].idr = 2;
rooms[2].maxPlayers = 1;
rooms[2].players = {};
rooms[2].players[1] = players[0];
rooms[2].isplay = false;
rooms[2].whoPlay = 1;

process.on('uncaughtException', function(err) {
	console.log('Caught Exception: '+err);
});

var express = require('express');
var app = express();
app.use(express.static('../client'));
app.listen(80);

// использование Math.round() даст неравномерное распределение!
function rand(min, max)
{
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

//веб сервер
var WebSocketServer = new require('ws');

//игровая карта
var map = {};
map.l = 0;
map.r = 1000;
map.t = 0;
map.b = 1000;
var startMass = 30;

// WebSocket-сервер на порту 443
var webSocketServer = new WebSocketServer.Server({
  port: 443
});

webSocketServer.on('connection', function(ws) {
  	//var id = Math.random(); //присваиваем id
  	//clients[id] = ws;
	//заносим данные об игроке и ставим его в 0, 0
	//players[id] = {};
	//players[id].x = rand(map.l, map.r);
	//players[id].y = rand(map.t, map.b);
	//players[id].s = startMass;
	
	ws.send(JSON.stringify({'type':'map', 'data':map}));
	
	/*//посылаем данные клиентам
	var interval = setInterval(function() {
		if (ws && ws.readyState == 1) {
			ws.send(JSON.stringify({'type':'players', 'data':players, 'myid':id}));
		}
	}, 10);*/

	//получаем данные
	ws.on('message', function(message) {
		try {var m = JSON.parse(message);} catch(e){return;}
		switch (m['type']) {
			//получаем номер сессии и получаем доступ к ней
			case 'idr':
				echos(m['data']); //отвечаем
				break;
		}
	 });

	//закрываем моединение
	ws.on('close', function() {
		delete clients[id];
		delete players[id];
		clearInterval(interval);
	});
	
	/* 
		Функция ответчик комнаты и соединения
	*/
	function echos(idr) {
		//отправляем данные (комнату)
		if (ws && ws.readyState == 1) {
			ws.send(JSON.stringify({'type':'idr', 'data':rooms[idr]}));
		}
	}
});

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	