<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function sum(){
		  var val1 = document.getElementById('val1').value;
		  var val2 = document.getElementById('val2').value;
		  var val3 = document.getElementById('val3').value;
		  var sum = Number(val1) + Number(val2) + Number(val3);
		  if(val3 == ''){
		  	document.getElementById('total').value = sum;
		  }else{
		  	document.getElementById('total').value
		  }
		}
	</script>
</head>
<body>
	<input type="text" name="val1" id="val1"><br><br>
	<input type="text" name="val2" onkeyup="" id="val2"><br><br>
	<input type="text" name="val3" onkeyup="sum()" id="val3"><br><br>
	<input name="total" id="total" value=""><br><br>
</body>
</html>