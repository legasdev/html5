<?
require "/php/login.php";
require "/php/register.php";
?>
	<html>

	<head>
		<meta charset="utf-8">
		<title>Игра</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body onload="userAutorization()">

		<!--		<canvas id="canvas"></canvas>-->
		<div class="header">
			<div class="header-top">
				<div></div>
				<div class="loginButton author" onselectstart="return false" onclick="loginFormOn();getCookie('id')">Авторизация</div>
				<div class="loginButton registr" onselectstart="return false" onclick="regFormOn()">Регистрация</div>
				<form action="" method="POST" id="exitForm">
					<p>Авторизировался <span id="userName"></span></p>
					<button type="submit" onclick='document.getElementById("lf").submit();clearCookie();' name="exitbtn" class="exitUser loginButton" onclick="exitFunc()" value="Выход">Выход</button></form>


			</div>
			<?php
			require "php/check.php";
			?>
				<form action="" method="POST" id="lf">
					<div class="modalLogin">
						<input type="text" name="login" class="logpass">
						<input type="password" name="password" class="logpass">
						<button type="submit" onclick='document.getElementById("lf").submit();ExitOn()' class="exitbutton" onselectstart="return false" name="autorization">Войти</button >
				</div>
			</form>
			<form action="" method="POST">
				<div class="modalReg">
					<p>Введите логин: </p><input type="text" name="login">
					<p>Введите Email: </p><input type="email" name="email">
					<p>Введите пароль: </p><input type="password" name="password">
					<p>Подтвердите пароль: </p><input type="password" name="password_2">
					<button type="submit" class="exitbutton regbutton" onselectstart="return false"  name="registration"onclick="RegOn()">Зарегистрировать</button>
					</div>
				</form>
		</div>
		
		<script src="js/js.js"></script>
		<script>
			function loginFormOn() {
				var logbtn = document.getElementsByClassName('loginButton')[0];
				var regbtn = document.getElementsByClassName('loginButton')[1];
				var modalMenu = document.getElementsByClassName('modalLogin')[0];
				modalMenu.style.right = '1%';
				logbtn.style.color = '#1D1F21';
				logbtn.style.border = '0px';
				regbtn.style.color = '#1D1F21';
				regbtn.style.border = '0px';
			}
		</script>
		<!--
		<script>
			//храним idr
			
			function checkIDR() {
				var idr =  window.location.href;
				idr = idr.substr(idr.lastIndexOf('=')+1);
				return idr;
			}
	
			window.onload = function() {
				var ws;
				var ctx;
				var myplayer;
				var map = {}; //игровая карта
				var players = {}; //игроки
				//соединяем
				function connect() {
					ws = new WebSocket('ws://127.0.0.1:443');
					ws.onopen = onopen;
					ws.onmessage = onmessage;
					ws.onerror = onerror;
					ws.onclose = onclose;
				}
				
				//при открытии соединения
				function onopen() {
					//пересылаем номер своей комнаты
				var idr = checkIDR();	ws.send(JSON.stringify({'type':'idr', 'data':idr}));
				}
				
				//при получении данных с сервера
				function onmessage(evt) {
					try {
						var m = JSON.parse(evt.data);
					} catch(e) {
						return;
					}
					
					//сортируем полученные данные с сервера
					switch (m['type']) {
						case 'players': 
							players = m['data'];
							//выбираем себя себя
							myplayer = players[m['myid']];
							break;
						case 'map':
							map = m['data'];
							break;
						case 'idr':
							console.log(m['data']);
							break;
					}
				}
				
				//при ошибке
				function onerror(e) {
					if (e) {
						console.log(e);
					}
					connect();
				}
				
				//при закрытии соединения
				function onclose() {
					
				}
				
				function draw() {
					if (!myplayer) {return;}
					ctx = canvas.getContext('2d');
					for (var key in players) {
						var _player = players[key];
						ctx.beginPath();
						ctx.arc(_player.x, _player.y, _player.s, 0, Math.PI*2);
						ctx.fill();
					}
				}
				
				function tick() {
					canvas.width = document.documentElement.clientWidth;
					canvas.height = document.documentElement.clientHeight-4;
					draw();
					requestAnimationFrame(tick);
				}
				tick();
				connect();
			};
		</script>
-->
	</body>

	</html>
	<!--