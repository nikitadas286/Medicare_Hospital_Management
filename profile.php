<?php

session_start();

if(!isset($_SESSION['patient_id'])){

header("Location: ../index.php#login");

exit();

}

include("../config/db.php");

$id=$_SESSION['patient_id'];

$stmt=$conn->prepare("SELECT * FROM patients WHERE id=?");

$stmt->bind_param("i",$id);

$stmt->execute();

$user=$stmt->get_result()->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

<title>Profile</title>

</head>

<body>

<h2>Patient Profile</h2>

<form action="update_profile.php" method="POST">

First Name

<input
type="text"
name="firstname"
value="<?php echo htmlspecialchars($user['firstname']); ?>">

<br><br>

Last Name

<input
type="text"
name="lastname"
value="<?php echo htmlspecialchars($user['lastname']); ?>">

<br><br>

Email

<input
type="email"
name="email"
value="<?php echo htmlspecialchars($user['email']); ?>">

<br><br>

Phone

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($user['phone']); ?>">

<br><br>

<button>

Update

</button>

</form>

</body>

</html>