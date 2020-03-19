<?php
$name = $_POST['name'];
$date = $_POST['date'];
$calss = $_POST['class'];
$discipline = $_POST['discipline'];
$mark = $_POST['mark'];
$mail = $_POST['mail'];

if(!empty($name) || !empty($date)) || !empty($class) || !empty($discipline) || !empty($mark) || !empty($mail) {
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "regi_contest"

$conn = new mysqli($host, $dbUsername , $dbPassword ,$dbname );

if (mysqli_connect_error()){
die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
$SELECT = "SELECT mail From regist_contest_form Where mail = ? Limit 1" ;
$INSERT = "INSERT Into regist_contest_form  (name , date, class , discipline, mark, mail) values(?, ?, ?, ?, ?, ?)";

$stmt= $conn->prepare($SELECT);
$stmt->bind_param("s", $mail);
$stmt->execute();
$stmt->bind_result($mail);
$stmt->store_result();
$rnum=$stmt->num_rows;
if ($rnum==0){
$stmt->close();

$stmt = $conn->prepare($INSERT);
$stmt->bind_param("sssis", $name ,$date, $class ,$discipline, $mark, $mail);
$stmt->execute();
echo "New record inserted secessfully! :)";
}
else {
echo "Someone already register using this email";
}
$stmt->close();
$conn->close();
}
}
else {
 echo "All field are required";
	die();
}
?>