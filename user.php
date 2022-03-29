<!DOCTYPE html>
<html>
<head>
	 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat:wght@200;300&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="UTF-8">
	<title>misstasis shop</title>
</head>
<body>
<style type="text/css">
	
a{
	font-family: 'Montserrat', sans-serif;
	text-decoration: none;
	color:black;
}
.div_box{
	width: 300px;
	height: 200px;
	border:3px solid #000;
	border-radius: 20px;
	padding-top: 30px;
	padding-left: 20px;

	display: inline-block;
}

.round{
	width: 110px;
	height:110px;
	border-radius: 50%;
	background-color:white;
	border:3px solid #000;
	margin-right: 10px;
	padding-top: 20px;
	padding-left: 20px;
	
}
.inline { 
    display: inline-block; 
    margin:10px;
 
 		vertical-align: middle;
    }

    .data{
   margin-top: 300px; 	
  display: none;
}
.open{
  display: block;
}

</style>
<?php 
if(isset($_COOKIE["user"]) == true && $_COOKIE["user"] != " "){
 ?>
 	<h3><?php echo $_COOKIE["user"]; ?></h3> 
 	<a href="log_out.php"  >Выйти</a>
 <?php } ?>

<?php 
if(isset($_COOKIE["user"]) == false || $_COOKIE["user"] == " "){
 ?>
 	<h3>Авторизируйтесь или зарегистрируйтесь пожалуйста</h3> 
 	<a href="registration.php" >Зарегистрироваться</a>
 	<a href="authorization.php" >Авторизироваться</a>
 	
 <?php } ?>

<br>
<br>
<div class="div_box" id="div_box_item">
	<div class="inline">
	<div class="round">
		<img src="images/order.png" width="90" height="90">
	</div>
	</div>
	<div class="inline"> 
	<div>	
	<h2>Заказы</h2>
	</div>
	</div>
	</div>
</div>


<div id="data" class="data">
	<p>Data</p>
</div>
<script type="text/javascript">
var  div_box = document.getElementById("div_box_item");
var div_data = document.getElementById("data");	

div_box.onclick = function (){
 		 	div_data.classList.toggle("open");
 		 	window.scrollTo(0, 400);
 		}

</script>
</body>
</html>

