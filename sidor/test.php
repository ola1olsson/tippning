<?


$before = mysql_query("SELECT * FROM deltagare;");

while($user = mysql_fetch_array($before))
{
	echo 'Update user: '.$user['fornamn'].' '.$user['efternamn'].' / pass:'.$user['pass'].'<br>';
	$query = 'UPDATE deltagare SET pass="'.md5($user['pass']).'" WHERE id='.$user['id'].';';
	//mysql_query($query);
	echo $query.'<br><br>';
}



$after = mysql_query("SELECT * FROM deltagare;");

while($user = mysql_fetch_array($after))
{
	echo 'Updated user: '.$user['fornamn'].' '.$user['efternamn'].' / pass:'.$user['pass'].'<br>';
}

?>