<?php

session_start();

include("../config/db.php");

$email=trim($_POST['email']);

$password=$_POST['password'];

$stmt=$conn->prepare("SELECT * FROM patients WHERE email=?");

$stmt->bind_param("s",$email);

$stmt->execute();

$result=$stmt->get_result();

if($result->num_rows==1){

$user=$result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['patient_id']=$user['id'];

$_SESSION['patient_name']=$user['firstname'];

$_SESSION['patient_email']=$user['email'];

echo "<script>
alert('Login Successful');
</script>";

header("Location: ../index.php#home");

}else{

echo "<script>

alert('Incorrect Password');

window.history.back();

</script>";

}

}else{

echo "<script>

alert('User Not Found');

window.history.back();

</script>";

}

?>