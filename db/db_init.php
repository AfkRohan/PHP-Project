<!doctype html>
<html>
<body>
<?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    define("INITIALIZING_DATABASE",1);
    require_once("db_conn.php");
//    require_once("./PHP/component.php");
   // get data from the SQL file
	$query = file_get_contents("nightowlsdb.sql"); //enter your script file name here

	// prepare the SQL statements
	$stmt = $pdo->prepare($query);

	// execute the SQL
	if ($stmt->execute()){
		echo "Success";
	}
	else {
		echo "Fail";
	}

    echo "<h3>Database Initialized</h3>";
}
?>
<form method="POST">
    <input type="submit" value="Initialize Database" >
</form>
</body>
</html>