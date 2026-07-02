<?php

session_start();

include("../config/db.php");

$id=$_SESSION['patient_id'];

$current=$_POST['current'];

$new=$_POST['new'];

$confirm=$_POST['confirm'];

$stmt=$conn->prepare("SELECT password FROM patients WHERE id=?");

$stmt->bind_param("i",$id);

$stmt->execute();

$user=$stmt->get_result()->fetch_assoc();

if(!password_verify($current,$user['password'])){

die("Current password incorrect");

}

if($new!=$confirm){

die("Passwords do not match");

}

$newHash=password_hash($new,PASSWORD_DEFAULT);

$stmt=$conn->prepare("UPDATE patients SET password=? WHERE id=?");

$stmt->bind_param("si",$newHash,$id);

$stmt->execute();

echo "<script>

alert('Password Changed');

window.location='profile.php';

</script>";

?>