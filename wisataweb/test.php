<!DOCTYPE html>
<html>
<body>

<form method="GET" action="test.php">
  <input type="number" name="inputan">
  <input type="submit" name="submit">
</form>

<?php
if(isset($_GET["submit"])){
	$value = $_GET["inputan"];
    $value = (int)$value;
    echo gettype($value);;
}
?>

</body>
</html>
