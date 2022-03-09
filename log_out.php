<?php 
 $cookie_value = " ";
 $cookie_name = "user";
setcookie($cookie_name,  $cookie_value , time() + (31104000 * 30), ); // 86400 = 1 day	
header("Location:".$_SERVER['HTTP_REFERER']);


?>