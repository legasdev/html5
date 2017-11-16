<?

// Скрипт проверки


# Соединямся с БД

mysql_connect("monopoly.ru", "root", "");

mysql_select_db("monopoly");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{   
	$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
	$userdata = mysql_fetch_assoc($query);
	if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']) or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
	{
		//print "Вы не авторизированы!";
	}
	else
	{
		//print "Привет, ".$userdata['user_login'].". Всё работает!";
	}
}
else
{
	//print "Включите куки";
}
?>

