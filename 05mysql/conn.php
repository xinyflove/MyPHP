<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);

for ($i=0; $i < 100000; $i++) {
	if($_GET['op'] == '2'){
		echo $i.'||';
		mysql_query("UPDATE test SET num = num+1 WHERE id = '{$_GET['op']}'");
	}else{
		echo $i.'||';
		mysql_query("UPDATE test SET num = num+1 WHERE id = '{$_GET['op']}'");
	}
	
}

mysql_close($con);