<?php
session_start();

include("../include/header.php");
include("../include/connection.php");

if (isset($_POST['add'])) {
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $status= 'Approved';

    $error = array();

    if (empty($firstname)) {
        $error['u'] = "Enter Doctor First Name";
    } else if (empty($surname)) {
        $error['u'] = "Enter Doctor Surname";
    } else if (empty($uname)) {
        $error['u'] = "Enter Doctor Username";
    } else if (empty($pass)) {
        $error['u'] = "Enter Doctor Password";
    }

    if (count($error) == 0) {
        $q = "INSERT INTO doctors(firstname,surname,username,password,status) 
        VALUES('$firstname','$surname','$uname','$pass','$status')";
        $result = mysqli_query($connect, $q);

        if ($result) {
            echo "Doctor added successfully!";
        } else {
            echo "Failed to add doctor!";
        }
    }
}

if (isset($error['u'])) {
    $er = $error['u'];
    $show = "<h5 class='text-center alert alert-danger'>$er</h5>";
} else {
    $show = "";
}

$query = "SELECT * FROM doctors WHERE status='Approved' ORDER BY data_reg ASC";
$res = mysqli_query($connect, $query);
$output = "";

$output .= "
    <table class='table table-bordered'>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Surname</th>
            <th>Username</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Country</th>
            <th>Salary</th>
            <th>Date Registered</th>
            <th>Action</th>
        </tr>
";

if (mysqli_num_rows($res) < 1) {
    $output .= "
        <tr>
            <td colspan='10' class='text-center'>No job Request Yet.</td>
        </tr>
    ";
}

while ($row = mysqli_fetch_array($res)) {
    $output .= "
        <tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['firstname'] . "</td>
            <td>" . $row['surname'] . "</td>
            <td>" . $row['username'] . "</td>
            <td>" . $row['gender'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['country'] . "</td>
            <td>" . $row['salary'] . "</td>
            <td>" . $row['data_reg'] . "</td>   
            <td>
                <a href='edit.php?id=" . $row['id'] . "'>
                    <button class='btn btn-info'>View</button>
                </a>
            </td>
    ";
}

$output .= "
    </tr>
    </table>
";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Total Doctors</title>
</head>
<body>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php
                include("sidenav.php");
                ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center">Total Doctors</h5>
                <?php echo $output; ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 offset-md-3">
    <h5 class="text-center"> Add Doctor</h5>
    <form method="post" enctype="multipart/form-data">
        <div>
            <?php echo $show; ?>
        </div>
        <div class="form-group">
            <label>Firstname</label>
            <input type="text" name="firstname" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Surname</label>
            <input type="text" name="surname" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="uname" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" class="form-control">
        </div>
        <input type="submit" name="add" value="Add New Doctor" class="btn btn-success">
    </form>
</div>

<?php
include("../include/footer.php");
?>

</body>
</html>
