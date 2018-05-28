<?php

function activeSession() {
	return (isset($_SESSION['permission']) && $_SESSION['permission'] != 0);
}

?>

