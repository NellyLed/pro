<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width,initial-scale=1.0'>
		<title>Консультация</title>
		<!--штучка возле названия страницы-->
		<link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
		<style>
		@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');
html{
  cursor: url("data:image/svg+xml,%3Csvg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='24px' height='24px' viewBox='0 0 512 512' style='enable-background:new 0 0 512.011 512.011;' xml:space='preserve'%3E %3Cpath fill='DeepSkyBlue' d='M434.215,344.467L92.881,3.134c-4.16-4.171-10.914-4.179-15.085-0.019  c-2.011,2.006-3.139,4.731-3.134,7.571v490.667c0.003,4.382,2.685,8.316,6.763,9.92c4.081,1.603,8.727,0.545,11.712-2.667  l135.509-145.92h198.016c5.891,0.011,10.675-4.757,10.686-10.648C437.353,349.198,436.226,346.473,434.215,344.467z'/%3E %3C/svg%3E"), pointer;
}
body
{
	background-image:url(фон_2.jpg);
	background-attachment:fixed; 
	background-size:cover;
	background-size: no-repeat;
    background-position: center;
	-webkit-font-smoothing:antialiased;
	-webkit-overflow-scrolling:touch;
	margin-top:70px;
		font-family: 'Poppins', sans-serif;
	font-weight: 300;
	font-size: 15px;
	line-height: 1.7;
	color: #c4c3ca;
	overflow-x: hidden;
}
a {
	cursor: pointer;
  transition: all 200ms linear;
}
a:hover {
	text-decoration: none;
}
.link {
  color: #c4c3ca;
}
.link:hover {
  color: #ffa742;
}
p {
  font-weight: 500;
  font-size: 14px;
  line-height: 1.7;
}

#ram
{
	text-align:center;
	background-color:#2d2d2d;
	float:left;
	border-radius:10px;
	margin:15% 35%;
	width:30%;
	padding:10px;

}
h3
{
	font-family: 'Brush Script MT';
	font-style:italic;
	text-align:center;
	padding:8px;
	color: white;
	font-weight:bold;
	text-shadow: white 0px 0px 2px;
}

@media (min-width: 275px) and (max-width: 575px){
	#ram{width:100%;margin:50% 0;}
	p {font-size:12px;}
}
@media (min-width: 575px) and (max-width: 815px){
	#ram{width:70%;margin:50% 15%;}
}
@media (min-width: 815px) and (max-width: 1100px){
	#ram{width:50%;	margin:50% 25%;}
}
		</style>
		</head>
	<body>
<?php 
$one_name= trim($_POST['txtName']);
$one_email= trim($_POST['txtEmail']);
$one_phone= trim($_POST['txtPhone']);
$one_msg= trim($_POST['txtMsg']);

//проверка объема полей
if(mb_strlen($one_name) < 5 || mb_strlen($one_name) > 15){
	echo "<div id='ram'><h3>Недопустимая длина имени.<br><a href='консультация.php'>Назад к заполнению</a></h3></div><br>";
	exit();
}
else if(mb_strlen($one_phone) < 11 || mb_strlen($one_phone) > 16){
	echo "<div id='ram'><h3>Недопустимая длина номера телефона.<br><a href='консультация.php'>Назад к заполнению</a></h3></div><br>";
	exit();
} 
else if(mb_strlen($one_email) < 6|| mb_strlen($one_email) > 12){
	echo "<div id='ram'><h3>Недопустимая длина почты.<br><a href='консультация.php'>Назад к заполнению</a></h3></div><br>";
	exit();
} 

//проверка на пустые поля
if(empty($one_name) or empty($one_phone) or empty($one_email) or empty($one_msg))
	{
		echo "<div id='ram'><h3>Не все поля заполнены<br><a href='консультация.php'>Назад к заполнению</a></h3></div><br>";
	}
$mysql_login='root';
$mysql_host='localhost';
$mysql_pass='';
$mysql_db='new';
$link = mysqli_connect($mysql_host, $mysql_login, $mysql_pass, $mysql_db); // Соединяемся с базой
   // Соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }
$mysqli = new mysqli($mysql_host, $mysql_login, $mysql_pass, $mysql_db);
$mysqli->set_charset("utf8");
//1 форма
if(isset($_POST['btnSubmit']))
{
	$one_date = date("Y-m-d H:i:s");
	$sql = mysqli_query($link,"INSERT INTO `consulation` (`name`,`phone`, `email`, `declaration`, `date`) VALUES('$one_name','$one_phone', '$one_email','$one_msg','$one_date')");
	if ($sql) {
		echo "<div id='ram'><h3>Ваш вопрос записан!<br>Далее вы сможете перейти на <a style='text-decoration: underline;color:#ffbb29;' href='index.html'>главную страницу </h3></div>";
		} else {
		  echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
		}
}

?>
</body>
</html>