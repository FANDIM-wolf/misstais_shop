var  div_box = document.getElementById("div_box_item");
var div_data = document.getElementById("data");	

div_box.onclick = function (){
 		 	div_data.classList.toggle("open");
 		 	window.scrollTo(0, 400);
 		}