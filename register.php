<?php

session_start();

include("../config/db.php");

if(isset($_POST['firstname'])){

$firstname=trim($_POST['firstname']);
$lastname=trim($_POST['lastname']);
$email=trim($_POST['email']);
$phone=trim($_POST['phone']);
$password=$_POST['password'];
$confirm=$_POST['confirm_password'];

if($password!=$confirm){

echo "<script>
alert('Passwords do not match');
window.history.back();
</script>";

exit();

}

$check=$conn->prepare("SELECT id FROM patients WHERE email=?");

$check->bind_param("s",$email);

$check->execute();

$result=$check->get_result();

if($result->num_rows>0){

echo "<script>
alert('Email already registered');
window.history.back();
</script>";

exit();

}

$hash=password_hash($password,PASSWORD_DEFAULT);

$stmt=$conn->prepare("INSERT INTO patients(firstname,lastname,email,phone,password)
VALUES(?,?,?,?,?)");

$stmt->bind_param("sssss",
$firstname,
$lastname,
$email,
$phone,
$hash);

if($stmt->execute()){

$_SESSION['patient_id']=$stmt->insert_id;
$_SESSION['patient_name']=$firstname;
$_SESSION['patient_email']=$email;

echo "<script>

alert('Registration Successful');

window.location='../index.php#home';

</script>";

}else{

echo "Registration Failed";

}

}
?>