<?php

session_start();

include("../config/db.php");

$id=$_SESSION['patient_id'];

$firstname=$_POST['firstname'];

$lastname=$_POST['lastname'];

$email=$_POST['email'];

$phone=$_POST['phone'];

$stmt=$conn->prepare("
UPDATE patients
SET firstname=?,lastname=?,email=?,phone=?
WHERE id=?
");

$stmt->bind_param(
"ssssi",
$firstname,
$lastname,
$email,
$phone,
$id
);

if($stmt->execute()){

$_SESSION['patient_name']=$firstname;

$_SESSION['patient_email']=$email;

header("Location: profile.php");

}else{

echo "Error";

}

?>