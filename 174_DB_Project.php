// Peter Metz, Tory Petersen, Andres Morocho
// 174 Project
<HTML>
<HEAD>
<TITLE>View Database</TITLE>
</HEAD>
<BODY>

<TABLE BORDER="1">

<TR>
<TH>empID</TH>
<TH>username</TH>
<TH>password</TH>
<TH>phone</TH>
<TH>email</TH>
<TH>dept</TH>
<TH>fname</TH>
<TH>lname</TH>
<TH>role</TH>
<TH>cID</TH>
<TH>mID</TH>
</TR>

<?php
$servername = "ecs-pd-proj-db.ecs.csus.edu";
$username = "CSC174XXX";
$password = "Csc134_XXXXXXXXX";
$database = "CSC174XXX";

//Check reload page if user submits something in text box
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//prepared statement, change value in a column
	$stmt = $conn->prepare("INSERT INTO EMPLOYEE VALUES (?,'---','---','---','---','---','---','---','intern',1,1)");
	$stmt->bind_param("i", $name);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}

//open connection
$conn = new mysqli($servername, $username, $password, $database);

//check if there was an error
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected Succesfully<br><br>";

//create the query to show table
$sql = "SELECT empID, username, password, phone, email, dept, fname, lname, role, cID, mID FROM EMPLOYEE";
$result = $conn->query($sql);

//populate table
if ($result->num_rows >= 0) {
	while($row = $result->fetch_assoc()) {
	echo "<TR>";
	echo "<TD>";
	echo $row["empID"];
	echo "</TD>";
	echo "<TD>";
	echo $row["username"];
	echo "</TD>";
	echo "<TD>";
	echo $row["password"];
	echo "</TD>";
	echo "<TD>";
	echo $row["phone"];
	echo "</TD>";
	echo "<TD>";
	echo $row["email"];
	echo "</TD>";
	echo "<TD>";
	echo $row["dept"];
	echo "</TD>";
	echo "<TD>";
	echo $row["fname"];
	echo "</TD>";
	echo "<TD>";
	echo $row["lname"];
	echo "</TD>";
	echo "<TD>";
	echo $row["role"];
	echo "</TD>";
	echo "<TD>";
	echo $row["cID"];
	echo "</TD>";
	echo "<TD>";
	echo $row["mID"];
	echo "</TD>";
	echo "</TR>";
	}	
} else {
	echo "0 results";
}
$conn->close();
?>

</TABLE>
<BR>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Enter an integer Employee ID that does not already exist:
	<input type ="text" name="name"><BR>
	<input type="submit" name="submit" value="Submit"><BR>
</form>
</BODY>
</HTML>
