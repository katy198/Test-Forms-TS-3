<?php
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$language = $_POST['language'];
$hours = $_POST['hours'];
$mail = $_POST['mail'];

if(!empty($name) || !empty($lastname)) || !empty($language) || !empty($hours) || !empty($mail) {
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "regi_online_curs"

$conn = new mysqli($host, $dbUsername , $dbPassword ,$dbname );

if (mysqli_connect_error()){
die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
$SELECT = "SELECT mail From registr_form Where mail = ? Limit 1" ;
$INSERT = "INSERT Into registr_form  (name , lastname, language , hours, mail) values(?, ?, ?, ?, ?)";

$stmt= $conn->prepare($SELECT);
$stmt->bind_param("s", $mail);
$stmt->execute();
$stmt->bind_result($mail);
$stmt->store_result();
$rnum=$stmt->num_rows;
if ($rnum==0){
$stmt->close();

$stmt = $conn->prepare($INSERT);
$stmt->bind_param("sssis", $name ,$lastname, $language ,$hours, $mail);
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