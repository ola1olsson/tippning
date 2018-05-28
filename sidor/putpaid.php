<?php
if($_SESSION['admin']) {
	if (!isset($_POST['putpaid'])) {
?>
		<form action="index.jsp?sida=putpaid" method="POST">
<?php
		$userId = $_GET['userId'];
?>
		Update user <?=$userId?><br>
			<input type="text" name="userId" value="<?=$userId?>" />
			<input type="text" name="paid"></input>
			<br>
			<input type="hidden" name="putresult" value="true"/>
			<input type="submit" value="Put result" />
		</form>
<?php
		if (isset($_POST['userId']) && isset($_POST['paid'])){
			$userId = $_POST['userId'];
			$paid = $_POST['paid'];
			$query = "UPDATE users SET betalt='". $paid ."' WHERE id = " . $userId . ";";
			echo $query;
			mysqli_query($opendb, $query) or die(mysqli_error($opendb));
			echo 'User ' . $_POST['userId'] . 'updated successfully (I hope)!';
		}
	} else {
?>
		<br>
		<br>
		<a href="index.php?sida=update">Update id!</a> | <a href="index.jsp">Go home</a>
<?php
	}
} else { 
	echo 'Permission denied!';
}
?>
