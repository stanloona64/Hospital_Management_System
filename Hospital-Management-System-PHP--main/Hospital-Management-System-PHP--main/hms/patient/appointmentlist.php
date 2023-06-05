<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>
</head>
<body>

<?php
include("../include/header.php");
include("../include/connection.php");
?>


<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center">My Appointments</h5>
                <?php

                $pat = $_SESSION['patient'];
                $query = "SELECT * FROM patient WHERE username='$pat'";
                $res = mysqli_query($connect, $query);

                $row = mysqli_fetch_array($res);

                $fname = $row['firstname'];
                $querys = mysqli_query($connect, "SELECT * FROM appointment WHERE firstname='$fname'");

                $output = "";
                $output .= "
                    <table class='table table-bordered'>
                        <tr>
                            <td>ID</td>
                            <td>Appointment Date</td>
                            <td>Symptoms</td>
                            <td>Status</td>
                            <td>Date Booked</td>
                        </tr>
                ";

                if (mysqli_num_rows($querys) < 1) {
                    $output .= "
                        <tr>
                            <td colspan='5' class='text-center'>No Appointments Yet.</td>
                        </tr>
                    ";
                }

                while ($row = mysqli_fetch_array($querys)) {
                    $output .= "
                        <tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['appointment_date'] . "</td>
                            <td>" . $row['symptoms'] . "</td>
                            <td>" . $row['status'] . "</td>
                            <td>" . $row['date_booked'] . "</td>
                        </tr>
                    ";
                }
                $output .= "</table>";
                echo $output;

                ?>
            </div>
        </div>
    </div>
</div>

<?php
include("../include/footer.php");
?>

</body>
</html>
