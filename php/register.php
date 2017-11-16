<?
// Страница регситрации нового пользователя
# Соединямся с БД
mysql_connect("monopoly.ru", "root", "");

mysql_select_db("monopoly");

if(isset($_POST['registration']))
{
	$err = array();
	# проверям логин
	if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
	{
		$err[] = "Логин может состоять только из букв английского алфавита и цифр";
	}
	if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
	{
		$err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
	}
	# проверяем, не сущестует ли пользователя с таким именем
	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE user_login='".mysql_real_escape_string($_POST['login'])."'");
	$result=mysql_result($query, 0);
	if($result > 0)
	{
		$err[] = "Пользователь с таким логином уже существует в базе данных";
	}

	if($_POST['password'] !== $_POST['password_2']){
		$err[] = "Пароли не совпадают";
	}
	# Если нет ошибок, то добавляем в БД нового пользователя
	if(count($err) == 0)
	{
		$login = $_POST['login'];
		# Убераем лишние пробелы и делаем двойное шифрование
		$password = md5(md5(trim($_POST['password'])));
		$email=$_POST['email'];
		$insert=mysql_query("INSERT INTO users SET user_login='".$login."', user_password='".$password."',user_email='".$email."' ");
		
	}
	else
	{
		print "<b>При регистрации произошли следующие ошибки:</b><br>";
		foreach($err AS $error)
		{
			print $error."<br>";
		}
	}
}
?>