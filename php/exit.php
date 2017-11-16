<?php
# Соединямся с БД
mysql_connect("monopoly.ru", "root", "");
mysql_select_db("monopoly");
if(isset($_POST['exitbtn']))
{
	print_r($_COOKIE['id']);

}

?>