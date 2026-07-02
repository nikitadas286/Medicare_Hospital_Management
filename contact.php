<?php
session_start();

include("../config/db.php");

$name=trim($_POST['name']);
$email=trim($_POST['email']);
$phone=trim($_POST['phone']);
$subject=trim($_POST['subject']);
$message=trim($_POST['message']);

$stmt=$conn->prepare("
INSERT INTO contact_messages
(name,email,phone,subject,message)
VALUES(?,?,?,?,?)
");

$stmt->bind_param(
"sssss",
$name,
$email,
$phone,
$subject,
$message
);

if($stmt->execute()){

echo "<script>

alert('Message Sent Successfully');

window.location='../index.php#contact';

</script>";

}else{

echo "Error";

}
?>