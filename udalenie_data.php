﻿<?php
 
/* Соединяемся с базой данных */
$hostname = "localhost"; // название/путь сервера, с MySQL
$username = "root"; // имя пользователя 
$password = ""; // пароль пользователя 
$dbName = "test"; // название базы данных
 
/* Таблица MySQL, в которой хранятся данные */
$table = "res_tab";
 
/* Создаем соединение */
mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
 
/* Выбираем базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($dbName) or die (mysql_error());
 
/* Если была нажата ссылка удаления, удаляем запись */
if (isset($_GET['del'])) {
   $del = intval($_GET['del']);
   $query = "delete from $table where (id='$del')";
   /* Выполняем запрос. Если произойдет ошибка - вывести ее. */
   mysql_query($query) or die(mysql_error());
}
/* Заносим в переменную $res всю базу данных */
$query = "SELECT * FROM $table";
/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
$res = mysql_query($query) or die(mysql_error());
/* Узнаем количество записей в базе данных */
$row = mysql_num_rows($res);
 
/* Выводим данные из таблицы */
echo ("

 <!Doctype html>
<html>
	<head>
	    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
    <title>Вывод и удаление данных из MySQL</title>
 
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
 
<h3>Вывод и удаление ранее сохраненных данных из таблицы MySQL</h3>
 
<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
 <tr style=\"border: solid 1px #000\">
   <td><b>#</b></td>
  <td align=\"center\"><b>Группы</b></td>
  <td align=\"center\"><b>Предметы</b></td>
  <td align=\"center\"><b>№Ауд</b></td>
  <td align=\"center\"><b>Учителя</b></td>
 </tr>
");
 
/* Цикл вывода данных из базы конкретных полей */
while ($row = mysql_fetch_array($res)) {
    echo "<tr>\n";
    echo "<td>".$row['id']."</td>\n";
    echo "<td>".$row['Groups']."</td>\n";
	echo "<td>".$row['Items']."</td>\n";
	echo "<td>".$row['Aud']."</td>\n";
    echo "<td>".$row['Teachers']."</td>\n";
    /* Генерируем ссылку для удаления поля */
    echo "<td><a name=\"del\" href=\"udalenie_data.php?del=".$row["id"]."\">Удалить</a></td>\n";
    echo "</tr>\n";
}
 
echo ("</table>\n");
 
/* Закрываем соединение */
mysql_close();
 
/* Выводим ссылку возврата */
echo ("<div style=\"text-align: center; margin-top: 10px;\"><a href=\"admin.php\">Вернуться назад</a></div>");
 
?>