<?
// Страница авторизации
# Функция для генерации случайной строки

function generateCode($length=6) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;  
	while (strlen($code) < $length) {
		$code .= $chars[mt_rand(0,$clen)];  
	}
	return $code;
}

# Соединямся с БД
mysql_connect("monopoly.ru", "root", "");
mysql_select_db("monopoly");

if(isset($_POST['autorization']))
{
	# Вытаскиваем из БД запись, у которой логин равняеться введенному
	$temp=mysql_real_escape_string($_POST['login']);
	$query = mysql_query("SELECT user_id, user_password FROM users WHERE user_login='".$temp."' LIMIT 1") or die ("Invalid query: " . mysql_error());
	
	$data = mysql_fetch_assoc($query);
	
	# Сравниваем пароли
	if($data['user_password'] === md5(md5($_POST['password'])))
	{
		# Генерируем случайное число и шифруем его
		$hash = md5(generateCode(10));
		if(true)
		{
			# Если пользователя выбрал привязку к IP
			# Переводим IP в строку
			$insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
		}
		# Записываем в БД новый хеш авторизации и IP

		mysql_query("UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");



		# Ставим куки

		setcookie("id", $data['user_id'], time()+60*60*24*30);

		setcookie("hash", $hash, time()+60*60*24*30);



	}
	else
	{
		print "Вы ввели неправильный логин/пароль";
	}
}
?>