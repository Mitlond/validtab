<?php
 
/* Соединяемся с базой данных */
$hostname = "localhost"; // название/путь сервера, с MySQL
$username = "root"; // имя пользователя 
$password = ""; // пароль пользователя 
$dbName = "test"; // название базы данных
 
/* Таблица MySQL, в которой хранятся данные */
$table = "users";
 
/* Создаем соединение */
mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
 
/* Выбираем базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($dbName) or die (mysql_error());
 
/* Составляем запрос для извлечения данных из полей "first_name", "last_name", и т.д
таблицы "users" */
$query = "SELECT id, first_name,last_name,patronymic_name,email,login,password FROM $table";
 
/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
$res = mysql_query($query) or die(mysql_error());
 
/* Выводим данные из таблицы */
echo ("
<!Doctype html>
<html>
	<head>
	    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
		<title>Учебное Расписание</title> 
		
		<style type=\"text/css\">
<!--
body { font: 12px Georgia; color: #666666; }
h3 { font-size: 16px; text-align: center; }
table { width: 700px; border-collapse: collapse; margin: 0px auto; background: #E6E6E6; }
td { padding: 3px; text-align: center; vertical-align: middle; }
.buttons { width: auto; border: double 1px #666666; background: #D6D6D6; }
-->
</style>
	</head>
<body>
 
<h3>Вывод ранее сохраненных данных из таблицы MySQL</h3>
 
<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
 <tr style=\"border: solid 1px #000\">
  <td><b>#</b></td>
  <td align=\"center\"><b>Имена пользователей</b></td>
  <td align=\"center\"><b>email пользователей</b></td>
  <td align=\"center\"><b>Пароль</b></td>
 </tr>
");
 
/* Цикл вывода данных из базы конкретных полей */
while ($row = mysql_fetch_array($res)) {
    echo "<tr>\n";
    echo "<td>".$row['id']."</td>\n";
    echo "<td>".$row['first_name']."</td>\n";
	echo "<td>".$row['last_name']."</td>\n";
	echo "<td>".$row['patronymic_name']."</td>\n";
    echo "<td>".$row['email']."</td>\n";
	echo "<td>".$row['login']."</td>\n";
    echo "<td>".$row['password']."</td>\n</tr>\n";
}
 
echo ("</table>\n");
 
/* Закрываем соединение */
mysql_close();
 
/* Выводим ссылку возврата */
echo ("<div style=\"text-align: center; margin-top: 10px;\"><a href=\"admin.php\">Вернуться назад</a></div>");
 
?>