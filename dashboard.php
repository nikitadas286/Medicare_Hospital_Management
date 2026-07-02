<?php
session_start();

if(!isset($_SESSION['patient_id'])){
    header("Location: ../index.php#login");
    exit();
}

include("../config/db.php");

$id=$_SESSION['patient_id'];

$stmt=$conn->prepare("
SELECT *
FROM appointments
WHERE patient_id=?
ORDER BY appointment_date DESC
");

$stmt->bind_param("i",$id);

$stmt->execute();

$result=$stmt->get_result();
?>

<h2>Welcome <?php echo $_SESSION['patient_name']; ?></h2>

<h3>Your Appointments</h3>

<table border="1">

<tr>

<th>Department</th>

<th>Date</th>

<th>Status</th>

</tr>

<?php

while($row=$result->fetch_assoc()){

?>

<tr>

<td><?php echo $row['department']; ?></td>

<td><?php echo $row['appointment_date']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php

}

?>

</table>

<a href="profile.php">My Profile</a>

<br><br>

<a href="change_password_form.php">Change Password</a>

<br><br>

<a href="../process/logout.php">Logout</a>

