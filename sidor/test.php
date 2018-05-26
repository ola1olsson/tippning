<?


$before = mysqli_query($opendb, "SELECT * FROM deltagare;");

while($user = mysqli_fetch_array($before))
{
	echo 'Update user: '.$user['fornamn'].' '.$user['efternamn'].' / pass:'.$user['pass'].'<br>';
	$query = 'UPDATE deltagare SET pass="'.md5($user['pass']).'" WHERE id='.$user['id'].';';
	echo $query.'<br><br>';
}



$after = mysqli_query($opendb, "SELECT * FROM deltagare;");

while($user = mysqli_fetch_array($after))
{
	echo 'Updated user: '.$user['fornamn'].' '.$user['efternamn'].' / pass:'.$user['pass'].'<br>';
}

?>
