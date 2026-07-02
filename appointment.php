<?php

session_start();

if (!isset($_SESSION['patient_id'])) {
    echo "<script>
    alert('Please login first.');
    window.location='../index.php#login';
    </script>";
    exit();
}

include("../config/db.php");

$patient_id = $_SESSION['patient_id'];

$department = $_POST['department'];
$date = $_POST['appointment_date'];
$message = trim($_POST['message']);

$stmt = $conn->prepare("
INSERT INTO appointments
(patient_id,department,appointment_date,message)
VALUES(?,?,?,?)
");

$stmt->bind_param(
"isss",
$patient_id,
$department,
$date,
$message
);

if($stmt->execute()){

echo "<script>

alert('Appointment Booked Successfully');

window.location='../index.php#home';

</script>";

}else{

echo "Database Error";

}

?>