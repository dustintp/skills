<?php
session_start();
$Name = $_SESSION["Name"];
if ($Name == GPalmersheim){
	header("location: bossman.php");
} else

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to Your Skills Profile</title>
</head>
<body>

<?php

$Name = $_SESSION["Name"];
$dbconnect= mysql_connect("127.0.0.1", "root", "d1226605");
$dbselect= mysql_select_db('dbSkills');
$sql= "SELECT * FROM $Name";
$records= mysql_query($sql);


?>
<h1> Skills</h1>
<p> Welcome <?php echo "$Name" ?> you can view and update your skill profile</p>
<table border='1'>
<tr><td>Skill</td><td>Proficiency</td><td>Tool</td><td>Proficiency</td><td>Operating System</td><td>Proficiency</td><td>Certification</td><td>Certification Number</td><tr> 

<?php
require 'loginserv.php';
while ($data=mysql_fetch_assoc($records)){
echo "<tr>";
echo "<td>".$data['skill']."</td>";
echo "<td>".$data['spro']."</td>";
echo "<td>".$data['tool']."</td>";
echo "<td>".$data['tpro']."</td>";
echo "<td>".$data['os']."</td>";
echo "<td>".$data['ospro']."</td>";
echo "<td>".$data['cert']."</td>";
echo "<td>".$data['certnum']."</td>";
echo "<tr>";
}
?>
<form method="get" action="skillupdate.php">
<button>update</button>
</form>
</body>
</html>
