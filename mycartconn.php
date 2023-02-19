<?php
$conn=mysqli_connect("localhost","root","","cake");
if(!$conn){
  echo "database is not connected";
}
else
{
  echo "database is connected successfully";
}

?>